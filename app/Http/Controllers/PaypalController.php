<?php
namespace App\Http\Controllers;

use App\Sale;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Srmklive\PayPal\Services\ExpressCheckout;

/**
 * @property ExpressCheckout provider
 */
class PayPalController extends Controller{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    /**
     * PayPalController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }

        $post = [
            'cmd' => '_notify-validate'
        ];

        $data = $request->all();

        foreach ($data as $key => $value) {
            $post[$key] = $value;
        }

        if ($post["receiver_email"] !== env("PAYPAL_EMAIL")) die();

        $response = (string) $this->provider->verifyIPN($post);

        if ($response === 'VERIFIED') {
            if(array_key_exists('reason_code', $post)){
                $user = User::where('steam_account_id', '=', $post['custom'])->firstOrFail();

                $client = new Client();

                $color = hexdec('#ff85c2');

                $client->request('POST', 'https://discordapp.com/api/webhooks/538290020717428736/C_aTE8W_ciDF_VPQ4ftB4MucbJ0teMwLOlJEWqCYYNAGdVPebL6DkGDAfY_OdBB2atWZ?wait=true', [
                    'headers' => [
                        'Content-type' => ['content-type' => 'application/json'],
                        'Accept' => 'application/json',
                        'Authorization' => Uuid::uuid4()->toString(),
                    ],
                    'json' => [
                        'content' => '',
                        'tts' => false,
                        'embeds' => [
                            [
                                'title' => $user->name,
                                'color' => $color,
                                'thumbnail' => [
                                    'url' =>  (string) env('APP_URL') .  Storage::url($user->avatar)
                                ],
                                'fields' => [
                                    [
                                        'name' => 'Case type:',
                                        'value' => $post['reason_code'],
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Current Credits:',
                                        'value' => $user->credits,
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Total Credits:',
                                        'value' => $user->total_credits,
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Purchased Date:',
                                        'value' => $post['payment_date'],
                                        'inline' => true,
                                    ],

                                    [
                                        'name' => 'Steam Account ID:',
                                        'value' =>$user->steam_account_id,
                                        'inline' => true,
                                    ],
                                ],
                                'footer' => [
                                    'text' => 'https://www.asapgaming.co/users/' . $user->slug
                                ]
                            ]
                        ]
                    ]
                ]);
            
                die();
            }

            $sale = false;

            if ($sale === true){
                $creditPerEuro = 140;
            } else {
                $creditPerEuro = 100;
            }

            $steam_account_id = $post['custom'];

            // get amount they spent in the store, used to make sure people don't cheat the system, quick round to make sure I dont get decimals
            $amountSpent = floor(round($post['mc_gross'], 0, PHP_ROUND_HALF_UP));

            //query player and updates their credits
            $user = User::where('steam_account_id', '=', $steam_account_id)->firstOrFail();

            $totalCredits = $creditPerEuro * $amountSpent;

            $user->increment('credits', $totalCredits);

            $user->increment('total_credits', $totalCredits);

            $user->save();

            try{
                // Sale::create([
                //     'item_name' => $post['item_name'],
                //     'steam_account_id' => $post['custom'],
                //     'amount' => $post['mc_gross'],
                //     'user_id' => $user->id,
                // ]);

                if ($user->color != null){
                    $color = hexdec($user->color);
                } else {
                    $color = hexdec('#ff85c2');
                }

                $client = new Client();

                $client->request('POST', 'https://discordapp.com/api/webhooks/538290020717428736/C_aTE8W_ciDF_VPQ4ftB4MucbJ0teMwLOlJEWqCYYNAGdVPebL6DkGDAfY_OdBB2atWZ?wait=true', [
                    'headers' => [
                        'Content-type' => ['content-type' => 'application/json'],
                        'Accept' => 'application/json',
                        'Authorization' => Uuid::uuid4()->toString(),
                    ],
                    'json' => [
                        'content' => '',
                        'tts' => false,
                        'embeds' => [
                            [
                                'title' => $user->name,
                                'color' => $color,
                                'thumbnail' => [
                                    'url' =>  (string) env('APP_URL') .  Storage::url($user->avatar)
                                ],
                                'fields' => [
                                    [
                                        'name' => 'Package Name:',
                                        'value' => $post['item_name'],
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Amount Paid:',
                                        'value' => $post['mc_gross'],
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Current Credits:',
                                        'value' => $user->credits,
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Total Credits:',
                                        'value' => $user->total_credits,
                                        'inline' => true,
                                    ],
                                    [
                                        'name' => 'Purchased Date:',
                                        'value' => Carbon::now()->toDateString(),
                                        'inline' => true,
                                    ],

                                    [
                                        'name' => 'Steam Account ID:',
                                        'value' =>$user->steam_account_id,
                                        'inline' => true,
                                    ],
                                ],
                                'footer' => [
                                    'text' => 'https://www.asapgaming.co/users/' . $user->slug
                                ]
                            ]
                        ]
                    ]
                ]);

            } catch (\Exception $e){
                app('sentry')->captureException($e);
            }
        }
    }
}
