<!DOCTYPE html>
<html lang="en">
	<head>
		{{-- META DATA --}}
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{{-- SITE META --}}
		<meta name="url" content="{{ route('home') }}">
		<meta name="type" content="website">
		<meta name="title" content="{{ env('APP_NAME') }}">
		<meta name="description" content="{{ env('APP_DESC') }}">
		<meta name="image" content="/images/UI/banners/meta.jpg">
		<meta name="keywords" content="Repository">
		<meta name="application-name" content="{{ env('APP_NAME') }}">

		{{-- TWITTER META --}}
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="{{ env('APP_NAME') }}">
		<meta name="twitter:description" content="{{ env('APP_DESC') }}">
		<meta name="twitter:image" content="{{Request::url()}}/images/UI/banners/meta.jpg">

		{{-- OG META FOR FACEBOOK AND MESSENGER --}}
		<meta name="og:url" content="{{ route('home') }}">
		<meta name="og:type" content="website">
		<meta name="og:title" content="{{ env('APP_NAME') }}">
		<meta name="og:description" content="{{ env('APP_DESC') }}">
		<meta name="og:image" content="/images/UI/banners/meta.jpg">

		{{-- jQuery 3.6.0 --}}
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

		{{-- jQuery UI 1.12.1 --}}
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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

		{{-- Bootstrap 4 Select --}}
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

		{{-- Custom CSS --}}
		@yield('css')

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Input Mask 5.0.5 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

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
			{{-- Navigation Bar --}}
			<nav class="navbar navbar-expand-lg navbar-light shadow py-0 px-3" style="z-index: 1000;">
				{{-- Branding --}}
				<a class="navbar-brand m-0 py-0" href="{{route('home')}}" style="height: auto;">
					<img src="/images/UI/Branding.jpg" style="max-height: 3.25rem;" class="m-0 p-0" alt="Myriad Files" />
				</a>

				{{-- Navbar toggler (on small screens) --}}
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				{{-- Navbar contents --}}
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							@if (\Request::is('/'))
							<span class="nav-link active custom-link">Home</span>
							@else
							<a class="nav-link custom-link" href="{{route('home')}}">Home</a>
							@endif
						</li>

						<li class="nav-item">
							@if(\Request::is('faculty'))
							<span class="nav-link active custom-link">Department</span>
							@elseif(\Request::is('faculty/*'))
							<a class="nav-link active custom-link" href="{{route('faculty.index')}}">Department</a>
							@else
							<a class="nav-link custom-link" href="{{route('faculty.index')}}">Department</a>
							@endif
						</li>

						<li class="nav-item">
							@if(\Request::is('researches'))
							<span class="nav-link active custom-link">Research</span>
							@elseif(\Request::is('researches/*'))
							<a class="nav-link active custom-link" href="{{route('research')}}">Research</a>
							@else
							<a class="nav-link custom-link" href="{{route('research')}}">Research</a>
							@endif
						</li>

						<li class="nav-item">
							@if(\Request::is('innovations'))
							<span class="nav-link active custom-link">Innovations</span>
							@elseif(\Request::is('innovations/*'))
							<a class="nav-link active custom-link" href="{{route('innovations')}}">Innovations</a>
							@else
							<a class="nav-link custom-link" href="{{route('innovations')}}">Innovations</a>
							@endif
						</li>

						<li class="nav-item">
							@if(\Request::is('announcements'))
							<span class="nav-link active custom-link">Announcements</span>
							@elseif(\Request::is('announcements/*'))
							<a class="nav-link active custom-link" href="{{route('announcements.index')}}">Announcements</a>
							@else
							<a class="nav-link custom-link" href="{{route('announcements.index')}}">Announcements</a>
							@endif
						</li>
					</ul>
					
					@if (Auth::check())
					<div>
						<label class="py-0 my-0">
							<div class="dropdown">
								<a href='' role="button" class="nav-link dropdown-toggle text-dark dynamic-size-lg-h6" style="font-size: 1.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									@if (!Auth::user()->isAvatarLink)
									@if (Auth::user()->avatar == null)
									<img src="/uploads/users/default.png" class="circular-border" width='30' height='30' draggable='false' alt="User"/>
									@else
									<img src="/uploads/users/user{{Auth::user()->id}}/{{Auth::user()->avatar}}" class="circular-border" width='30' height='30' draggable='false' alt="User"/>
									@endif
									@else
									<img src="{{Auth::user()->avatar}}" class="circular-border" width='30' height='30' draggable='false' alt="User"/>
									@endif
									{{Auth::user()->first_name}} {{Auth::user()->last_name}}
								</a>
								
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
									<a class="dropdown-item" href="{{ route('profile.edit', [Auth::user()->id]) }}">Edit Profile</a>
									<a class="dropdown-item" href="{{ route('profile.topics.index') }}">Topics & Materials</a>
									<a class="dropdown-item" href="{{ route('profile.research.index') }}">Research</a>
									<a class="dropdown-item" href="{{ route('profile.innovations.index') }}">Innovations</a>
									@if (Auth::user()->role == 1)
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('admin') }}">Admin Controls</a>
									@endif
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{route('logout')}}">Sign out</a>
								</div>
							</div>
						</label>
					</div>
					@else
					<div class="row">
						<div class="col d-flex fle-d-row">
							@if (\Request::is('login'))
							<span class="nav-link active custom-link">Login</span>
							@else
							<a href="{{route('login')}}" class="nav-link custom-link text-dark">Login</a>
							@endif

							{{-- @if (\Request::is('register')) --}}
							{{-- <span class="nav-link active custom-link">Register</span> --}}
							{{-- @else --}}
							{{-- <a href="{{route('register')}}" class="nav-link custom-link text-dark">Register</a> --}}
							{{-- @endif --}}
						</div>
					</div>
					@endif
				</div>
			</nav>

			{{-- Page Contents --}}
			<div class="flex-fill" style="max-width: 100vw!important;">
				@yield('body')
			</div>

			{{-- Footer --}}
			<div class="row justify-content-center p-3 footer mx-0" style="background-color: #444; max-width: 100vw;">
				<div class="col-12 col-lg-2 order-1 order-lg-0 text-center text-lg-left my-3">
					<a href="{{ route('home') }}">Home</a><br>
					<a href="{{ route('research') }}">Research</a><br>
					<a href="{{ route('innovations') }}">Innovations</a><br>
					<a href="{{ route('announcements.index') }}">Announcements</a>
				</div>

				<div class="col-12 col-lg-2 order-2 order-lg-1 text-center text-lg-left my-3">
					<span class="font-weight-bold">Departments</span><br>
					<a href="{{ route('faculty.index') }}?dept=CompSci">Computer Science</a><br>
				</div>

				<div class="col-12 col-lg-2 order-3 order-lg-2 text-center text-lg-left my-3">
					<a href="">About Us</a><br>
					<a href="">Our Partners</a><br>
					<a href="">Contact Us</a><br>
				</div>
					
				<div class="col-12 col-lg-2 order-4 order-lg-3 text-center text-lg-left my-3">
					<a href="">Privacy Policy</a><br>
					<a href="">Terms of Use</a><br>
				</div>

				{{-- Branding --}}
				<div class="col-12 col-lg-4 order-0 order-lg-4 text-center my-3">
					<img src="/images/UI/Branding.jpg" style="max-height: 100%; max-width: 100%" height="auto" width="350" class="pb-0 mb-0" alt="{{env('APP_NAME')}}"/><br>
					<small class="pt-0 mt-0 display-block">&copy; {{env('APP_NAME')}} 2021-2023</small>
				</div>
			</div>
		</div>

		{{-- Scripts --}}
		@yield('script')

		{{-- Local Script --}}
		<script type="text/javascript">
			@if (Session::has('flash_error'))
			Swal.fire({
				{!!Session::has('has_icon')  && Session::get('has_icon') ? "icon: `error`," : ""!!}
				title: `{{Session::get('flash_error')}}`,
				{!!Session::has('message') ? 'html: `' . Session::get('message') . '`,' : ''!!}
				position: {!!Session::has('position') ? '`' . Session::get('position') . '`' : '`top`'!!},
				showConfirmButton: false,
				toast: {!!Session::has('is_toast') ? Session::get('is_toast') : true!!},
				{!!Session::has('has_timer') ? (Session::get('has_timer') ? (Session::has('duration') ? ('timer: ' . Session::get('duration')) . ',' : `timer: 10000,`) : '') : `timer: 10000,`!!}
				background: `#dc3545`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});
			@elseif (Session::has('flash_message'))
			Swal.fire({
				{!!Session::has('has_icon') && Session::get('has_icon') ? "icon: `info`," : ""!!}
				title: `{{Session::get('flash_message')}}`,
				{!!Session::has('message') ? 'html: `' . Session::get('message') . '`,' : ''!!}
				position: {!!Session::has('position') ? '`' . Session::get('position') . '`' : '`top`'!!},
				showConfirmButton: false,
				toast: {!!Session::has('is_toast') ? Session::get('is_toast') : true!!},
				{!!Session::has('has_timer') ? (Session::get('has_timer') ? (Session::has('duration') ? ('timer: ' . Session::get('duration')) . ',' : `timer: 10000,`) : '') : `timer: 10000,`!!}
				background: `#17a2b8`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});
			@elseif (Session::has('flash_success'))
			Swal.fire({
				{!!Session::has('has_icon')  && Session::get('has_icon') ? "icon: `success`," : ""!!}
				title: `{{Session::get('flash_success')}}`,
				{!!Session::has('message') ? 'html: `' . Session::get('message') . '`,' : ''!!}
				position: {!!Session::has('position') ? '`' . Session::get('position') . '`' : '`top`'!!},
				showConfirmButton: false,
				toast: {!!Session::has('is_toast') ? Session::get('is_toast') : true!!},
				{!!Session::has('has_timer') ? (Session::get('has_timer') ? (Session::has('duration') ? ('timer: ' . Session::get('duration')) . ',' : `timer: 10000,`) : '') : `timer: 10000,`!!}
				background: `#28a745`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});
			@endif

			$(document).ready(() => {
				let paginator = $('nav > ul.pagination');
				paginator.find('li').addClass('page-item');
				paginator.find('li > *').addClass('page-link');
				paginator.find('li:nth-child(1) > *').text('Previous');
				paginator.find('li:nth-last-child(1) > *').text('Next');
			});
		</script>

		<script type="text/javascript" src="/js/user.js"></script>
	</body>
</html>