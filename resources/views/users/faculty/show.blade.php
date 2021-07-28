@extends('template.user')

@section('title', 'Faculty')

@section('body')
<h2 class="mx-5 my-4"><a href="{{route('faculty.index')}}" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-3"></i>Department</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	{{-- DETAILS --}}
	<div class="row">
		<div class="col-12 col-md-8">
			<div class="row">
				<div class="col-12 col-md-4 text-center">
					@if ($staff->user->isAvatarLink)
						<img src='{{$staff->user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
					@else
						@if ($staff->user->avatar == null)
						<img src='/uploads/users/default.png' class='img-fluid invisiborder circle-border w-75'/>
						@else
						<img src='/uploads/users/user{{$staff->user->id}}/{{$staff->user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
						@endif
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
						<span class="ml-lg-3 mx-0 d-block d-lg-revert"><i class="fas fa-envelope mr-2 fa-sm text-custom"></i><a class="text-muted" href="mailto:{{$staff->user->email}}">{{$staff->user->email}}</a></span>
					</p>
				</div>
			</div>

			<div class="row mt-md-4">
				<div class="col-12">
					<h4 class="text-custom-2 font-weight-dold my-2">About</h4>

					<hr class="hr-thick my-2">

					<p>{{$staff->description}}</p>
				</div>

				<div class="col-12">
					<h4 class="text-custom-2 font-weight-bold my-2">Research Focus</h4>

					<hr class="hr-thick my-2">

					<div class="row my-2">
						<div class="col">
							@forelse ($staff->focus as $f)
							<span class="badge badge-pill badge-inverted-secondary mx-1">{{ucwords($f->focus->name)}}</span>
							@empty
							Nothing to show
							@endforelse
						</div>
					</div>
				</div>

				<div class="col-12">
					<h4 class="text-custom-2 font-weight-bold my-2">Skills</h4>

					<hr class="hr-thick my-2">

					<div class="row my-2">
						<div class="col">
							@forelse ($staff->skills as $s)
							<span class="badge badge-pill badge-inverted-secondary mx-1">{{ucwords($s->skill->skill)}}</span>
							@empty
							Nothing to show
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-4 order-1 order-md-1">
			<div class="container-fluid py-2 bg-custom-light">
				<div class="row">
					<div class="col">
						<h4 class="text-custom-2 font-weight-bold">At A Glance</h4>
					</div>
				</div>

				<hr class="hr-thick my-1">

				<div class="row my-2">
					<div class="col text-left">Research Published</div>
					<div class="col text-right font-weight-bold">{{count($research)}}</div>
				</div>

				<div class="row my-2">
					<div class="col text-left">Innovations</div>
					<div class="col text-right font-weight-bold">{{count($innovations)}}</div>
				</div>

				<div class="row my-2">
					<div class="col text-left">Course Materials</div>
					<div class="col text-right font-weight-bold">{{$matCount}}</div>
				</div>

				@if (count($affiliations) > 0)
				<div class="row my-2">
					<div class="col">
						<h4 class="text-custom-2 font-weight-bold">Affiliations</h4>
					</div>
				</div>

				<hr class="hr-thick my-1">

				@foreach ($affiliations as $a)
				<div class="row my-2">
					<div class="col-12 font-weight-bold">{{$a->organization}}</div>
					<div class="col-12"><em>{{$a->position}}</em></div>
				</div>
				@endforeach
				@endif

				@if (count($other_profiles))
				<div class="row my-2 mt-5">
					<div class="col">
						<h4 class="text-custom-2 font-weight-bold">Other Profiles</h4>
					</div>
				</div>

				<hr class="hr-thick my-1">

				<div class="row my-2 mt-3">
					<div class="col text-center a-fa-hover-zoom-2">
						@foreach ($other_profiles as $o)
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
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>

	{{-- UPLOADS --}}
	<div class="row my-5">
		{{-- RESEARCH --}}
		<div class="col-12 col-md-6 div-hover-zoom">
			<h4 class="text-custom-2 font-weight-bold my-2">Latest Researches</h4>

			<hr class="hr-thick my-3">

			@forelse ($research as $r)
			<div class="row my-3 bg-custom-light mx-1 p-3">
				<div class="col-12">
					<div class="row">
						<p class="font-weight-bold">
							{{$r->title}}
						</p>
					</div>

					<div class="row">
						<p>
							<small><em>
								@for ($i = 0; $i < count($r->researchAuthors); $i++)
									@if ($i-1 == count($r->researchAuthors) || $r->authors != null)
										{{ucwords($r->researchAuthors[$i]->user->getFullName())}},
									@else
										{{ucwords($r->researchAuthors[$i]->user->getFullName())}}
									@endif
								@endfor
								
								{{preg_replace('/,/', ', ', $r->authors)}} | {{\Carbon\Carbon::parse($r->date_published)->format('M d, Y')}}
							</em></small>
						</p>
					</div>

					<div class="row">
						<p class="text-truncate-3">
							{{$r->description}}
						</p>
					</div>

					<div class="row">
						<p class="w-100">
							<a class="float-right text-decoration-none read-more underline-at-hover" href="{{route('research.show', [$r->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
						</p>
					</div>
				</div>
			</div>
			@empty
			<span class="w-100 text-center">Nothing to show</span>
			@endforelse

			@if (count($research) > 0)
			<div class="d-block d-md-none col-12 m-0 p-0">
				<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('faculty.research', [$staff->id]) }}">View all research paper</a></span>
			</div>
			@else
			@endif
		</div>

		{{-- INNOVATIONS --}}
		<div class="col-12 col-md-6 div-hover-zoom">
			<h4 class="text-custom-2 font-weight-bold my-2">Latest Innovations</h4>

			<hr class="hr-thick my-3">

			@forelse ($innovations as $i)
			<div class="row my-3 bg-custom-light mx-1 p-3">
				<div class="col-12">
					<div class="row">
						<p class="font-weight-bold">
							{{$i->title}}
						</p>
					</div>

					<div class="row">
						<p>
							<small><em>{{preg_replace('/,/', ', ', $i->authors)}} | {{\Carbon\Carbon::parse($i->date_published)->format('M d, Y')}}</em></small>
						</p>
					</div>

					<div class="row">
						<p class="text-truncate-3">
							{{$i->description}}
						</p>
					</div>

					<div class="row">
						<p class="w-100">
							@if ($i->is_file)
							<a class="float-right text-decoration-none read-more underline-at-hover" href="{{route('innovations.show', [$i->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
							@else
							<a class="float-right text-decoration-none read-more underline-at-hover" target="_blank" href='{{$i->url}}'>View Details <i class="fas fa-chevron-right"></i></a>
							@endif
						</p>
					</div>
				</div>
			</div>
			@empty
			<span class="w-100 text-center">Nothing to show</span>
			@endforelse

			@if (count($innovations) > 0)
			<div class="d-block d-md-none col-12 m-0 p-0">
				<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('faculty.innovations', [$staff->id]) }}">View all innovations</a></span>
			</div>
			@endif
		</div>
	</div>

	<div class="row mt-0 mb-5">
		<div class="hidden-overridable d-md-block col-md-6">
			@if (count($research) > 0)
			<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('faculty.research', [$staff->id]) }}">View all research paper</a></span>
			@endif
		</div>

		<div class="hidden-overridable d-md-block col-md-6">
			@if (count($innovations) > 0)
			<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('faculty.innovations', [$staff->id]) }}">View all innovations</a></span>
			@endif
		</div>
	</div>

	{{-- COURSE MATERIALS --}}
	<div class="row my-5">
		<div class="col-12">
			<h4 class="text-custom-2 font-weight-bold my-2">Latest Materials</h4>

			<hr class="hr-thick my-3">

			<div class="my-3 mx-1 container-fluid">
				<div class="row flex-row flex-nowrap overflow-x-scroll p-2 border border-rounded custom-scrollbar div-hover-zoom" id="matContainer">
					@if (Auth::check())
						@forelse ($materials as $m)
						<div class="mx-3 bg-custom-light text-dark w-50 p-3 col-12 col-md-3">
							<a href="{{$m->url}}" class="text-decoration-none text-dark">
								<p><em>{{$m->topic->topic_name}}</em></p>

								<p class="font-weight-bold">{{$m->material_name}}</p>

								<p>{{$m->description}}</p>
							</a>
						</div>
						@empty
						<h2 class="text-center w-100">Nothing to show</h2>
						<script id="remove">$("#matContainer").addClass("bg-custom-light"); $("#remove").remove();</script>
						@endforelse
					@else
						@include('include.redirect_login', ['route' => route('redirect-login'), 'target_route' => "faculty.show", 'param' => '<input type="hidden" name="param[]" value="'.$staff->id.'">'])
					@endif
				</div>
			</div>

			<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('faculty.materials', [$staff->id]) }}">View all course materials</a></span>
		</div>
	</div>
</div>
@endsection