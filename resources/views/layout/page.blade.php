<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>ABC</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <meta name="description"
          content="Discover daily Overwatch arcade gamemodes without having to login to Overwatch. Arcade modes are posted daily. Also get notified by following the Overwatch arcade Twitter or Discord server. Overwatch arcade today also provides a free API so you can create your own implementation. Special thanks to all the contributors">
    <meta name="keywords"
          content="Overwatch, arcade, today, gamemode, modes, arcademodes, daily, gamemodes, discord, twitter, ow">
    <meta name="author" content="bluedog">

    <meta property="og:title" content="Overwatch arcade gamemodes - daily updated and get notified easily">
    <meta property="og:site_name" content="OverwatchArcade.today">
    <meta property="og:url" content="https://overwatcharcade.today/">
    <meta property="og:description"
          content="Discover daily Overwatch arcade gamemodes without having to login to Overwatch. Arcade modes are posted daily. Also get notified by following the Overwatch arcade Twitter or Discord server. Overwatch arcade today also provides a free API so you can create your own implementation. Special thanks to all the contributors">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{env('APP_URL')}}/img/ogimage.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://overwatcharcade.today/">
    <meta property="twitter:title" content="Overwatch arcade gamemodes - daily updated and get notified easily">
    <meta property="twitter:description"
          content="Discover daily Overwatch arcade gamemodes without having to login to Overwatch. Arcade modes are posted daily. Also get notified by following the Overwatch arcade Twitter or Discord server. Overwatch arcade today also provides a free API so you can create your own implementation. Special thanks to all the contributors">
    <meta property="twitter:image" content="{{env('APP_URL')}}/img/ogimage-twitter.jpg">

    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <style>
        html {
            background: url('{{getRandomBackground()}}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-color:#000;
        }
    </style>

</head>
<body>
<div id="app" class="container">
    <section id="header" class="mt-5 mb-5">
        <div class="row">
            <div class="col-auto">
                <router-link to="/">
                <h1 class="text-center text-sm-left text-white"><img src="{{asset('/img/ow-arcade-115.png')}}" class="logo">
                    OverwatchArcade.today</h1>
                </router-link>
            </div>
            @if(Auth::user())
            <div class="col align-self-center text-center" id="loggedIn">
                <router-link to="/profile/{{ str_replace("#", "%23", Auth::user()->name) }}">
                    <h3 class="float-lg-right text-sm-left">
                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle mr-2"
                             height="32px"><span id="username">{{ Auth::user()->name }}</span></h3>
                </router-link>
                @if(Session::get('logged_in'))
                    <alert msg="Successfully logged in"></alert>
                @endif
            </div>
            @endif
        </div>
    </section>
    <section id="content">
        @yield('content')
    </section>
    <section id="menu">
        @include('layout.menu')
    </section>
    <section id="footer" class="mt-5">
        <div class="row">
            <div class="col-12 col-md-10">
                @include('layout.copyright')
            </div>
            <div class="col-12 col-md-2">
                Language
            </div>
        </div>
    </section>
</div>
<script defer type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
