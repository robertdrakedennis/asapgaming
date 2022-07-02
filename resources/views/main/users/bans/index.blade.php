@extends('layouts.master')
@section('title', 'Bans')

@section('body-background', 'bg-brand-black')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{ Breadcrumbs::render('bans') }}
                <div class="card-deck mb-3">
                    <div class="card bg-brand-dark-grey d-flex flex-column justify-content-center text-center">
                        <div class="card-body text-light">
                            <h4>Total Bans</h4>
                            <h6>{{ \number_format($totalBans) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 my-3">
                <form method="GET">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" placeholder="Search by SteamID" name="query" class="d-inline form-control w-100">
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 my-3">
                <table class="table table-brand-dark-grey bg-brand-dark-grey text-light rounded table-borderless table-striped">
                    <thead>
                    <tr>
                        <th scope="col">SteamID</th>
                        <th scope="col">Un-ban Date</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bannedUsers as $user)
                            <tr>
                                <td>{{ $user->steamid }}</td>
                                @if(\Carbon\Carbon::createFromTimestamp($user->unban_date)->gt($now))
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($user->unban_date)->diffForHumans() }}</td>
                                @else
                                    <td>Ban Expired at: {{ \Carbon\Carbon::createFromTimestamp($user->unban_date) }}</td>
                                @endif
                                <td>
                                    <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#BannedUserOptions-{{ $user->unban_date }}">
                                        Details
                                    </button>
                                    <div class="modal fade" id="BannedUserOptions-{{ $user->unban_date }}" tabindex="-1" role="dialog" aria-labelledby="BannedUserOptionsTitle-{{ $user->unban_date }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title text-dark" id="BannedUserOptionsTitle-{{ $user->unban_date }}">Details for {{$user->steamid}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="h6 text-dark">Steamid: {{ $user->steamid }}</div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="h6 text-dark">Unban Date: {{ \Carbon\Carbon::createFromTimestamp($user->unban_date)->diffForHumans() }} / {{ \Carbon\Carbon::createFromTimestamp($user->unban_date) }}</div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="h6 text-dark">Reason: {{ $user->reason }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $bannedUsers->links() }}
            </div>
        </div>
    </div>
@endsection