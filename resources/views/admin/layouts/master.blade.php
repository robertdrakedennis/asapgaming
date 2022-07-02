<!doctype html>
<html lang="en">
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
    @yield('css')
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
</head>
<body @if(View::hasSection('bodyBackground')) class="@yield('bodyBackground')" @else  class="bg-brand-black" @endif>
<div class="h-100" id="app">
    <div class="d-flex flex-column" style="-webkit-box-direction: normal; -webkit-box-orient: vertical; bottom: 0; contain: layout; flex-direction: column; height: 100vh; left: 0; position: absolute; right: 0; top: 0;">
        <div class="position-relative w-100">
            <nav class="navbar navbar-expand-lg  navbar-dark bg-transparent @if(View::hasSection('navBackground'))  @yield('navBackground') @endif px-sm-1 px-md-2 px-lg-4 px-xl-5 py-3 mx-auto" style="z-index: 1;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('/assets/media/logo/color.svg') }}" class="d-block brand-image" style="height: auto; width: 3.25rem;" alt="logo">
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
                            <a class="nav-link" href="{{ route('store') }}">Store</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('articles.index') }}">News & Updates</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="main-content" style="-ms-flex: 1 1 100%; -webkit-box-flex: 1; flex: 1 1 100%; margin: 0; display: -webkit-box; display: -ms-flexbox; display: flex; overflow: hidden;">
            <div id="left-column" class="d-flex position-relative bg-brand-dark-grey" style="flex: 1 0 300px; min-width: 250px; overflow: hidden;">
                <div class="d-flex position-relative" style="-ms-flex: 1; -webkit-box-flex: 1; display: -webkit-box; display: -ms-flexbox; display: flex; flex: 1; height: 100%; min-height: 1px; position: relative;">
                    <div class="d-flex justify-content-end" style="-ms-flex: 1; -webkit-box-flex: 1; -webkit-overflow-scrolling: touch; flex: 1; min-height: 1px; overflow-y: scroll; -ms-flex-pack: end; -webkit-box-pack: end; display: -webkit-box; display: -ms-flexbox; display: flex; justify-content: flex-end; overflow-x: hidden; overflow-y: scroll;">
                        <div class="position-relative" style="    -ms-flex: 1 1 100%; -webkit-box-flex: 1; flex: 1 1 100%; max-width: 285px; min-height: min-content; position: relative; z-index: 3;">
                            <div style="-ms-flex: 1 1 auto; -webkit-box-flex: 1; flex: 1 1 auto; padding: 40px 5px 40px 20px;">
                                <div class="left-column-section" style="margin-bottom: 40px;">
                                    <ul style="margin: 0 0 8px -10px;">
                                        <li>
                                            <a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">
                                                Home
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="text-light" style="margin: 0 0 8px -10px; opacity: 0.4;">Statistics</p>
                                    <ul style="margin: 0 0 8px -10px;">
                                        <li>
                                            <a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">
                                                Site Statistics
                                            </a>
                                            <a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">
                                                In-game Economy
                                            </a>
                                            <a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">
                                                Gangs
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="text-light" style="margin: 0 0 8px -10px; opacity: 0.4;">Transactions</p>
                                    <ul style="margin: 0 0 8px -10px;">
                                        <li>
                                            <a href="{{ route('transactions.index') }}" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">
                                               All
                                            </a>
                                            {{--<a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">--}}
                                                {{--Create--}}
                                            {{--</a>--}}
                                        </li>
                                    </ul>
                                    {{--<p class="text-light" style="margin: 0 0 8px -10px; opacity: 0.4;">Users</p>--}}
                                    {{--<ul style="margin: 0 0 0 -10px;">--}}
                                        {{--<li>--}}
                                            {{--<a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">--}}
                                                {{--List--}}
                                            {{--</a>--}}
                                            {{--<a href="#" class="text-light" style="text-decoration: none; -ms-flex-align: center; -ms-flex-pack: start; -webkit-box-align: center; -webkit-box-pack: start; -webkit-transition: all .125s; align-items: center; display: -webkit-box; display: -ms-flexbox; display: flex; font-size: 16px; font-weight: 400; justify-content: flex-start; letter-spacing: .3px; line-height: 20px; margin-bottom: 2px; position: relative; transition: all .125s;">--}}
                                                {{--Create--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    {{--</ul>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="right-column" class="d-flex position-relative bg-brand-grey" style="flex: 1 1 1000px; overflow: auto; z-index: 2;">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-LRlmVvLKVApDVGuspQFnRQJjkv0P7/YFrw84YYQtmYG4nK8c+M+NlmYDCv0rKWpG" crossorigin="anonymous">
<script src="{{ mix('/assets/js/app.js') }}"></script>
<div class="position-fixed w-100" style="z-index: 9999; bottom: 0;">
    @include('cookieConsent::index')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
@include('sweetalert::alert')
@yield('scripts')
</body>
</html>
