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
		<meta name="og:image" content="{{asset('images/UI/banners/faculty.jpg')}}">
		<meta name="og:image:alt" content="{{asset('images/UI/banners/faculty.jpg')}}">

		{{-- jQuery 3.6.0 --}}
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

		{{-- popper.js 1.16.0 --}}
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

		{{-- Bootstrap 4.4 --}}
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		{{-- Fontawesome --}}
		<script src="https://kit.fontawesome.com/d4492f0e4d.js" crossorigin="anonymous"></script>

		{{-- Local CSS --}}
		<link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">

		{{-- Favicon --}}
		<link rel='icon' type='image/png' href='{{asset("images/UI/favicon.png")}}'>
		
		{{-- Title --}}
		<title>{{ env('APP_NAME') }} | Page Not Found</title>
	</head>
	
	<body style="height: 100vh;">
		<div class="container-fluid d-flex flex-d-col" style="height: -webkit-fill-available;">
			<div class="container-fluid my-auto mx-0 p-0">
				<div class="row">
					<div class="col-12 col-lg-6 offset-lg-3 text-center">
						<img src="{{asset('images/UI/errors/404.png')}}" height="100%">
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-6 offset-lg-3 text-center">
						<h1 class="text-center">The page you're looking for doesn't exist.</h1>
						<a href="{{url()->previous()}}" class="btn btn-secondary">Go Back</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>