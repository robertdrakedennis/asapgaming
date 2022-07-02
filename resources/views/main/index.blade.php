@extends('layouts.master')
@section('body-background', 'bg-brand-black')
@section('title', 'Home')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron bg-transparent justify-content-center text-center">
                    <h1 class="text-white">{{ config('app.name') }}</h1>
                    <p class="text-light">It's all about the fun.</p>
                    <img src="{{ asset('/assets/media/logo/color.svg') }}" class="mx-auto" style="height: auto; width: 15rem;" alt="logo">
                    <div class="d-flex justify-content-center align-content-center text-center mt-5">
                        <a href="{{ route('discord') }}" class="btn px-4 btn-brand-darker-grey mx-3"><i class="fab fa-discord fa-fw"></i> Discord</a>
                        <a href="#" class="btn px-4 btn-brand-darker-grey mx-3" data-toggle="modal"  data-target="#StoreModalOptions"><i class="fas fa-shopping-cart fa-fw"></i> Store</a>
                        <a href="{{ route('steam') }}" class="btn px-4 btn-brand-darker-grey mx-3"><i class="fab fa-steam fa-fw"></i> Steam</a>
                    </div>
                </div>
                <div class="card-deck">
                    <div class="card my-2 bg-brand-dark-grey text-center" style="flex-basis: 210px">
                        <div class="card-body text-light align-items-center">
                            <i class="fas fa-users fa-fw fa-2x"></i>
                            <h6 class="card-title h3">Players</h6>
                            <p class="card-text h5">{{ \number_format($players) }}</p>
                        </div>
                    </div>
                    <div class="card my-2 bg-brand-dark-grey text-center" style="flex-basis: 210px">
                        <div class="card-body text-light">
                            <i class="fab fa-discord fa-fw fa-2x"></i>
                            <h6 class="card-title h3">Discord Members</h6>
                            <p class="card-text h5">5,500+</p>
                        </div>
                    </div >
                    <div class="card my-2 bg-brand-dark-grey text-center" style="flex-basis: 210px">
                        <div class="card-body text-light">
                            <i class="fas fa-users fa-fw fa-2x"></i>
                            <h6 class="card-title h3">Registered Users</h6>
                            <p class="card-text h5">{{ \number_format($signUps)  }}</p>
                        </div>
                    </div >
                </div>
            </div>

            <div class="col-md-12">
                <div class="jumbotron bg-transparent justify-content-center text-center">
                    <h3 class="text-center text-light">What we're made of</h3>
                </div>
                <div class="card-deck">
                    <div class="card bg-brand-dark-grey text-center my-2" style="flex-basis: 210px">
                        <div class="card-header bg-transparent border-0 m-3 justify-content-center">
                            <i class="fas fa-microchip text-white fa-fw fa-2x"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text">
                                AsapGaming is running on a dedicated server hosted by GMCHosting, containing an i7 9700K, DDR4 RAM and SSD storage.
                                On our server - you can play uninterrupted by DDoS attacks and poor performance.
                            </p>
                        </div>
                    </div>
                    <div class="card bg-brand-dark-grey text-center my-2" style="flex-basis: 210px">
                        <div class="card-header bg-transparent border-0 m-3 justify-content-center">
                            <i class="fas fa-server text-white fa-fw fa-2x"></i>
                        </div>
                        <div class="card-body text-light text-center">
                            <p class="card-text">
                                We provide a server with no compromises, packed with fun and unique content to create an ever-changing gameplay experience for all of our players,
                                ensuring your entertainment at all times.
                            </p>
                        </div>
                    </div>
                    <div class="card bg-brand-dark-grey text-center my-2" style="flex-basis: 210px">
                        <div class="card-header bg-transparent border-0 m-3 justify-content-center">
                            <i class="fas fa-shield-alt text-white fa-fw fa-2x"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text">
                                Our staff is selected carefully so we can get the perfect mix between your enjoyment and rule enforcement. As a result of this, there is minimal roleplay interruption from staff members.
                            </p>
                        </div>
                    </div>
                    <div class="card bg-brand-dark-grey text-center my-2" style="flex-basis: 210px">
                        <div class="card-header bg-transparent border-0 m-3 justify-content-center">
                            <i class="fas fa-users text-white fa-fw fa-2x"></i>
                        </div>
                        <div class="card-body text-light">
                            <p class="card-text">
                                AsapGaming is more than a Garry's Mod server, we are a community, featuring an active Discord and an active forum for you to take part in. Become apart of the community today, you wont regret it!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="jumbotron bg-transparent justify-content-center text-center">
                <h3 class="text-center text-light">Servers</h3>
            </div>
            <div class="card-deck">
                @foreach($servers as $server)
                    <div class="card bg-brand-dark-grey d-flex flex-column text-center my-2" style="flex-basis: 310px">
                        <div class="row no-gutters">
                            <div class="col justify-content-center card-img-fade-server">
                                <img class="card-img" src="https://i.imgur.com/Xl0gq9o.jpg" alt="{{ $server['server']['HostName'] ?? 'asap' }}">
                                <div class="card-img-overlay d-flex flex-column text-light">
                                    @if($server['server'] == false || null)
                                        <p>Offline</p>
                                    @else
                                        <div class="m-auto">
                                            <h6>{{ $server['server']['HostName'] ?? 'AsapGaming' }}</h6>
                                            <p>{{ $server['server']['Map'] ?? 'rp_asapgaming' }}</p>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="steam://connect/{{ $server['info']['ip'] . ':' . $server['info']['port'] }}" class="btn btn-sm m-2 btn-primary">Connect</a>
                                                <a href="{{ $server['info']['gametracker']}}" class="btn btn-sm m-2 btn-outline-warning">GameTracker</a>
                                            </div>
                                        </div>
                                        <div class="card-footer border-0 bg-transparent">
                                            <div class="progress" style="background: rgba(255,255,255,0.1);">
                                                <div class="progress-bar btn-hero-blue text-center" role="progressbar" style="width: {{ $server['server']['Players'] }}%" aria-valuenow="{{ $server['server']['Players'] }}" aria-valuemin="0" aria-valuemax="{{ $server['server']['MaxPlayers'] }}">{{ $server['server']['Players'] }}/{{ $server['server']['MaxPlayers'] }}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
