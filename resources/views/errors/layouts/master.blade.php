<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="weeb, weeb.cafe, game servers, us game servers, garrysmod, us garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
    <meta name="description" content="{{ env('APP_NAME') }}'s the name, good server's the game.">
    <meta name="title" content="{{ env('APP_NAME') }} - Darkrp | Dark Roleplay | US darkrp | dark rp server">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="Bringing what's right to gmod.">
    <meta property="og:description" content="{{ env('APP_NAME') }}'s the name, good server's the game.">
    <meta property="og:type" content="Product">
    <meta property="og:image" content="/assets/media/meta/promo.png">
    <meta property="og:url" content="https://xenin.co">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="@xeninco" name="twitter:site">
    <meta name="twitter:description" content="Darkrp that isn't shit.">
    <meta name="twitter:image" content="/assets/media/meta/promo.png">
    <meta name="theme-color" content="#955799">
    <title>Oh no! Something went wrong...</title>
    <link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('assets/js/app.js') }}"></script>
    <link rel="icon" href="{{ '/assets/media/logo/favicon.png' }}">
    @yield('css')
</head>
<body style="background: transparent !important;">
<div class="h-100">
@yield('content')
</div>
</body>
</html>
