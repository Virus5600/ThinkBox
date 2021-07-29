@extends('template.user')

@section('title', 'Home')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 100vh!important; background: #fff url('/images/UI/banners/index.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100%;">
		<div class="col-6 ml-5 banner-text-adjust">
			<h1 class="text-light h3 h1-md">
				When we work together and<br>
				collaborate, the possibilities are LIMITLESS.
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
					<div class="row">
						@foreach ($announcements as $a)
						<div class="col-12 col-md-4 mx-auto">
							<div class="card dark-shadow h-100">
								<div class="card-body">
									<div class="announcement-img" style="background: #fff url('/uploads/announcements/{{$a->image}}') no-repeat center"></div>
									<h5 class="card-title text-truncate-2">{{$a->title}}</h5>
									<p class="text-truncate-2">
										<small><em>{{preg_replace('/,/', ', ', $a->author->getFullName())}} | {{\Carbon\Carbon::parse($a->created_at)->format('M d, Y')}}</em></small>
									</p>
									<div class="card-text">{!!$a->content!!}</div>
								</div>
								
								<div class="card-footer">
									<div class="dropdown display-inline-block float-left">
										<a class='dropdown-toggle text-decoration-none share-dropdown' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-share-alt mr-1"></i> Share
										</a>

										<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
											<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{ route("announcements.show", [$a->id]) }}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
											{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link={{ route("announcements.show", [$a->id]) }}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
											<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text={{preg_replace("/\s/", "%20",$a->title)}}&url={{ route("announcements.show", [$a->id]) }}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
											<a class="dropdown-item" href="javascript:void(0)" data-copy-link='{{ route("announcements.show", [$a->id]) }}'><i class="fas fa-link mr-2"></i>Copy Link</a>
										</div>
									</div>

									<a class="float-right text-decoration-none read-more underline-at-hover" href="{{ route('announcements.show', [$a->id]) }}">View Details <i class="fas fa-chevron-right"></i></a>
								</div>
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
					<div class="row">
						@foreach ($research as $r)
						<div class="col-12 col-md-4 mx-auto">
							<div class="card dark-shadow h-100">
								<div class="card-body">
									<div class="card-title">
										<div class="row">
											<div class="col-12 d-flex align-items-center" style="overflow-x: hidden; text-overflow: ellipsis;" data-toggle='tooltip' data-placement='top' title="{{$r->user->title == null ? '' : $r->user->title . ' '}}{{$r->user->first_name}} {{$r->user->middle_name == null ? '' : substr($r->user->middle_name, 0) . '. '}}{{$r->user->last_name}}{{$r->user->suffix == null ? '' : ', ' . $r->user->suffix}}">
												@if ($r->user->isAvatarLink)
													<img src="{{$r->user->avatar}}" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
												@else
													@if ($r->user->avatar == null)
													<img src="/uploads/users/default.png" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
													@else
													<img src="/uploads/users/user{{$r->user->id}}/{{$r->user->avatar}}" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
													@endif
												@endif
												<div class="d-flex flex-d-col" style="overflow-x: hidden; text-overflow: ellipsis;" >
													<h3 class="h4 mx-2 my-0" style="overflow: hidden; text-overflow: ellipsis;" >
														<a class="text-dark text-decoration-none text-truncate" style="overflow-x: hidden; text-overflow: ellipsis;" href="{{route('faculty.show', [$r->posted_by])}}">
															{{$r->user->title == null ? '' : $r->user->title . ' '}}{{$r->user->first_name}} {{$r->user->middle_name == null ? '' : substr($r->user->middle_name, 0) . '. '}}{{$r->user->last_name}}{{$r->user->suffix == null ? '' : ', ' . $r->user->suffix}}
														</a>
													</h3>
													<p class="mx-2 my-0">{{ucwords(preg_replace("/_/", " ", $r->facultyStaff->positionAttr->type))}}, {{$r->facultyStaff->location}}</p>
												</div>
											</div>

											<div class="col-12">
												<h4 class="text-truncate text-custom my-3">{{$r->title}}</h4>
												
												<p class="text-truncate-2">
													<small><em>{{preg_replace('/,/', ', ', $r->authors)}} | {{\Carbon\Carbon::parse($r->date_published)->format('M Y')}}</em></small>
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
										<a class='dropdown-toggle text-decoration-none share-dropdown underline-at-hover' href="javascript:void(0)" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-share-alt mr-1"></i> Share
										</a>

										<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
											<a class="dropdown-item share-link" href="javascript:void(0)" data-link="http://www.facebook.com/sharer.php?u={{route('research.show', [$r->id])}}"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
											{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link="fb-messenger://share?link={{route('research.show', [$r->id])}}"><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
											<a class="dropdown-item share-link" href="javascript:void(0)" data-link="http://twitter.com/share?url={{route('research.show', [$r->id])}}"><i class="fab fa-twitter mr-2"></i>Twitter</a>
											<a class="dropdown-item" href="javascript:void(0)" data-copy-link='{{route("research.show" , [$r->id])}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
										</div>
									</div>

									<a class="float-right text-decoration-none read-more underline-at-hover" href="{{route('research.show', [$r->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
								</div>
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
					<div class="row">
						@foreach ($innovations as $i)
						<div class="col-12 col-md-4 mx-auto">
							<div class="card dark-shadow h-100">
								<div class="card-body">
									<div class="card-title">
										<div class="row">
											<div class="col-12 d-flex align-items-center">
												@if ($i->user->isAvatarLink)
													<img src="{{$i->user->avatar}}" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
												@else
													@if ($i->user->avatar == null)
													<img src="/uploads/users/default.png" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
													@else
													<img src="/uploads/users/user{{$i->user->id}}/{{$i->user->avatar}}" class="circular-border" style="align-self: flex-start;" width='50' height='50' draggable='false' alt="User"/>
													@endif
												@endif
												<div class="d-flex flex-d-col">
													<h3 class="h4 mx-2 my-0">
														<a class="text-dark text-decoration-none" href=''>
															{{$i->user->title == null ? '' : $i->user->title . ' '}}{{$i->user->first_name}} {{$i->user->middle_name == null ? '' : substr($i->user->middle_name, 0) . '. '}}{{$i->user->last_name}}{{$i->user->suffix == null ? '' : ', ' . $i->user->suffix}}
														</a>
													</h3>
													<p class="mx-2 my-0">{{ucwords(preg_replace("/_/", " ", $i->facultyStaff->positionAttr->type))}}, {{$i->facultyStaff->location}}</p>
												</div>
											</div>

											<div class="col-12">
												<h4 class="text-truncate text-custom my-3">{{$i->title}}</h4>
												
												<p class="text-truncate-2">
													<small><em>{{$i->authors}} | {{\Carbon\Carbon::parse($i->date_published)->format('M Y')}}</em></small>
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
										<a class='dropdown-toggle text-decoration-none share-dropdown underline-at-hover' href="javascript:void(0)" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
											<i class="fas fa-share-alt mr-1"></i> Share
										</a>

										<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
											<a class="dropdown-item share-link" href="javascript:void(0)" data-link="http://www.facebook.com/sharer.php?u={{route('innovations.show', [$i->id])}}"><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
											{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link="fb-messenger://share?link={{route('innovations.show', [$i->id])}}"><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
											<a class="dropdown-item share-link" href="javascript:void(0)" data-link="http://twitter.com/share?url={{route('innovations.show', [$i->id])}}"><i class="fab fa-twitter mr-2"></i>Twitter</a>
											<a class="dropdown-item" href="javascript:void(0)" data-copy-link='{{route("innovations.show" , [$i->id])}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
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

			{{-- MAX: 8 FACULTY --}}
			<div class="row mt-5">
				<div class="col-10 col-sm-12 col-md-10 offset-1 offset-sm-0 offset-md-1">
					@php ($i = 0)
					@foreach($staff as $s)
					@if ($i%4 == 0)
					<div class="row mb-4">
					@endif
						<div class="col-12 col-md-3 mr-auto">
							<div class="card dark-shadow h-100">
								@if ($s->user->avatar == null)
								<div class="card-header p-0" style="background: #fff url('/uploads/users/default.png') no-repeat center; background-size: cover;">
								@else
								<div class="card-header p-0" style="background: #fff url('/uploads/users/user{{$s->user->id}}/{{$s->user->avatar}}') no-repeat center; background-size: cover;">
									@endif
									<div class="p-0 m-0 blur-backdrop">
										@if ($s->user->avatar == null)
										<img class="p-0 m-0 img-fluid faculty-img" src="/uploads/users/default.png">
										@else
										<img class="p-0 m-0 img-fluid faculty-img" src="/uploads/users/user{{$s->user->id}}/{{$s->user->avatar}}">
										@endif
									</div>
								</div>
								<div class="card-body">
									<div class="card-title">
										<h4 class="font-weight-bold">{{$s->user->title == null ? '' : $s->user->title . ' '}}{{$s->user->first_name}} {{$s->user->middle_name == null ? '' : substr($s->user->middle_name, 0) . '. '}}{{$s->user->last_name}}{{$s->user->suffix == null ? '' : ', ' . $s->user->suffix}}</h4>
									</div>

									<p class="card-text">{{ucwords(preg_replace("/_/", " ", $s->positionAttr->type))}}, {{ucwords($s->location)}}</p>
								</div>
								
								<div class="card-footer">
									<a class="float-right text-decoration-none read-more underline-at-hover" href="{{ route('faculty.show', [$s->id]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
								</div>
							</div>
						</div>
					@if ($i%4 == 3)
					</div>
					@endif
					@php ($i++)
					@endforeach
				</div>
			</div>

			<p class="mx-0 my-3 text-center">
				<span class="h5 text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="view-more text-decoration-none" href="{{ route('faculty.index') }}">View More</a></span>
			</p>
		</div>
	</div>
</div>
@endsection