@extends('admin.layouts.master')
@section('css')
@endsection
@section('title', 'Home')


@section('content')
    <section class="d-flex flex-column position-relative justify-content-between" style="min-height: 200px; padding: 2rem 0 0;">
        <div class="my-1">
            <div class="card-deck profile-deck">
                <div class="card bg-brand-darker-grey mx-3 my-3">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h3 class="text-light">Amount Gained</h3>
                        <i class="far fa-dollar-sign fa-fw fa-2x text-light py-2"></i>
                        <h6 class="text-light">{{ $totalAmount }}</h6>
                    </div>
                </div>
                <div class="card bg-brand-darker-grey mx-3 my-3">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h3 class="text-light">Total Purchases</h3>
                        <i class="far fa-users fa-fw fa-2x text-light py-2"></i>
                        <h6 class="text-light">{{ $totalPurchases }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="d-flex flex-column position-relative justify-content-between avatar-img-overlay" style="min-height: 700px; padding: 2rem 0 5rem;">
        <div class="text-light position-relative">
            <article class="community-post bg-transparent w-100 mb-3">
                <div class="post-inner d-sm-block d-md-block d-lg-flex d-xl-flex">
                    <div class="post-cell-main text-white" style="min-height: 600px;">
                        <div class="d-flex h-100 flex-column">
                            <div class="inner">
                                <div class="card bg-brand-darker-grey">
                                    <div class="card-header bg-transparent">
                                        <h6 class="title">
                                            Purchases
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach($transactions as $transaction)
                                                <li class="text-light list-group-item bg-transparent border-0" style="text-decoration: none;">
                                                    <div><a href="{{ route('users.show', $transaction->user) }}">{{ $transaction->user->name }}</a> spent €{{ $transaction->amount }}</div>
                                                    <div class="text-muted">about {{ $transaction->created_at->diffForHumans()  }}</div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-4 d-flex justify-content-end align-items-end">
                                    {{  $transactions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <section class="d-flex flex-column position-relative justify-content-between" style="min-height: 600px; padding: 10rem 0 20rem;"></section>
@endsection
@section('scripts')
@endsection
