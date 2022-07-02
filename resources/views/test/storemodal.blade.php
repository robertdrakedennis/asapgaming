@extends('layouts.master')
@section('css')
@endsection
@section('title', 'Home')


@section('content')
    <section class="d-flex flex-column position-relative brand bg-brand-black" style="min-height: 100vh; padding: 10rem 0 10rem;">
        <div class="d-flex flex-column position-relative text-center mx-auto my-auto justify-content-center align-items-center brand">
        <store-modal-component uuid="{{ \Ramsey\Uuid\Uuid::uuid4()->toString() }}"  steam_account_id="{{ Auth::user()->steam_account_id }}" api_url="{{ env('APP_API_URL') }}" datetime="{{ Carbon\Carbon::now()->toDateString() }}"></store-modal-component>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
