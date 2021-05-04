@extends('template.user')

@section('title', 'Innovations')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/innovations.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light h3 h1-md">Innovations</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light h4">Explore the innovations made by our researchers.</p>
		</div>
	</div>
</div>

<div class="container-fluid my-5 mb-7">
	<div class="row">
		<div class="col-12 col-lg-3">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Filter by Department</span>
			<div class="input-group">
				<select name="dept" class="custom-select">
					<option value="All" selected>All</option>
					<option value="CompSci">Computer Science</option>
				</select>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sort" class="custom-select">
					<option value="author">Author</option>
					<option value="date" selected>Date</option>
					<option value="Title">Title</option>
				</select>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Research Focus</span>
			<div class="input-group">
				<select name="focus" class="custom-select">
					@foreach ($focus as $f)
					<option value='{{preg_replace("/\s+/", "_", $f->name)}}'>{{ucwords($f->name)}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-12 col-lg-9">
			<div class="row my-3 mx-1">
				{{-- INNOVATIONS --}}
				@forelse ($innovations as $i)
				<div class="col-12 col-lg-4 p-0 my-3">
					<div class="mx-2 my-1 invisiborder rounded dark-shadow d-flex flex-d-col h-100">
						<div class="card-body">
							<div class="card-title">
								<div class="row">
									<div class="col-12 align-items-center">
										<div class="row">
											<div class="col-12 col-md-3 text-center px-0">
												<img src="/images/TEMPORARY/home/{{\App\Http\Controllers\TmpController::getUser($i->posted_by)->avatar}}" class="circle-border img-fluid" style="max-width: 75%;" draggable='false' alt="User"/>
											</div>

											<div class="col-12 col-md-9 ml-0 pl-1 text-center text-sm-left">
												<a class="text-dark text-decoration-none" href="{{route('faculty.show', [$i->id])}}">
													<h5 class="h2 h5-lg m-0">{{\App\Http\Controllers\TmpController::getUser($i->posted_by)->name}}</h5>
													<p class="h4 h6-lg m-0">{{\App\Http\Controllers\TmpController::getUser($i->posted_by)->position}}</p>
												</a>
											</div>
										</div>
									</div>

									<div class="col-12">
										<h4 class="text-truncate-2 my-3 tooltip-html" data-toggle="tooltip" data-placement="bottom" title="{{$i->title}}">
											{{$i->title}}
										</h4>
										
										<p class="text-truncate-2">
											<small><em>{{$i->authors}} | {{$i->date_published->format("M Y")}}</em></small>
										</p>
										
										<div class="card-text text-truncate-5">
											{{$i->description}}
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="card-footer bg-transparent">
							<div class="dropdown display-inline-block float-left">
								<a class='dropdown-toggle text-decoration-none share-dropdown underline-at-hover' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-share-alt mr-1"></i> Share
								</a>

								<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
									@if ($i->is_file)
									<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="http://www.facebook.com/sharer.php?u={{route('innovations.show', [$i->id])}}"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
									{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="fb-messenger://share?link={{route('innovations.show', [$i->id])}}"><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
									<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="http://twitter.com/share?url={{route('innovations.show', [$i->id])}}"><i class="fab fa-twitter mr-2"></i>Twitter</a>
									@else
									<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{$i->url}}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
									{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='fb-messenger://share?link={{$i->url}}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
									<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://twitter.com/share?url={{$i->url}}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
									@endif
								</div>
							</div>

							@if ($i->is_file)
							<a class="float-right text-decoration-none read-more underline-at-hover" href="{{route('research.show', [$i->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
							@else
							<a class="float-right text-decoration-none read-more underline-at-hover" target="_blank" href='{{$i->url}}'>View Details <i class="fas fa-chevron-right"></i></a>
							@endif
						</div>
					</div>
				</div>
				@empty
				<div class="col-12">
					Nothing to show
				</div>
				@endforelse
			</div>
		</div>
	</div>
</div>
@endsection