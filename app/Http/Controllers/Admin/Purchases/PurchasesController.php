<?php

namespace App\Http\Controllers\Admin\Purchases;

use App\Http\Resources\User;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Sale::orderBy('id', 'desc')->paginate(15);

        $totalAmount = Sale::sum('amount');

        $totalPurchases = Sale::count();

        $revenueThisMonth = Sale::whereMonth(
            'created_at', date('n')
        )->sum('amount');


        $revenueThisWeek = Sale::whereBetween('created_at', [
            Carbon::parse('last monday')->startOfDay(),
            Carbon::parse('next friday')->endOfDay(),
        ])->sum('amount');


        return view('admin.purchases.index', compact('transactions', 'totalAmount', 'totalPurchases', 'revenueThisMonth', 'revenueThisWeek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    /**
     * Search the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $steam_account_id = $request->steamid;

        $user = User::where('steam_account_id', $steam_account_id)->first();

        $sale = Sale::where('steam_account_id', $steam_account_id);

        return view('', compact('user', 'sale'));
    }
}
