@extends('template.user')

@section('title', 'My Profile')

@section('body')
<div class="container-fluid my-5 px-5">
	{{-- DETAILS --}}
	<div class="row">
		<div class="col-12 col-md-8 order-0 order-md-0">
			<div class="row">
				<div class="col-12 col-md-4 text-center">
					<img src='/images/TEMPORARY/home/{{$user->avatar}}' class='img-fluid invisiborder circle-border w-75'/>
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
					<a class="btn text-primary border-primary" href="{{ route('profile.edit', [$user->id]) }}">Edit Profile</a>
				</div>
			</div>

			<div class="row mt-md-4">
				<div class="col-12">
					<h4 class="text-custom-2 font-weight-dold my-2">About</h4>

					<hr class="hr-thick my-2">

					<div>{{$user->description}}</div>
				</div>
				
				<div class="col-12">
					<h4 class="text-custom-2 font-weight-bold my-2">Research Focus</h4>

					<hr class="hr-thick my-2">

					<div class="row my-2">
						<div class="col">
							@forelse ($user->focus as $f)
							<span class="badge badge-pill badge-inverted-secondary mx-1">{{$f->name}}</span>
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
							@forelse ($user->skills as $s)
							<span class="badge badge-pill badge-inverted-secondary mx-1">{{$s->skill}}</span>
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
					<div class="col text-right font-weight-bold">5</div>
				</div>

				<div class="row my-2">
					<div class="col text-left">Innovations</div>
					<div class="col text-right font-weight-bold">3</div>
				</div>

				<div class="row my-2">
					<div class="col text-left">Course Materials</div>
					<div class="col text-right font-weight-bold">12</div>
				</div>

				<div class="row my-2">
					<div class="col">
						<h4 class="text-custom-2 font-weight-bold">Affiliations</h4>
					</div>
				</div>

				<hr class="hr-thick my-1">

				<div class="row my-2">
					<div class="col-12 font-weight-bold">Aguora IT Solutions and Technology Inc.</div>
					<div class="col-12"><em>Co-founder</em></div>
				</div>

				<div class="row my-2">
					<div class="col-12 font-weight-bold">Microsoft</div>
					<div class="col-12"><em>Ambassador</em></div>
				</div>

				<div class="row my-2">
					<div class="col-12 font-weight-bold">House of Representative & TNC Cafe</div>
					<div class="col-12"><em>Technical Consultant</em></div>
				</div>

				<div class="row my-2 mt-5">
					<div class="col">
						<h4 class="text-custom-2 font-weight-bold">Other Profiles</h4>
					</div>
				</div>

				<hr class="hr-thick my-1">

				<div class="row my-2 mt-3">
					<div class="col text-center a-fa-hover-zoom-2">
						<a href="" class="mx-1"><i class="fab fa-facebook text-dark secondary-hover fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fas fa-atom text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-twitter text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-linkedin-in text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-github text-dark secondary-hover fa-2x"></i></a>
					</div>
				</div>
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
							<small><em>{{$r->authors}} | {{$r->date_published}}</em></small>
						</p>
					</div>

					<div class="row">
						<p class="text-truncate-3">
							{{$r->description}}
						</p>
					</div>

					<div class="row">
						<p class="w-100">
							@if ($r->is_file)
							<a class="float-right text-decoration-none read-more underline-at-hover" href="{{route('research.show', [$r->id])}}">View Details <i class="fas fa-chevron-right"></i></a>
							@else
							<a class="float-right text-decoration-none read-more underline-at-hover" target="_blank" href='{{$r->url}}'>View Details <i class="fas fa-chevron-right"></i></a>
							@endif
						</p>
					</div>
				</div>
			</div>
			@empty
			<span class="w-100 text-center">Nothing to show</span>
			@endforelse

			@if(count($research) > 0)
			<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('profile.research', [$user->id]) }}">View all research paper</a></span>
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
							<small><em>{{$i->authors}} | {{$i->date_published}}</em></small>
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
			<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('profile.innovations', [$user->id]) }}">View all innovations</a></span>
			@endif
		</div>
	</div>

	{{-- COURSE MATERIALS --}}
	<div class="row my-5">
		<div class="col-12">
			<h4 class="text-custom-2 font-weight-bold my-2">Latest Materials</h4>

			<hr class="hr-thick my-3">

			<div class="my-3 mx-1 container-fluid">
				<div class="row flex-row flex-nowrap overflow-x-scroll p-2 border border-rounded custom-scrollbar div-hover-zoom">
					<div class="mx-3 bg-custom-light text-dark w-50 p-3 col-12 col-md-3">
						<a href="" class="text-decoration-none text-dark">
							<p><em>Programming</em></p>

							<p class="font-weight-bold">
								Getting started with GitLab
							</p>

							<p>
								In this course material, I will be discussing on how to get started with GitLab to practice version control on all programming related projects. This course materials includes introduction to GitLab, setting up, creating a repository, etc.
							</p>
						</a>
					</div>

					<div class="mx-3 bg-custom-light text-dark w-50 p-3 col-12 col-md-3">
						<a href="" class="text-decoration-none text-dark">
							<p><em>Project Management</em></p>

							<p class="font-weight-bold">
								Developers Timeline
							</p>

							<p>
								In this course material, I will be discussing on how to create a developer's timeline to track project timeline using Microsoft Excel. This material includes formatting of document and creating a Gantt chart. This material would ensure to increase productivity.
							</p>
						</a>
					</div>

					<div class="mx-3 bg-custom-light text-dark w-50 p-3 col-12 col-md-3">
						<a href="" class="text-decoration-none text-dark">
							<p><em>Branding</em></p>

							<p class="font-weight-bold">
								Logo Documentation
							</p>

							<p>
								In this course material, I will be discussing on how to create a documentation for a logo or brand. This material would include the important information that should be in the documentation, formatting the document and detailed user instruction.
							</p>
						</a>
					</div>

					<div class="mx-3 bg-custom-light text-dark w-50 p-3 col-12 col-md-3">
						<a href="" class="text-decoration-none text-dark">
							<p><em>Programming</em></p>

							<p class="font-weight-bold">
								Object-Oriented Programming
							</p>

							<p>
								In this course material, I would be teaching object-oriented programming. It is used to structure a software program into simple, reusable pieces of code blueprints (usually called classes), which are used to create individual instances of objects
							</p>
						</a>
					</div>

					<div class="mx-3 bg-custom-light text-dark w-50 p-3 col-12 col-md-3">
						<a href="" class="text-decoration-none text-dark">
							<p><em>Microsoft</em></p>

							<p class="font-weight-bold">
								Basics of MS Powerpoint
							</p>

							<p>
								PowerPoint presentations work like slide shows. To convey a message or a story, you break it down into slides. Think of each slide as a blank canvas for the pictures and words that help you tell your story. In this course material, I would be teaching you on how to
							</p>
						</a>
					</div>
				</div>
			</div>

			<span class="text-center font-weight-bold border-custom border border-thick border-left-0 border-top-0 border-right-0 px-1"><a class="text-custom-2 text-decoration-none" href="{{ route('profile.materials') }}">View all course materials</a></span>
		</div>
	</div>
</div>
@endsection