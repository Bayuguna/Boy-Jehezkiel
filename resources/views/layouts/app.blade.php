<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IT-ESEGA') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Library Css -->
    <link rel="stylesheet" href="{{asset("css/animate.min.css")}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header id="header">
        <div class="container">

        <div id="logo" class="pull-left">
        {{-- <a href="#hero"><img src="img/logo.png" width="10%" height="10%" alt="" title="" /></img></a> --}}
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="#">IT-ESEGA</a></h1>
        </div>

        <nav id="nav-menu-container">
        <ul class="nav-menu">
            <li class="menu-active"><a href="#hero"><i class="fas fa-home mr-1"></i> Home</a></li>
            <li class="menu-has-children"><a href="#">Menu<i class="fas fa-chevron-down ml-1"></i></a>
                <ul>
                    <li><a href="#about"><i class="fas fa-info mr-1"></i> Tentang Kami</a></li>
                    <li><a href="#cara-pendaftaran"><i class="fas fa-file-alt mr-1"></i> Cara Pendaftaran</a></li>
                    <li><a href="#contact"><i class="fas fa-phone mr-1"></i> Hubungi Kami</a></li>
                </ul>
            </li>

            @guest
                <li class="menu-has-children"><a href="#">Masuk<i class="fas fa-chevron-down ml-1"></i></a>
                    <ul>
                        <li><a href="{{ route('login') }}"><i class="fas fa-user"></i> Masuk</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Buat Akun</a></li>
                    </ul>
                </li>
            @else
                <li class="menu-has-children"><a href="#">Hai, {{Auth::user()->name}} <i class="fas fa-chevron-down ml-1"></i></a>
                    <ul>
                        <li><a href="/team"><i class="fas fa-users mr-1"></i> Kelola Team</a></li>
                        <li><a href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                    </ul>
                </li>
            @endguest
        </ul>
        </nav><!-- #nav-menu-container -->
    </div>
    </header><!-- #header -->

    @yield('content')

    <!-- Scripts -->
    <script src="{{asset("js/lib/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("js/lib/jquery/jquery-migrate.min.js")}}"></script>
    <script src="{{asset("js/lib/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("js/lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("js/lib/wow/wow.min.js")}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
    <script src="{{asset("js/lib/waypoints/waypoints.min.js")}}"></script>
    <script src="{{asset("js/lib/counterup/counterup.min.js")}}"></script>
    <script src="{{asset("js/lib/superfish/hoverIntent.js")}}"></script>
    <script src="{{asset("js/lib/superfish/superfish.min.js")}}"></script>
    <script src="{{asset("js/contactform/contactform.js")}}"></script>
    <script src="{{asset("js/js/main.js")}}"></script>

    <!-- Font Awesome -->
    <script type="text/javascript" src="{{ asset('js/fontawesome-all.js') }}" async></script>
</body>
</html>
