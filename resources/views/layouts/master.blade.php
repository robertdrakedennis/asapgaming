<!doctype html>
<html lang="en" class="@yield('html-background')">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(View::hasSection('meta'))
        @yield('meta')
    @else
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="{{ config('app.name') }}, {{ config('app.url') }}, game servers, us game servers, garrysmod, us garrysmod servers, uk garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
        <meta name="description" content="{{ config('app.name') }}. Good content, good servers, good fun.">
        <meta name="title" content="{{ config('app.name') }} - Darkrp | Dark Roleplay | US darkrp | dark rp server">
        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:title" content="{{ config('app.name') }}">
        <meta property="og:description" content="{{ config('app.name') }}.  It's all about the fun.">
        <meta property="og:type" content="Product">
        <meta property="og:image" content="/assets/media/meta/promo.png">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta content="summary_large_image" name="twitter:card">
        <meta content="{{ '@ . ' . config('app.name') }}" name="twitter:site">
        <meta name="twitter:description" content="Darkrp that isn't shit.">
        <meta name="twitter:image" content="{{ asset('/assets/media/meta/img_full.png') }}">
        <meta name="theme-color" content="#955799">
    @endif
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('/assets/media/logo/favicon.png') }}">
    <script src="https://kit.fontawesome.com/5dc05bfc91.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
    <!-- Main Quill library -->

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    @yield('css')
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
</head>
<body class="@if(View::hasSection('body-background')) @yield('body-background') @else bg-transparent @endif">
<div id="app">
    @include('main.partials.store')
    <nav class="navbar navbar-expand-lg navbar-dark @if(View::hasSection('navbar-background'))  @yield('navbar-background') @else bg-transparent @endif px-sm-1 px-md-2 px-lg-4 px-xl-5 py-3 mx-auto" style="z-index: 1;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('/assets/media/logo/color.svg') }}" class="d-block brand-image" style="height: auto; width: 3.25rem;">
        </a>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('forums.index') }}">Forums</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link text-warning" href="#" data-toggle="modal"  data-target="#StoreModalOptions">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link community-nav" href="{{ route('users.index') }}" v-tippy="{ html:  '#community', interactive : true, theme : 'navbar-mega-menu', animateFill : false, placement : 'bottom', arrow: true, arrowType: 'round',  arrowTransform: 'scale(1.5)' }">
                        Community
                    </a>
                    <community-component class="d-none" id="community" v-tippy-html users="{{route('users.index')}}" leaderboards="{{route('users.leaderboards')}}" timeboards="{{ route('users.leaderboards.time') }}" staff="{{route('users.staff')}}"  bans="{{route('users.bans')}}"></community-component>

                </li>
                <li class="nav-item">
                    <a class="nav-link dont-fade social-nav" href="#" v-tippy="{ html:  '#social', interactive : true, theme : 'navbar-mega-menu', animateFill : false, placement : 'bottom', arrow: true, arrowType: 'round',  arrowTransform: 'scale(1.5)' }">
                        Social
                    </a>
                    <social-component class="d-none" id="social" discord="{{ route('discord') }}" steam="{{route('steam')}}"></social-component>
                </li>
            </ul>
            @guest
                <form method="POST" action="{{ action('Auth\SteamLoginController@login') }}">
                    @method('POST')
                    @csrf
                    <button type="submit" class="my-2 my-lg-0 btn btn-outline-brand-white login-button" style="font-size: 14px;">
                        Login
                    </button>
                </form>
            @endguest
            @auth
                <li class="nav-item" style="list-style: none;">
                    <a href="{{ route('users.notifs', Auth::user()) }}" class="nav-link">
                        @if(Auth::user()->unreadNotifications()->count() > 0)
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="fas fa-fw fa-bell text-white"></i><span class="badge badge-danger rounded">{{ Auth::user()->unreadNotifications()->count() }}</span>
                            </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="far fa-fw fa-bell text-white"></i>
                            </div>
                        @endif
                    </a>
                </li>
                <li class="nav-item" style="list-style: none;">
                    <a href="#" data-toggle="modal" data-target="#StoreModalOptions" class="nav-link">
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="mb-0 text-white">Credits: {{ Auth::user()->credits }}</p>
                        </div>

                    </a>
                </li>
                <li class="nav-item" style="list-style: none;">
                    <a href="{{ route('users.show', Auth::user()) }}" class="nav-link profile-nav avatar" v-tippy="{ html:  '#profile', interactive : true, theme : 'navbar-mega-menu', animateFill : false, placement : 'bottom', arrow: true, arrowType: 'round',  arrowTransform: 'scale(1.5)' }">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="my-1 my-lg-0 avatar-sm avatar-rounded">
                    </a>
                    <profile-component id="profile" class="d-none" show="{{ route('users.show', Auth::user()) }}" logout="{{ route('logout') }}"></profile-component>
                </li>
            @endauth
        </div>
    </nav>
    <main role="main">
        @yield('content')
    </main>
    <div class="footer my-5 p-sm-2 p-md-0 @if(View::hasSection('footer-background')) @yield('footer-background') @else bg-transparent @endif" style="min-height: 215px;">
        <div class="container">
            <div class="d-flex flex-sm-row flex-md-row flex-sm-wrap justify-content-sm-center justify-content-sm-around justify-content-md-between align-items-sm-start align-items-md-start">
                <div class="d-flex flex-column align-items-sm-center align-items-md-start my-sm-4 my-md-0">
                    <img src="{{ asset('/assets/media/logo/color.svg') }}" class="d-block brand-image" style="height: auto; width: 4.25rem;">
                </div>
                <div class="d-flex flex-column align-items-sm-center align-items-md-start my-sm-4 my-md-0 w-sm-45">
                    <h3 class="text-white">Community</h3>
                    <a href="{{ route('forums.index') }}" class="nav-link py-1 pr-0 text-light">Forums</a>
                    <a href="{{ route('users.leaderboards') }}" class="nav-link py-1 pr-0 text-light">Leaderboard</a>
                    <a href="{{ route('discord') }}" class="nav-link py-1 pr-0 text-light">Discord</a>
                    <a href="{{ route('steam') }}" class="nav-link py-1 pr-0 text-light">Steam</a>
                </div>
                <div class="d-flex flex-column align-items-sm-center align-items-md-start my-sm-4 my-md-0">
                    <h3 class="text-white">Server</h3>
                    <a href="#" class="nav-link py-1 pr-0 text-light" data-toggle="modal" data-target="#StoreModalOptions">Store</a>
                    <a href="{{ route('rules') }}" class="nav-link py-1 pr-0 text-light">Rules</a>
                    <a href="{{ route('users.bans') }}" class="nav-link py-1 pr-0 text-light">Bans</a>
                </div>
                <div class="d-flex flex-column align-items-sm-center align-items-md-start my-sm-4 my-md-0">
                    <h3 class="text-white">Contact</h3>
                    <a href="{{ route('mail') }}" class="nav-link py-1 pr-0 text-light">Mail</a>
                    <a href="{{ route('discord') }}" class="nav-link py-1 pr-0 text-light">Support</a>
                    <a href="{{ route('discord') }}" class="nav-link py-1 pr-0 text-light">Discord</a>
                </div>
                <div class="d-flex flex-column align-items-sm-center align-items-md-start my-sm-4 my-md-0">
                    <h3 class="text-white">Organization</h3>
                    <a href="{{ route('tos') }}" class="nav-link py-1 pr-0 text-light">Terms of Service</a>
                    <a href="#" class="nav-link py-1 pr-0 text-light">Applications</a>
                </div>
                <div class="d-flex flex-column align-items-sm-center align-items-md-start my-sm-4 my-md-0">
                    <h3 class="text-white">More</h3>
                    <a href="#" class="nav-link py-1 pr-0 text-light">Partners</a>
                    <a href="{{ route('server') }}" class="nav-link py-1 pr-0 text-light">Connect to Server</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js" integrity="sha256-7OUNnq6tbF4510dkZHCRccvQfRlV3lPpBTJEljINxao=" crossorigin="anonymous"></script>
<script src="{{ mix('assets/js/app.js') }}"></script>
<div class="position-fixed w-100" style="z-index: 9999; bottom: 0;">
    @include('cookieConsent::index')
</div>
@include('sweetalert::alert')
@yield('scripts')
</body>
</html>
