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

		{{-- Custom CSS --}}
		@yield('css')

		{{-- Local CSS --}}
		<link rel="stylesheet" href="/css/style.css" type="text/css">

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Read More --}}
		<link rel="stylesheet" type="text/css" href="/css/readmore.css">
		<script type="text/javascript" src="/js/readmore.js"></script>

		{{-- Favicon --}}
		<link rel='icon' type='image/png' href='/images/UI/favicon.png'>

		{{-- Title --}}
		<title>{{ env('APP_NAME') }} | @yield('title')</title>
	</head>
	
	<body>
		<div class="d-flex flex-column min-vh-100">
			{{-- Navigation Bar --}}
			<nav class="navbar navbar-expand-lg navbar-light shadow py-0 px-3" style="z-index: 1000;">
				{{-- Branding --}}
				<a class="navbar-brand m-0 py-0" href="{{route('home')}}" style="height: auto;">
					<img src="/images/UI/Branding.png" style="max-height: 100%;" width="auto" height="50" class="m-0 p-0" alt="Myriad Files" />
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
							@if(\Request::is('faculty'))
							<span class="nav-link active custom-link">Department</span>
							@elseif(\Request::is('faculty/*'))
							<a class="nav-link active custom-link" href="{{route('faculty.index')}}">Department</a>
							@else
							<a class="nav-link custom-link" href="{{route('faculty.index')}}">Department</a>
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
					
					<div>
						<img src="/images/TEMPORARY/home/user1.jpg" class="circular-border" width='35' height='35' draggable='false' alt="User"/>
						<label>
							<div class="dropdown">
								<a href='' role="button" class="nav-link dropdown-toggle text-dark dynamic-size-lg-h6" style="font-size: 1.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Angelique Lacasandile
								</a>
								
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
									<a class="dropdown-item" href="{{ route('profile.edit', ['1']) }}">Edit Profile</a>
									<a class="dropdown-item" href="{{ route('profile.materials.index') }}">Topics & Materials</a>
									<a class="dropdown-item" href="{{ route('profile.research.index') }}">Research</a>
									<a class="dropdown-item" href="{{ route('profile.innovations.index') }}">Innovations</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="">Sign out</a>
								</div>
							</div>
						</label>
					</div>
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
					<img src="/images/UI/Branding.png" style="max-height: 100%; max-width: 100%" height="auto" width="350" class="pb-0 mb-0" alt="Myriad Files"/><br>
					<small class="pt-0 mt-0 display-block">&copy; Myriad Files 2021-2023</small>
				</div>
			</div>
		</div>

		{{-- Scripts --}}
		@yield('script')

		<script type="text/javascript">
			function genericSocialShare(url){
				window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
				return true;
			}

			function confirmLeave(urlTo) {
				Swal.fire({
					icon: 'warning',
					html: '<h4>Are you sure?</h4><p>You have unsave changes.</p>',
					showDenyButton: true,
					confirmButtonText: 'Yes',
					denyButtonText: 'No'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = urlTo;
					}
				});
			}

			$(document).ready(function() {
				$('.items-inherit-height .custom-link').addClass('py-auto');

				$('.share-link').click(function() {
					genericSocialShare($(this).attr('data-link'));
				});

				$('[data-toggle=tooltip]').tooltip();
			});
		</script>
	</body>
</html>