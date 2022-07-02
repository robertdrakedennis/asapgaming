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
            background: #6c3659 url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
    <title>Error Code: 404</title>
</head>
<body>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="container h-100 m-auto">
        <div class="d-flex flex-row">
            <img class="m-auto" src="{{ asset('/assets/media/logo/color.svg') }}" style="width: auto; height: 4.5rem;">
            <div class="d-flex flex-column flex-fill">
                <div class="text-light">
                    <h2>Error Code: 404</h2>
                    <h4>We can't seem to find what you're looking for....</h4>
                    <p>If you're having any other issues feel free to contact us on <a href="{{ route('discord') }}" class="text-light font-weight-bold">discord</a> :)</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('/assets/js/app.js') }}"></script>
</body>
</html>
