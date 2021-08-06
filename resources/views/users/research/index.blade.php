@extends('template.user')

@section('title', 'Research')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/research.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light h3 h1-md">Research</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light h4">Scan through vast researches by our experts.</p>
		</div>
	</div>
</div>

<div class="container-fluid my-5 mb-7">
	<div class="row">
		<form class="col-12 col-lg-3" action="{{route('research')}}" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." value="{{$searchVal}}"/>
				<div class="input-group-append">
					<button type="submit" class="btn bg-custom text-white"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Filter by Department</span>
			<div class="input-group">
				<select name="dept" class="custom-select" onchange="$('#researchParamSubmit').trigger('click');">
					<option value="All" {{$dept == 'All' ? 'selected' : ''}}>All</option>
					@foreach($college as $c)
					<option></option>
					<option value="{{$c->name}}" class="font-weight-bold" {{$dept == $c->name ? 'selected' : ''}}>
						{{ucwords($c->name)}}{{$c->abbr != null ? ' (' . $c->abbr . ')' : ''}}
					</option>
					@foreach($c->departments as $d)
					<option value="{{$d->name}}" {{$dept == $d->name ? 'selected' : ''}}>{{ucwords($d->name)}}</option>
					@endforeach
					@endforeach
				</select>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sortBy" class="custom-select" onchange="$('#researchParamSubmit').trigger('click');">
					<option value="authorFirstName" {{$sortBy == 'authorFirstName' ? 'selected' : ''}}>Author First Name</option>
					<option value="authorLastName" {{$sortBy == 'authorLastName' ? 'selected' : ''}}>Author Last Name</option>
					<option value="date" {{$sortBy == 'date' ? 'selected' : ''}}>Date</option>
					<option value="title" {{$sortBy == 'title' ? 'selected' : ''}}>Title</option>
				</select>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Research Focus</span>
			<div class="input-group">
				<select name="researchFocus" class="custom-select" onchange="$('#researchParamSubmit').trigger('click');">
					<option value="all">All</option>
					@foreach ($focus as $f)
					<option value='{{$f->name}}' {{$researchFocus == $f->name ? 'selected' : ''}}>{{ucwords($f->name)}}</option>
					@endforeach
				</select>
			</div>

			<input type="submit" class="hidden" id="researchParamSubmit">
		</form>

		<div class="col-12 col-lg-9">
			<div class="row my-3 mx-1">
				{{-- RESEARCH --}}
				@forelse ($research as $r)
				<div class="col-12 col-lg-4 p-0 my-3">
					<div class="mx-2 my-1 invisiborder rounded dark-shadow d-flex flex-d-col h-100">
						<div class="card-body">
							<div class="card-title">
								<div class="row">
									<div class="col-12 align-items-center">
										<div class="row vertical-lg-card">
											<div class="col-12 col-md-3 text-center px-0">
												@if ($r->user->isAvatarLink)
													<img src='{{$r->user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
												@else
													@if ($r->user->avatar == null)
													<img src='/uploads/users/default.png' class='img-fluid invisiborder circle-border w-75'/>
													@else
													<img src='/uploads/users/user{{$r->user->id}}/{{$r->user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
													@endif
												@endif
											</div>

											<div class="col-12 col-md-9 ml-0 pl-1 text-center text-sm-left">
												<a class="text-dark text-decoration-none" href="{{route('faculty.show', [$r->id])}}">
													<h5 class="h2 h5-lg m-0 text-truncate-2">
														{{$r->user->title == null ? '' : $r->user->title . ' '}}{{$r->user->first_name}} {{$r->user->middle_name == null ? '' : substr($r->user->middle_name, 0) . '. '}}{{$r->user->last_name}}{{$r->user->suffix == null ? '' : ', ' . $r->user->suffix}}
													</h5>
													<p class="h4 h6-lg m-0 text-truncate-2">
														{{ucwords(preg_replace("/_/", " ", $r->facultyStaff->positionAttr->type))}}, {{$r->facultyStaff->location}}
													</p>
												</a>
											</div>
										</div>
									</div>

									<div class="col-12">
										<h4 class="text-truncate-2 mt-3 mb-0 tooltip-html" data-toggle="tooltip" data-placement="bottom" title="{{$r->title}}">
											{{$r->title}}
										</h4>
										
										<p class="text-truncate-2">
											<small><em>
												@for ($i = 0; $i < count($r->researchAuthors); $i++)
													@if ($i-1 == count($r->researchAuthors) || $r->authors != null)
														<a class="text-dark" href="{{route('faculty.show', [$r->researchAuthors[$i]->staff->id])}}">{{ucwords($r->researchAuthors[$i]->user->first_name)}} {{$r->user->middle_name == null ? '' : ucfirst(substr($r->researchAuthors[$i]->user->middle_name, 0))}} {{ucwords($r->researchAuthors[$i]->user->last_name)}}</a>,
													@else
														<a class="text-dark" href="{{route('faculty.show', [$r->researchAuthors[$i]->staff->id])}}">{{ucwords($r->researchAuthors[$i]->user->first_name)}} {{$r->user->middle_name == null ? '' : ucfirst(substr($r->researchAuthors[$i]->user->middle_name, 0))}} {{ucwords($r->researchAuthors[$i]->user->last_name)}}</a>
													@endif
												@endfor

												{{preg_replace('/,/', ', ', $r->authors)}} | {{\Carbon\Carbon::parse($r->date_published)->format("M Y")}}
											</em></small>
										</p>
										
										<div class="card-text text-truncate-5">
											{{$r->description}}
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