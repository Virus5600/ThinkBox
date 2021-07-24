@extends('template.user')

@section('title', 'Faculty')

@section('body')
<h2 class="mx-5 my-4"><a href="{{route('faculty.show', [$id])}}" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-3"></i>Profile</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	{{-- DETAILS --}}
	<div class="row">
		<div class="col-12 col-md-8 offset-md-2">
			<div class="row">
				<div class="col-12 col-md-4 text-center">
					@if ($staff->user->avatar == null)
					<img src='/uploads/users/default.png' class='img-fluid invisiborder circle-border w-75'/>
					@else
					<img src='/uploads/users/user{{$staff->user->id}}/{{$staff->user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
					@endif
				</div>

				<div class="col-12 col-md-8">
					<h1>{{$staff->getFullName()}}</h1>
					<h4>{{ucwords(preg_replace("/_/", " ", $staff->positionAttr->type))}}, {{$staff->location}}</h4>
					<h4 class="font-weight-normal"><em>
						@if ($staff->position == 1)
							{{ucwords(\App\College::find($staff->department)->name)}}
							@php
								echo "(";
								foreach (explode(" ", \App\College::find($staff->department)->name) as $w) {
									if (ctype_upper(substr($w, 0, 1)))
										echo substr($w, 0, 1);
								}
								echo ")";
							@endphp
						@else
							{{\App\Departments::find($staff->department)->name}}
						@endif
					</em></h4>
					<br>
					<p class="text-muted">
						<span class="mr-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-phone-alt mr-2 fa-sm text-custom"></i>{{$staff->user->contact_no == '' ? '' : '+63' . $staff->user->contact_no}}</span>
						<span class="ml-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-envelope mr-2 fa-sm text-custom"></i><a class="text-muted" href="mailto:{{$staff->email}}">{{$staff->user->email}}</a></span>
					</p>

					<p class="a-fa-hover-zoom-2">
						@foreach($staff->user->otherProfiles as $o)
						@if ($o->website == 'Facebook')
						<a href="{{$o->url}}" class="mx-1"><i class="fab fa-facebook text-dark secondary-hover fa-2x"></i></a>
						@elseif ($o->website == 'Google Scholar')
						<a href="{{$o->url}}" class="mx-1"><i class="fas fa-atom text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						@elseif ($o->website == 'Twitter')
						<a href="{{$o->url}}" class="mx-1"><i class="fab fa-twitter text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						@elseif ($o->website == 'LinkedIn')
						<a href="{{$o->url}}" class="mx-1"><i class="fab fa-linkedin-in text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						@elseif ($o->website == 'Github')
						<a href="{{$o->url}}" class="mx-1"><i class="fab fa-github text-dark secondary-hover fa-2x"></i></a>
						@endif
						@endforeach
					</p>
				</div>
			</div>
		</div>
	</div>
	
	{{-- PUBLISHED INNOVATIONS --}}
	<h2 class="text-custom-2 my-2 mb-3">PUBLISHED INNOVATIONS</h2>
	<hr class="hr-thick my-3">

	<div class="row my-3">
		<form class="col-12 col-md-3 order-0" action="{{ route('faculty.innovations', [$id]) }}" method="GET">
			<div class="input-group my-3">
				<input type="text" class="form-control" name='search' placeholder="Search..." value="{{$searchVal}}" />
				<div class="input-group-append">
					<button type="submit" class="btn btn-custom"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sortBy" class="custom-select" onchange="$('#innovationsParamSubmit').trigger('click');">
					<option value="titleAsc" {{$sortBy == 'none' || $sortBy == 'titleAsc' ? 'selected' : ''}}>Title (A-Z)</option>
					<option value="titleDesc" {{$sortBy == 'titleDesc' ? 'selected' : ''}}>Title (Z-A)</option>
					<option value="date" {{$sortBy == 'date' ? 'selected' : ''}}>Date Published</option>
				</select>
			</div>

			<input type="submit" class="hidden" id="innovationsParamSubmit">
		</form>

		<div class="col-12 col-md-9 div-hover-zoom">
			@foreach ($innovations as $i)
			<div class="row my-3 bg-custom-light mx-1 p-3">
				<div class="col-12">
					<p class="font-weight-bold">
						{{$i->title}}
					</p>

					<p>
						<small><em>{{preg_replace('/,/', ', ', $i->authors)}} | {{\Carbon\Carbon::parse($i->date_published)->format('M d, Y')}}</em></small>
					</p>

					<p class="text-truncate-3">
						{{$i->description}}
					</p>

					<p>
						<a class="float-right text-decoration-none read-more" href="{{route('innovations.show', [$i->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
					</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection