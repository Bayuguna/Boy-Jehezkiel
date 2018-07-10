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

		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
		<link rel="stylesheet" href="{{asset('css/main.css')}}">

		<!-- Font Awesome -->
		<link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-all.css')}}">
</head>
<body class="app sidebar-mini rtl">
	<!-- Navbar-->
	<header class="app-header"><a class="app-header__logo" href="/">IT-ESEGA</a>
		<!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i style="font-size:20px;" class="fas fa-bars mt-3"></i></a>
		<!-- Navbar Right Menu-->
		<ul class="app-nav">
			<!--Notification Menu-->
			@if(count($message))
				<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="far fa-bell"></i><span class="badge badge-warning">{{count($message)}}</span></a>
					<ul class="app-notification dropdown-menu dropdown-menu-right">
						<li class="app-notification__title">{{count($message)}} pesan belum dibaca</li>
						<div class="app-notification__content">
							@foreach($message as $m)
								<li>
									<a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack"><i class="fa fa-circle text-primary" style="font-size:28px"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
										<div>
											<p class="app-notification__message">{{$m->sender}}</p>
											<p class="app-notification__meta">{{$m->created_at->diffForHumans()}}</p>
										</div>
									</a>
								</li>
							@endforeach
						</div>
						<li class="app-notification__footer"><a href="/user/message">Lihat semua pesan</a></li>
					</ul>
				</li>
			@else
				<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="far fa-bell"></i></a>
					<ul class="app-notification dropdown-menu dropdown-menu-right">
						<li class="app-notification__title">Tidak ada pesan baru</li>
						<div class="app-notification__content">

						</div>
						<li class="app-notification__footer"><a href="/user/message">Lihat semua pesan masuk masuk</a></li>
					</ul>
				</li>
			@endif
			<!-- User Menu-->
			<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user"></i></a>
				<ul class="dropdown-menu settings-menu dropdown-menu-right">
					<li><a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a></li>
					<li><a class="dropdown-item" href="{{route("user.logout")}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</header>
	<!-- Sidebar menu-->
	<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<aside class="app-sidebar">
		<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" height="50px" width="50px" src="/avatars/{{Auth::user()->avatar}}" alt="User Image">
			<div>
				<p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
				<p class="app-sidebar__user-designation">{{Auth::user()->teamname}}</p>
			</div>
		</div>
		<ul class="app-menu">
			<li><a class="app-menu__item @yield('active1')" href="{{route('team.index')}}"><i class="app-menu__icon fas fa-tachometer-alt mr-2"></i><span class="app-menu__label"> Dashboard</span></a></li>
			<li><a class="app-menu__item @yield('active2')" href="{{route('user.schedule')}}"><i class="app-menu__icon fas fa-calendar-alt mr-2"></i><span class="app-menu__label"> Jadwal</span></a></li>
			@if(count($message))
				<li><a class="app-menu__item @yield('active3')" href="/user/message"><i class="app-menu__icon fas fa-envelope mr-2"></i><span class="app-menu__label"> Pesan Masuk<span class="badge badge-warning ml-2">{{count($message)}}</span></span></a></li>
			@else
				<li><a class="app-menu__item @yield('active3')" href="/user/message"><i class="app-menu__icon fas fa-envelope mr-2"></i><span class="app-menu__label"> Pesan Masuk</span></a></li>
			@endif
			<li><a class="app-menu__item @yield('active4')" href="{{route('user.message-out')}}"><i class="app-menu__icon fas fa-envelope mr-2 mr-2"></i><span class="app-menu__label"> Pesan Keluar</span></a></li>
		</ul>
	</aside>
	<main class="app-content">
		<div class="app-title elevation">
			<div>
				<h1>@yield('pagetitle')</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i></li>
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
			</ul>
		</div>
		<div>
			@yield('content')
		</div>
	</main>
	<!-- Scripts -->
	<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{asset('js/datatables.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
	<!-- The javascript plugin to display page loading on top-->
	<script type="text/javascript" src="{{ asset('js/plugins/pace.min.js') }}"></script>

	{{-- Custom js --}}
	<script>
		$(document).ready(function() {
			$('#datatables').DataTable();
		} );
	</script>
</body>
</html>
