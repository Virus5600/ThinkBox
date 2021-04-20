<!DOCTYPE html>
<html lang="en">
	<head>
		{{-- META DATA --}}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{{-- SITE META --}}
		<meta name="url" content="">
		<meta name="type" content="website">
		<meta name="title" content="{{ env('APP_NAME') }}">
		<meta name="description" content="{{ env('APP_DESC') }}">
		{{-- <meta name="image" content="/images/UI/meta-image">
		<meta name="image:alt" content="/images/UI/meta-image-alt"> --}}
		<meta name="keywords" content="">
		<meta name="application-name" content="Defensive Measures Add-on Guide">

		{{-- OG META --}}
		<meta name="og:url" content="">
		<meta name="og:type" content="website">
		<meta name="og:title" content="{{ env('APP_NAME') }}">
		<meta name="og:description" content="{{ env('APP_DESC') }}">
		<meta name="og:image" content="{{ URL::asset('images/banner.png') }}">
		<meta name="og:image:alt" content="{{ URL::asset('images/banner.alt.png') }}">

		{{-- jQuery 3.6.0 --}}
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

		{{-- Removes the code that shows up when script is disabled/not allowed/blocked --}}
		<script type="text/javascript" id="for-js-disabled-js">$('head').append('<style id="for-js-disabled">#js-disabled { display: none; }</style>');$(document).ready(function() {$('#js-disabled').remove();$('#for-js-disabled').remove();$('#for-js-disabled-js').remove();});</script>

		{{-- popper.js 1.16.0 --}}
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		{{-- Bootstrap 4.4 --}}
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		{{-- Slick Carousel 1.9.0 --}}
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>

		{{-- Sweet Alert 2 --}}
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

		{{-- Chart.js 3.1.1 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js" integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A==" crossorigin="anonymous"></script>

		{{-- Custom CSS --}}
		@yield('css')

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Read More --}}
		<link rel="stylesheet" type="text/css" href="/css/readmore.css">
		<script type="text/javascript" src="/js/readmore.js"></script>

		{{-- Local CSS --}}
		<link rel="stylesheet" href="/css/style.css" type="text/css">

		{{-- Favicon --}}
		<link rel='icon' type='image/png' href='/images/UI/favicon.png'>
		
		{{-- Title --}}
		<title>{{ env('APP_NAME') }} | @yield('title')</title>
	</head>
	
	<body>
		{{-- SHOWS THIS INSTEAD WHEN JAVASCRIPT IS DISABLED --}}
		<div style="position: absolute; height: 100vh; width: 100vw; background-color: #ccc;" id="js-disabled">
			<style type="text/css">
				/* Make the element disappear if JavaScript isn't allowed */
				.js-only {
					display: none!important;
				}
			</style>
			<div class="row h-100">
				<div class="col-12 col-md-4 offset-md-4 py-5 my-auto">
					<div class="card shadow my-auto">
						<h4 class="card-header card-title text-center">Javascript is Disabled</h4>

						<div class="card-body">
							<p class="card-text">This website required <b>JavaScript</b> to run. Please allow/enable JavaScript and refresh the page.</p>
							<p class="card-text">If the JavaScript is enabled or allowed, please check your firewall as they might be the one disabling JavaScript.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="d-flex flex-column min-vh-100 js-only">
			{{-- Navigation Bar (TOP) --}}
			<nav class="navbar navbar-expand-lg navbar-light bg-light position-sticky position-lg-relative dark-shadow py-0 px-3" style="z-index: 1000;">
				{{-- Branding --}}
				<a class="navbar-brand m-0 py-0" href="{{route('dashboard')}}" style="height: auto;">
					<img src="/images/UI/Branding.png" style="max-height: 3.25rem;" class="m-0 p-0" alt="Myriad Files" />
				</a>

				{{-- Navbar Toggler --}}
				<button class="sidebar-toggler" type="button" data-toggle="sidebar-collapse" data-target="#sidebar" aria-controls="sidebar" aria-label="Toggle Sidebar">
					<span class="navbar-toggler-icon"></span>
				</button>

				{{-- Navbar contents --}}
				<div class="collapse navbar-collapse" id="navbar">
					<div class="ml-auto">
						<img src="/images/TEMPORARY/home/user1.jpg" class="circular-border" width='30' height='30' draggable='false' alt="User"/>
						<label>
							<div class="dropdown">
								<a href='' role="button" class="nav-link dropdown-toggle text-dark dynamic-size-lg-h6" style="font-size: 1.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Angelique Lacasandile
								</a>
								
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="">Sign out</a>
								</div>
							</div>
						</label>
					</div>
				</div>
			</nav>

			<div class="d-flex flex-d-row flex-grow-1" style="overflow: hidden;">
				{{-- Navigation Bar (SIDE) --}}
				<div class="sidebar dark-shadow custom-scroll d-flex flex-d-col py-3 px-0 collapse-horizontal overflow-y-auto" id="sidebar">
					@if (\Request::is('admin/dashboard'))
					<span class="bg-primary text-white"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</span>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
					@endif

					@if (\Request::is('admin/faculty-member'))
					<span class="bg-primary text-white"><i class="fas fa-tachometer-alt mr-2"></i>Faculty Members</span>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('faculty-member') }}"><i class="fas fa-users mr-2"></i>Faculty Members</a>
					@endif

					@if (\Request::is('admin/announcements'))
					<span class="bg-primary text-white"><i class="fas fa-tachometer-alt mr-2"></i>Announcements</span>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('dashboard') }}"><i class="fas fa-bullhorn mr-2"></i>Announcements</a>
					@endif

					@if (\Request::is('admin/skills'))
					<span class="bg-primary text-white"><i class="fas fa-tachometer-alt mr-2"></i>Skills</span>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('dashboard') }}"><i class="fas fa-pencil-ruler mr-2"></i>Skills</a>
					@endif

					<a class="text-decoration-none text-dark" href="#"><i class="fas fa-sign-out-alt mr-2"></i>Sign Out</a>
				</div>

				{{-- Page Contents --}}
				<div class="content flex-fill">
					<div class="container-fluid my-4">
						@yield('body')
					</div>
				</div>
			</div>
		</div>

		{{-- Scripts --}}
		@yield('script')

		{{-- Local Script --}}
		<script type="text/javascript" src="/js/admin.js"></script>
	</body>
</html>