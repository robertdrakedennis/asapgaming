<?php

namespace App\Http\Controllers;

use App\Credit;
use App\User;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchase(Request $request){
        $this->authorize('view', Credit::class);

        $request->validate([
            'steamid' => 'bail|required',
            'creditAmount' => 'required',
            'euroAmount' => 'required'
        ]);

        if ((int) $request->creditAmount < 600){
            alert()->warning('Whoops!', 'The minimum amount of credits you can purchase is 600.');
            return back();
        }

        if ((int) $request->euroAmount < 6){
            alert()->warning('Whoops!', 'The minimum amount of euros you can spend is 6.');
            return back();
        }

        $creditAmount = (int) $request->creditAmount;

        $euroAmount = (int) $request->euroAmount;

        $gifted = User::where('steam_account_id', (int) $request->steamid)->firstOrFail();

        return view('main.store.purchase', compact('gifted', 'euroAmount', 'creditAmount'));
    }


    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getExpressCheckout(Request $request)
    {
        $recurring =  false;
        $cart = $this->getCheckoutData($recurring);
        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
    }
    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        $recurring = false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $cart = $this->getCheckoutData($recurring);
        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $response = $this->provider->createMonthlySubscription($response['TOKEN'], 9.99, $cart['subscription_desc']);
                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }
            $invoice = $this->createInvoice($cart, $status);
            if ($invoice->paid) {
                session()->put(['code' => 'success', 'message' => "Order $invoice->id has been paid successfully!"]);
            } else {
                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
            }
            return redirect('/');
        }
    }
}
