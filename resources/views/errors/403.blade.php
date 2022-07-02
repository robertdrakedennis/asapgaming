<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ config('app.name') }}, {{ config('app.url') }}, game servers, us game servers, garrysmod, us garrysmod servers, uk garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
    <meta name="description" content="{{ config('app.name') }}. Good content, good servers, good fun.">
    <meta name="title" content="{{ config('app.name') }} - Darkrp | Dark Roleplay | US darkrp | dark rp server">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }}.  It's all about the fun.">
    <meta property="og:type" content="Product">
    <meta property="og:image" content=" {{ asset('/assets/media/meta/promo.png') }}">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="{{ '@ . ' . config('app.name') }}" name="twitter:site">
    <meta name="twitter:description" content="Darkrp that isn't shit.">
    <meta name="twitter:image" content=" {{ asset('/assets/media/meta/promo.png') }}">
    <meta name="theme-color" content="#955799">
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
    <style>
        body{
            background: #661414 url("data:image/svg+xml,%3Csvg width='42' height='44' viewBox='0 0 42 44' xmlns='http://www.w3.org/2000/svg'%3E%3Cg id='Page-1' fill='none' fill-rule='evenodd'%3E%3Cg id='brick-wall' fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M0 0h42v44H0V0zm1 1h40v20H1V1zM0 23h20v20H0V23zm22 0h20v20H22V23z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
    <title>Error Code: 403</title>
</head>
<body>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container h-100 m-auto">
        <div class="d-flex flex-row">
            <img class="m-auto" src="{{ asset('/assets/media/logo/color.svg') }}" style="width: auto; height: 4.5rem;">
            <div class="d-flex flex-column flex-fill">
                <div class="text-light">
                    <h2>Error Code: 403</h2>
                    <h4>You either aren't supposed to be here, have been banned, or something else.</h4>
                    <p>If you're having any other issues feel free to contact us on <a href="{{ route('discord') }}" class="text-light font-weight-bold">discord</a> :)</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('/assets/js/app.js') }}"></script>
</body>
</html>
