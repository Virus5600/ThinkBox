@extends('template.user')

@section('title', 'Home')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 100vh!important; background: #fff url('/images/UI/banners/index.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100%;">
		<div class="col-6 ml-5 banner-text-adjust">
			<h1 class="text-light h3 h1-md">
				Countless number of IDEAS<br>
				that is INNOVATIVE, in a form of file
			</h1>

			<hr class="hr-thick" style="border-color: white;" />
		</div>
	</div>
</div>

<div class="container-fluid my-5 striped">

	{{-- ANNOUNCEMENT --}}
	<div class="row my-5">
		<div class="col">
			<p class="m-0 text-center">
				<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Latest Announcements</span>
			</p>

			{{-- MAX: 3 ANNOUNCEMENTS --}}
			<div class="row mt-5">
				<div class="col col-md-10 offset-md-1">
					<div class="card-deck">
						@foreach ($announcements as $a)
						<div class="card dark-shadow">
							<div class="card-body">
								<div class="announcement-img" style="background: #fff url('/images/TEMPORARY/home/{{$a->image}}') no-repeat center"></div>
								<h5 class="card-title text-truncate-2">{{$a->title}}</h5>
								<div class="card-text">{!!$a->content!!}</div>
							</div>
							
							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{$a->source}}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='fb-messenger://share?link={{$a->source}}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://twitter.com/share?text={{preg_replace("/\s/", "%20",$a->title)}}&url={{$a->source}}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
										<a class="dropdown-item bg-light" href="javascript:void(0)" data-copy-link='{{$a->source}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
									</div>
								</div>

								<a class="float-right text-decoration-none read-more underline-at-hover" href="{{ route('announcements.show', [$a->id]) }}">View Details <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none under" href="{{route('announcements.index')}}">View More</a></span>
			</p>
		</div>
	</div>

	{{-- LATEST RESEARCH --}}
	<div class="row my-5">
		<div class="col">
			<p class="m-0 text-center">
				<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Latest Research</span>
			</p>

			{{-- MAX: 3 RESEARCH --}}
			@if (count($research) > 0)
			<div class="row mt-5">
				<div class="col col-md-10 offset-md-1">
					<div class="card-deck">
						@foreach ($research as $r)
						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/{{\App\Http\Controllers\TmpController::getUser($r->posted_by)->avatar}}" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
											<div class="d-flex flex-d-col">
												<h3 class="h4 mx-2 my-0"><a class="text-dark text-decoration-none" href=''>{{\App\Http\Controllers\TmpController::getUser($r->posted_by)->name}}</a></h3>
												<p class="mx-2 my-0">{{\App\Http\Controllers\TmpController::getUser($r->posted_by)->position}}</p>
											</div>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">{{$r->title}}</h4>
											
											<p class="text-truncate-2">
												<small><em>{{$r->authors}} | {{$r->date_published->format('M Y')}}</em></small>
											</p>

											<div class="card-text text-truncate-5">
												{{$r->description}}
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown underline-at-hover' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left underline-at-hover" aria-labelledby='share'>
										@if ($r->is_file)
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="http://www.facebook.com/sharer.php?u={{route('research.show', [$r->id])}}"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="fb-messenger://share?link={{route('research.show', [$r->id])}}"><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="http://twitter.com/share?url={{route('research.show', [$r->id])}}"><i class="fab fa-twitter mr-2"></i>Twitter</a>
										<a class="dropdown-item bg-light" href="javascript:void(0)" data-copy-link='{{route("research.show" , [$r->id])}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
										@else
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{$r->url}}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='fb-messenger://share?link={{$r->url}}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://twitter.com/share?url={{$r->url}}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
										<a class="dropdown-item bg-light" href="javascript:void(0)" data-copy-link='{{$r->url}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
										@endif
									</div>
								</div>

								@if ($r->is_file)
								<a class="float-right text-decoration-none read-more underline-at-hover" href="{{route('research.show', [$r->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
								@else
								<a class="float-right text-decoration-none read-more underline-at-hover" target="_blank" href='{{$r->url}}'>View Details <i class="fas fa-chevron-right"></i></a>
								@endif
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{route('research')}}">View More</a></span>
			</p>
		</div>
	</div>
	@endif

	{{-- LATEST INNOVATIONS --}}
	@if (count($innovations) > 0)
	<div class="row my-5">
		<div class="col">
			<p class="m-0 text-center">
				<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Latest Innovations</span>
			</p>

			{{-- MAX: 3 INNOVATIONS --}}
			<div class="row mt-5">
				<div class="col col-md-10 offset-md-1">
					<div class="card-deck">
						@foreach ($innovations as $i)
						<div class="card dark-shadow">
							<div class="card-body">
								<div class="card-title">
									<div class="row">
										<div class="col-12 d-flex align-items-center">
											<img src="/images/TEMPORARY/home/{{\App\Http\Controllers\TmpController::getUser($i->posted_by)->avatar}}" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
											<div class="d-flex flex-d-col">
												<h3 class="h4 mx-2 my-0"><a class="text-dark text-decoration-none" href=''>{{\App\Http\Controllers\TmpController::getUser($i->posted_by)->name}}</a></h3>
												<p class="mx-2 my-0">{{\App\Http\Controllers\TmpController::getUser($i->posted_by)->position}}</p>
											</div>
										</div>

										<div class="col-12">
											<h4 class="text-truncate text-custom my-3">{{$i->title}}</h4>
											
											<p class="text-truncate-2">
												<small><em>{{$i->authors}} | {{$i->date_published->format('M Y')}}</em></small>
											</p>

											<div class="card-text text-truncate-5">
												{{$i->description}}
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="card-footer">
								<div class="dropdown display-inline-block float-left">
									<a class='dropdown-toggle text-decoration-none share-dropdown underline-at-hover' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-share-alt mr-1"></i> Share
									</a>

									<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
										@if ($i->is_file)
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="http://www.facebook.com/sharer.php?u={{route('innovations.show', [$i->id])}}"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="fb-messenger://share?link={{route('innovations.show', [$i->id])}}"><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link="http://twitter.com/share?url={{route('innovations.show', [$i->id])}}"><i class="fab fa-twitter mr-2"></i>Twitter</a>
										<a class="dropdown-item bg-light" href="javascript:void(0)" data-copy-link='{{route("innovations.show" , [$i->id])}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
										@else
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{$i->url}}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
										{{-- <a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='fb-messenger://share?link={{$i->url}}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
										<a class="dropdown-item share-link bg-light" href="javascript:void(0)" data-link='http://twitter.com/share?url={{$i->url}}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
										<a class="dropdown-item bg-light" href="javascript:void(0)" data-copy-link='{{$i->url}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
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
						@endforeach
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{ route('innovations') }}">View More</a></span>
			</p>
		</div>
	</div>
	@endif

	{{-- FACULTY --}}
	<div class="row my-5">
		<div class="col text-center">
			<span class="h4 h3-md font-weight-bold text-custom border-custom border border-thick border-left-0 border-top-0 border-right-0 px-3">Meet Our Faculty</span>

			{{-- MAX: 4 FACULTY --}}
			<div class="row mt-5">
				<div class="col-10 col-sm-12 col-md-10 offset-1 offset-sm-0 offset-md-1">
					<div class="card-deck">
						@foreach($staff as $s)
						<div class="card dark-shadow">
							<div class="card-header p-0" style="background: #fff url('/images/TEMPORARY/home/{{$s->avatar or 'default.png'}}') no-repeat center; background-size: cover;">
								<div class="p-0 m-0 blur-backdrop">
									<img class="p-0 m-0 img-fluid faculty-img" src='/images/TEMPORARY/home/{{$s->avatar or 'default.png'}}'>
								</div>
							</div>
							<div class="card-body">
								<div class="card-title">
									<h4 class="font-weight-bold">{{$s->name}}</h4>
								</div>

								<p class="card-text">{{$s->position}}</p>
							</div>
							
							<div class="card-footer">
								<a class="float-right text-decoration-none read-more underline-at-hover" href="{{ route('faculty.show', [$s->id]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{ route('faculty.index') }}">View More</a></span>
			</p>
		</div>
	</div>
</div>
@endsection