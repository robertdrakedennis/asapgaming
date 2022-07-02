@extends('layouts.master')
@section('title', 'Leaderboards')

@section('body-background', 'bg-brand-black')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{ Breadcrumbs::render('leaderboards') }}
                <div class="card-deck mb-3">
                    <div class="card bg-brand-dark-grey d-flex flex-column justify-content-center text-center">
                        <div class="card-body text-light">
                            <h4>Total Players</h4>
                            <h6>{{ \number_format($totalPlayers) }}</h6>
                        </div>
                    </div>
                    <div class="card bg-brand-dark-grey d-flex flex-column justify-content-center text-center">
                        <div class="card-body text-light">
                            <h4>Total Money In Circulation</h4>
                            <h6>{{ \number_format($totalAmount)  }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 my-5">
                <table class="table table-brand-dark-grey bg-brand-dark-grey text-light rounded table-borderless table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">UID</th>
                        <th scope="col">WALLET</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leaderboardsPaginated as $user)
                        @if($loop->first)
                            <tr>
                                <td>@if($leaderboardsPaginated->currentPage() == 1) <i class="fas fa-crown text-warning fa-fw"></i> @endif {{ $user->rpname }}</td>
                                <td>{{ $user->uid }}</td>
                                <td>£{{ \number_format($user->wallet) }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $user->rpname }}</td>
                                <td>{{ $user->uid }}</td>
                                <td>£{{ \number_format($user->wallet) }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{ $leaderboardsPaginated->links() }}
            </div>
        </div>
    </div>
@endsection
