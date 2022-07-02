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
                            <h4>Total Hours Played</h4>
                            <h6>{{ \number_format($totalPlayTime) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 my-5">
                <table class="table table-brand-dark-grey bg-brand-dark-grey text-light rounded table-borderless table-striped">
                    <thead>
                    <tr>
                        <th scope="col">SteamId</th>
                        <th scope="col">Hours</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($times as $time)
                        @if($loop->first)
                            <tr>
                                <td>@if($times->currentPage() == 1) <i class="fas fa-crown text-warning fa-fw"></i> @endif {{ $time->uid }}</td>
                                <td>{{ \number_format(floor($time->time / 3600)) }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $time->uid }}</td>
                                <td>{{ \number_format(floor($time->time / 3600)) }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                {{ $times->links() }}
            </div>
        </div>
    </div>
@endsection
