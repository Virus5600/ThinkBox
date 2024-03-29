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
					@if ($user->user->avatar == null)
					<img src='/uploads/users/default.png' class='img-fluid invisiborder circle-border w-75'/>
					@else
					<img src='/uploads/users/user{{$user->user->id}}/{{$user->user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
					@endif
				</div>

				<div class="col-12 col-md-8">
					<h1>{{$user->getFullName()}}</h1>
					<h4>{{ucwords(preg_replace("/_/", " ", $user->positionAttr->type))}}, {{$user->location}}</h4>
					<h4 class="font-weight-normal"><em>
						@if ($user->position == 1)
							{{ucwords(\App\College::find($user->department)->name)}}
							@php
								echo "(";
								foreach (explode(" ", \App\College::find($user->department)->name) as $w) {
									if (ctype_upper(substr($w, 0, 1)))
										echo substr($w, 0, 1);
								}
								echo ")";
							@endphp
						@else
							{{\App\Departments::find($user->department)->name}}
						@endif
					</em></h4>
					<br>
					<p class="text-muted">
						<span class="mr-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-phone-alt mr-2 fa-sm text-custom"></i>{{$user->user->contact_no == '' ? 'Not Available' : '+63' . $user->user->contact_no}}</span>
						<span class="ml-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-envelope mr-2 fa-sm text-custom"></i><a class="text-muted" href="mailto:{{$user->user->email}}">{{$user->user->email}}</a></span>
					</p>

					<p class="a-fa-hover-zoom-2">
						@foreach($user->user->otherProfiles as $o)
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
	
	{{-- COURSE MATERIALS --}}
	<h2 class="text-custom-2 my-2 mb-3">COURSE MATERIALS</h2>
	<hr class="hr-thick my-3">

	<div class="row my-3">
		<form class="col-12 col-lg-3 order-0" action="{{route('profile.materials')}}" method="GET">
			<div class="input-group my-3">
				<input type="text" class="form-control" name='search' placeholder="Search..." value="{{$searchVal}}" />
				<div class="input-group-append">
					<button type="submit" class="btn btn-custom"><i class="fas fa-search"></i></button>
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
		</form>

		<div class="col-12 col-md-9">
			<div class="container-fluid">
				{{-- TOPIC BEGIN --}}
				@forelse($topic_names as $t)
				@php
				$topic = App\Topic::where('topic_name', '=', $t)->first();
				$material = App\Material::where('topic_id', '=', $topic->id)->where('faculty_staff_id', '=', App\FacultyStaff::where('user_id', '=', Auth::user()->id)->first()->id)->get();
				@endphp
				<h4>{{$t}} ({{count($material)}})</h4>
				<div class="row flex-row flex-nowrap overflow-x-auto p-2 div-hover-zoom">
					{{-- MATERIALS BEGIN --}}
					@foreach ($material as $m)
					<div class="col-12 col-md-4 m-3 bg-custom-light p-3">
						<p><em>{{$t}}</em></p>

						<p class="font-weight-bold">
							<a href="{{$m->url}}" class="text-decoration-none text-dark">
								{{$m->material_name}}
							</a>
						</p>

						<p class="readmore" data-rm-show-lines='3'>
							{{$m->description}}
							<span class="readmore-link readmore-link-custom-bg text-custom-2"></span>
						</p>
					</div>
					@endforeach
					{{-- MATERIOALS END --}}
				</div>
				@empty
				<div class="row flex-row flex-nowrap overflow-x-auto p-2">
					<h4>Nothing to show</h4>
				</div>
				@endforelse
				{{-- TOPIC END --}}
			</div>
		</div>
	</div>
</div>
@endsection