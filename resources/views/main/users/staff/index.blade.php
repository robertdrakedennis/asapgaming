@extends('layouts.master')

@section('css')
    <style>
        @foreach($users as $user)
    .user-img-overlay-{{$user->id}}::before{
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: url('{{ Storage::url($user->background) }}') no-repeat center;
            -webkit-background-size: cover !important;
            background-size: cover !important;
            -webkit-mask-image:-webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0, .15)), to(rgba(0,0,0,0)));
            mask-image: linear-gradient(to bottom, rgba(0,0,0, .15), rgba(0,0,0,0) 75%);
        }
        @endforeach
    </style>
@endsection

@section('body-background', 'bg-brand-black')
@section('title', 'Staff')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('staff') }}
        <h3 class="text-light text-center">Verified Staff Members</h3>
        <div class="card-deck">
            @foreach($users as $user)
                <div class="card bg-brand-darker-grey m-3" style="flex-basis: 215px;">
                    <div class="row no-gutters h-100">
                        <div class="col card-img-fade">
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
