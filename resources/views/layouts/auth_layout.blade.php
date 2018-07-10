<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome -->
    <script type="text/javascript" src="{{ asset('js/fontawesome-all.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mt-3">
        <a href="/" style="text-decoration:none;">
            <img src="{{asset("img/logo.png")}}" width="5%" height="5%" alt="">
            <span class="pt-2" style="
                margin-left:10px;
                font-size:36px;
                color: #666666;
            ">IT-ESEGA</span>
        </a>
    </div>
    @yield('content')

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Font Awesome -->
    <script type="text/javascript" src="{{ asset('js/fontawesome-all.js') }}" async></script>
</body>
</html>