@extends('layouts.master')

@section('title', 'Users')

@section('body-background', 'bg-brand-black')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('users') }}
        <h3 class="text-light text-center">{{ $allUsers }} Users</h3>
        <form method="GET">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" placeholder="Search by username" name="query" class="d-inline form-control w-100">
                </div>
                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </div>
        </form>
        <div class="card-deck user-deck">
            @foreach($users as $user)
                <div class="card bg-brand-darker-grey m-3" style="flex-basis: 215px;">
                    <div class="row no-gutters h-100">
                        <div class="col">
                            @if($user->background !== null)
                                <img src="{{ Storage::url($user->background) }}" class="card-img">
                            @else
                                <img src="{{ env('DEFAULT_USER_BACKGROUND') }}" class="card-img">
                            @endif
                            <div class="card-img-overlay text-center h-100 justify-content-center align-items center d-flex flex-column">
                                <a href="{{ route('users.show', $user) }}" class="avatar" style="color:{{ $user->color }} !important;">
                                    <img src="{{ Storage::url($user->avatar) }}" class="avatar-md avatar-rounded" alt="{{ $user->name }}">
                                </a>
                                <a href="{{ route('users.show', $user) }}">
                                    <h6 class="mb-0 mt-1 text-light">{{ $user->name }}</h6>
                                </a>
                                <h6 class="mb-0 text-center">
                                    @if($user->hasAnyRole('Owner', 'Moderator', 'Administrator'))
                                        <i class="fas fa-shield-check fa-fw text-light py-2 fa-xs staff-tool-tip" v-tippy title="This user is a verified staff member"></i>
                                    @else
                                        <i class="fas fa-user fa-fw text-light py-2"></i>
                                    @endif
                                    {{$user->getRoleNames()->first()}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$users->links()}}
    </div>
@endsection
