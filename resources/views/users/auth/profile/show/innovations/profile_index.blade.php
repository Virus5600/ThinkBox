@extends('template.user')

@section('title', 'Faculty')

@section('body')
<h2 class="mx-5 my-4"><a href="{{route('profile.index')}}" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-3"></i>Profile</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	{{-- DETAILS --}}
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="row">
				<div class="col-12 col-md-4 text-center">
					<img src='/images/TEMPORARY/home/user{{$id}}.jpg' class='img-fluid invisiborder circle-border w-75'/>
				</div>

				<div class="col-12 col-md-8">
					<h1>{{$user->name}}</h1>
					<h4>{{$user->position}}</h4>
					<h4 class="font-weight-normal"><em>{{$user->department}}</em></h4>
					<br>
					<p class="text-muted">
						<span class="mr-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-phone-alt mr-2 fa-sm text-primary"></i>{{$user->contact_no == '' ? '' : '+63 ' . $user->contact_no}}</span>
						<span class="ml-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-envelope mr-2 fa-sm text-primary"></i><a class="text-muted" href="mailto:{{$user->email}}">{{$user->email}}</a></span>
					</p>

					<p>
						<a href="" class="mx-1"><i class="fab fa-facebook text-dark fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fas fa-atom text-light fa-2x bg-dark invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-twitter text-light fa-2x bg-dark invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-linkedin-in text-light fa-2x bg-dark invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-github text-dark fa-2x"></i></a>
					</p>
				</div>
			</div>
		</div>
	</div>
	
	{{-- PUBLISHED INNOVATIONS --}}
	<h2 class="text-custom-2 my-2 mb-3">PUBLISHED INNOVATIONS</h2>
	<hr class="hr-thick my-3">

	<div class="row my-3">
		<div class="col-12 col-md-3 order-0">
			<div class="input-group my-3">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sort" class="custom-select">
					<option value="titleAsc" selected>Title (A-Z)</option>
					<option value="titleDesc">Title (Z-A)</option>
					<option value="datePublished">Date Published</option>
				</select>
			</div>
		</div>

		<div class="col-12 col-md-9 div-hover-zoom">
			@foreach ($innovations as $i)
			<div class="row">
				<div class="col my-3 mx-5 bg-custom-light p-3">
					<p class="font-weight-bold">
						{{$i->title}}
					</p>

					<p>
						<small><em>{{$i->authors}} | {{$i->date_published->format('D Y')}}</em></small>
					</p>

					<p class="text-truncate-3">
						{{$i->description}}
					</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection