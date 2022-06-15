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
		<meta name="image" content="/images/UI/banners/faculty.jpg">
		<meta name="image:alt" content="/images/UI/banners/faculty.jpg">
		<meta name="keywords" content="">
		<meta name="application-name" content="Defensive Measures Add-on Guide">

		{{-- OG META --}}
		<meta name="og:url" content="">
		<meta name="og:type" content="website">
		<meta name="og:title" content="{{ env('APP_NAME') }}">
		<meta name="og:description" content="{{ env('APP_DESC') }}">
		<meta name="og:image" content="images/UI/banners/faculty.jpg">
		<meta name="og:image:alt" content="images/UI/banners/faculty.jpg">

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

		{{-- Chart.js 3.1.1 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js" integrity="sha512-BqNYFBAzGfZDnIWSAEGZSD/QFKeVxms2dIBPfw11gZubWwKUjEgmFUtUls8vZ6xTRZN/jaXGHD/ZaxD9+fDo0A==" crossorigin="anonymous"></script>

		{{-- Summernote 0.8.18 --}}
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js" defer></script>

		{{-- Custom CSS --}}
		@yield('css')

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Input Mask 5.0.5 --}}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>

		{{-- Read More --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('css/readmore.css') }}">
		<script type="text/javascript" src="{{ asset('js/readmore.js') }}"></script>

		{{-- Local CSS --}}
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

		{{-- Favicon --}}
		<link rel='icon' type='image/png' href='{{ asset("images/UI/favicon.png") }}'>
		
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
				<div class="container">
					{{-- Branding --}}
					<a class="navbar-brand m-0 py-0" href="{{route('dashboard')}}" style="height: auto;">
						<img src="{{ asset('images/UI/Branding.png') }}" style="max-height: 3.25rem;" class="m-0 p-0" alt="ThinkBox" />
					</a>

					<div class="d-flex flex-row">
						{{-- Navbar contents --}}
						<div class="navbar-collapse" id="navbar">
							<div class="ml-auto">
								@if (!Auth::user()->isAvatarLink)
									@if (Auth::user()->avatar == null)
									<img src="{{ asset('uploads/users/default.png') }}" class="circular-border" width='30' height='30' draggable='false' alt="User"/>
									@else
									<img src="{{ asset('uploads/users/user' . Auth::user()->id . '/' . Auth::user()->avatar) }}" class="circular-border" width='30' height='30' draggable='false' alt="User"/>
									@endif
								@endif
								<label>
									<div class="dropdown">
										<a href='' role="button" class="nav-link dropdown-toggle text-dark dynamic-size-lg-h6" style="font-size: 1.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{Auth::user()->first_name}} {{Auth::user()->last_name}}
										</a>

										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="{{route('home')}}">View Home Page</a>
											<a class="dropdown-item" href="{{route('research')}}">View Research Page</a>
											<a class="dropdown-item" href="{{route('innovations')}}">View Innovations Page</a>
											<a class="dropdown-item" href="{{route('faculty.index')}}">View Department Page</a>
											<a class="dropdown-item" href="{{route('announcements.index')}}">View Announcements Page</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="{{route('logout')}}">Sign out</a>
										</div>
									</div>
								</label>
							</div>
						</div>

						{{-- Navbar Toggler --}}
						<button class="sidebar-toggler" type="button" data-toggle="sidebar-collapse" data-target="#sidebar" aria-controls="sidebar" aria-label="Toggle Sidebar">
							<span class="navbar-toggler-icon"></span>
						</button>
					</div>
				</div>
			</nav>

			<div class="d-flex flex-d-row flex-grow-1" style="overflow: hidden;">
				{{-- Navigation Bar (SIDE) --}}
				<div class="sidebar dark-shadow custom-scroll d-flex flex-d-col py-3 px-0 collapse-horizontal overflow-y-auto" id="sidebar">
					@if (\Request::is('admin/dashboard'))
					<span class="bg-custom text-white"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</span>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
					@endif

					@if (\Request::is('admin/faculty-member'))
					<span class="bg-custom text-white"><i class="fas fa-chalkboard-teacher mr-2"></i>Faculty Members</span>
					@elseif (\Request::is('admin/faculty-member/*'))
					<a class="text-decoration-none bg-custom text-white" href="{{ route('admin.faculty-member.index') }}"><i class="fas fa-chalkboard-teacher mr-2"></i>Faculty Members</a>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('admin.faculty-member.index') }}"><i class="fas fa-chalkboard-teacher mr-2"></i>Faculty Members</a>
					@endif

					@if (\Request::is('admin/users'))
					<!-- <span class="bg-custom text-white"><i class="fas fa-users mr-2"></i>Users</span> -->
					@elseif (\Request::is('admin/users/*'))
					<!-- <a class="text-decoration-none bg-custom text-white" href="{{ route('admin.faculty-member.index') }}"><i class="fas fa-users mr-2"></i>Users</a> -->
					@else
					<!-- <a class="text-decoration-none text-dark" href="{{ route('admin.faculty-member.index') }}"><i class="fas fa-users mr-2"></i>Users</a> -->
					@endif

					@if (\Request::is('admin/announcements'))
					<span class="bg-custom text-white"><i class="fas fa-bullhorn mr-2"></i>Announcements</span>
					@elseif (\Request::is('admin/announcements/*'))
					<a class="text-decoration-none bg-custom text-white" href="{{ route('admin.announcements.index') }}"><i class="fas fa-bullhorn mr-2"></i>Announcements</a>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('admin.announcements.index') }}"><i class="fas fa-bullhorn mr-2"></i>Announcements</a>
					@endif

					@if (\Request::is('admin/skills'))
					<span class="bg-custom text-white"><i class="fas fa-pencil-ruler mr-2"></i>Skills</span>
					@else
					<a class="text-decoration-none text-dark" href="{{ route('admin.skills.index') }}"><i class="fas fa-pencil-ruler mr-2"></i>Skills</a>
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
		<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
		<script type="text/javascript">
			@if (Session::has('flash_error'))
			Swal.fire({
				{!!Session::has('has_icon') ? "icon: `error`," : ""!!}
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
			@elseif (Session::has('flash_message') || Session::has('flash_info'))
			Swal.fire({
				{!!Session::has('has_icon') ? "icon: `info`," : ""!!}
				title: `{{Session::has('flash_message') ? Session::get('flash_message') : Session::get('flash_info') }}`,
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
				{!!Session::has('has_icon') ? "icon: `success`," : ""!!}
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

			$(document).ready(function() {
				// Summernote
				$('.summernote').summernote({
					minHeight: 128,
					maxHeight: 384,
					height: 256,
					placeholder: 'Content goes here...',
					toolbar: [
						['style', ['style']],
						['font', ['bold', 'underline', 'clear']],
						['fontname', ['fontname', 'fontsize']],
						['color', ['color']],
						['para', ['ul', 'ol', 'paragraph']],
						['table', ['table']],
						['insert', ['link', 'hr']],
						['view', ['fullscreen', 'codeview', 'help']],
						['history', ['undo', 'redo']]
					],
					popover: {
						link: [
							['link', ['linkDialogShow', 'unlink']]
						],
						table: [
							['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
							['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
						]
					}
				});
			});
		</script>
	</body>
</html>