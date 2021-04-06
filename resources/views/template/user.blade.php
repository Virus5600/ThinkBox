<!DOCTYPE html>
<html>
	<head>
		<title>{{ env('APP_NAME') }} | @yield('title')</title>

		{{-- META DATA --}}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

		{{-- popper.js 1.16.0 --}}
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		{{-- Bootstrap 4.4 --}}
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		{{-- Slick Carousel 1.9.0 --}}
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css"/>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css"/>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>

		{{-- Custom CSS --}}
		@yield('css')

		{{-- Local CSS --}}
		<link rel="stylesheet" href="/css/style.css" type="text/css"/>

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Favicon --}}
		<link rel='icon' type='image/png' href='/images/UI/favicon.png'>
	</head>
	<body>
		<div>
			{{-- Navigation Bar --}}
			<nav class="navbar navbar-expand navbar-light shadow py-0 px-3" style="z-index: 9999;">
				{{-- Branding --}}
				<a class="navbar-brand m-0 py-0" href="{{route('home')}}" style="height: auto;">
					<img src="/images/UI/Branding.png" style="max-height: 100%;" width="auto" height="50" class="m-0 p-0" />
				</a>

				{{-- Navbar toggler (on small screens) --}}
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="#navbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				{{-- Navbar contents --}}
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav">
						<li class="nav-item">
							@if (\Request::is('/'))
							<span class="nav-link active custom-link">Home</span>
							@else
							<a class="nav-link custom-link" href="{{route('home')}}">Home</a>
							@endif
						</li>

						<li class="nav-item">
							@if(\Request::is('research'))
							<span class="nav-link active custom-link">Research</span>
							@elseif(\Request::is('research/*'))
							<a class="nav-link active custom-link" href="">Research</a>
							@else
							<a class="nav-link custom-link" href="">Research</a>
							@endif
						</li>

						<li class="nav-item">
							<a class="nav-link custom-link" href="">Innovations</a>
						</li>

						<li class="nav-item">
							<a class="nav-link custom-link" href="">Department</a>
						</li>

						<li class="nav-item">
							<a class="nav-link custom-link" href="">Announcements</a>
						</li>

					</ul>
					
				</div>
				
				<div class="float-right">
					<img src="/images/users/default.png" class="circular-border" width='48' height='48' draggable='false'/>
					<label>
						<div class="dropdown">
							<a href='' role="button" class="nav-link dropdown-toggle text-dark" style="font-size: 1.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Anonymous
							</a>
							
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Separated link</a>
							</div>
						</div>
					</label>
				</div>
			</nav>

			{{-- Page Contents --}}
			<div style="max-width: 100vw!important;">
				@yield('body')
			</div>

			{{-- Footer --}}
			<div class="row justify-content-center p-3 footer" style="background-color: #444; max-width: 100vw;">
				{{-- Add-On --}}
				<div class="col-12 col-lg-2 order-1 order-lg-0 text-center text-lg-left my-3">
					<a href="/">Home</a><br>
					<a href="">Researchers</a><br>
					<a href="">Research</a><br>
					<a href="">Innovations</a><br>
				</div>

				{{-- Contents --}}
				<div class="col-12 col-lg-2 order-2 order-lg-1 text-center text-lg-left my-3">
					<span class="font-weight-bold">Departments</span><br>
					<a href="">Computer Science</a><br>
				</div>

				{{-- About Me --}}
				<div class="col-12 col-lg-2 order-3 order-lg-2 text-center text-lg-left my-3">
					<a href="">About Us</a><br>
					<a href="">Our Partners</a><br>
					<a href="">Contact Us</a><br>
				</div>
					
				{{-- Website --}}
				<div class="col-12 col-lg-2 order-4 order-lg-3 text-center text-lg-left my-3">
					<a href="">Privacy Policy</a><br>
					<a href="">Terms of Use</a><br>
				</div>

				{{-- Branding --}}
				<div class="col-12 col-lg-4 order-0 order-lg-4 text-center my-3">
					<img src="/images/UI/Branding.png" style="max-height: 100%" height="125" width="auto" class="pb-0 mb-0"><br>
					<small class="pt-0 mt-0 display-block">&copy; Myriad Files 2021-2023</small>
				</div>
			</div>
		</div>

		{{-- Scripts --}}
		@yield('script')

		<script type="text/javascript">
			$(document).ready(function() {
				$('.items-inherit-height .custom-link').addClass('py-auto');
			});
		</script>
	</body>
</html>