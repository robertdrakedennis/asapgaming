@extends('layouts.master')

@section('title', 'Store')

@section('body-background', 'bg-brand-primary')

@section('content')
<div class="container">
    @include('main.partials.errors')
    <div class="row">
        <div class="col-sm-12 offset-sm-0 col-md-6 offset-md-3 align-self-center" style="min-height: 100vh;">
            <div class="jumbotron bg-transparent text-light text-center">
                <h1>Store</h1>
                <p>Features, FAQ's, and more about {{ config('app.name') }}'s store.</p>
            </div>

            <div class="card bg-brand-black shadow-lg">
                <div class="card-header bg-transparent border-0">
                    <h5 class="text-light text-center">Purchase Credits</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('purchase.index') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="text-muted" for="steamid"><i class="fab fa-steam-symbol"></i> Steamid (steamid, steamid3, steamid64)</label>
                            <input type="text" class="form-control" id="steamid" name="steamid" @auth value="{{ "[U:1:" . Auth::user()->steam_account_id ."]" }}" @endauth required />
                        </div>
                        <div class="form-group">
                            <label class="text-muted" for="EUR-store"><i class="far fa-euro-sign"></i> What you pay</label>
                            <input type="number" class="form-control" name="euroAmount" id="EUR-store" title="EUR" value="6" required>
                        </div>
                        <div class="form-group">
                            <label class="text-muted" for="creditAmount-store"><i class="far fa-coins"></i> Credits you'll get</label>
                            <input type="number" class="form-control" id="creditAmount-store" name="creditAmount" title="creditAmount" value="600" required>
                        </div>
                        <button type="submit" id="submitOrder-store" class="btn btn-block btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

        $("#EUR-store").on("input", function(e) {
            $("#creditAmount-store").val(($(this).val() * 100));
            checkValueStore();
        });

        $("#creditAmount-store").on("input", function(e) {
            $("#EUR-store").val(($(this).val() / 100));
            checkValueStore();
        });

        function checkValueStore() {
            if ($('#EUR-store').val() < 6) {
                $("#submitOrder-store").attr("disabled", true);
            } else {
                $("#submitOrder-store").removeAttr("disabled");
            }
        }

        $("#EUR").on("input", function(e) {
            $("#creditAmount").val(($(this).val() * 100));
            checkValue();
        });

        $("#creditAmount").on("input", function(e) {
            $("#EUR").val(($(this).val() / 100));
            checkValue();
        });

        function checkValue() {
            if ($('#EUR').val() < 6) {
                $("#submitOrder").attr("disabled", true);
            } else {
                $("#submitOrder").removeAttr("disabled");
            }
        }
    </script>
@endsection
