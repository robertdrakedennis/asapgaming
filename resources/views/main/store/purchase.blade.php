@extends('layouts.master')
@section('title', 'Store')
@section('body-background', 'bg-brand-primary')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 offset-sm-0 col-md-6 offset-md-3 align-self-center my-5" style="min-height: 100vh;">
                <div class="jumbotron bg-transparent text-light text-center">
                    <h1>Store</h1>
                    <p>After you've purchased your credits, you can buy items or ranks in-game.</p>
                </div>
                <div class="card shadow-lg bg-brand-black">
                    <div class="card-header avatar">
                        <img src="{{ Storage::url($gifted->avatar) }}" class="avatar-rounded avatar-md d-block mx-auto" alt="">
                        <h2 class="text-center mb-1 text-white">{{ $gifted->name }}</h2>
                    </div>
                    <div class="card-body">
                        <h6 class="text-light text-center">Purchasing {{ $creditAmount }} Credits</h6>
                        <ul class="list-group list-group-flush text-center text-light">
                            <li class="list-group-item border-0 bg-transparent"><i class="fas fa-coins fa-fw"></i> {{ $creditAmount }}</li>
                            <li class="list-group-item border-0 bg-transparent"><i class="fas fa-euro-sign fa-fw"></i> {{ $euroAmount }}</li>
                        </ul>
                        <form method="POST" class="w-100" action="https://www.paypal.com/cgi-bin/webscr">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="Credits - {{ $creditAmount }}">
                            <input type="hidden" name="business" value="{{ env('PAYPAL_EMAIL') }}">
                            <input type="hidden" name="item_number" value="{{ \Ramsey\Uuid\Uuid::uuid4()->toString(). '|' . $gifted->name . '|' . "[U:1:{$gifted->steam_account_id}]" . '|' . Carbon\Carbon::now()->toDateString() }}">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="lc" value="US">
                            <input type="hidden" name="currency_code" value="EUR">
                            <input type="hidden" name="amount" id="amount" value="{{ $euroAmount }}">
                            <input type="hidden" name="handling" value="0">
                            <input type="hidden" name="custom" value="{{ $gifted->steam_account_id }}">
                            <input type="hidden" name="cancel_return" value="{{ env('PAYPAL_CANCEL_URL') }}">
                            <input type="hidden" name="return" value="{{ env('PAYPAL_RETURN_URL') }}">
                            <input type="hidden" name="rm" value="2">
                            <input type="hidden" name="notify_url" value="{{ config('paypal.notify_url') }}">
                            <button type="submit" id="pay-with-paypal" class="btn btn-lg btn-success btn-block"><i class="fab fa-paypal"></i> Pay with PayPal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

