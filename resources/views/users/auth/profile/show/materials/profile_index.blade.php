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

					<p class="a-fa-hover-zoom-2">
						<a href="" class="mx-1"><i class="fab fa-facebook text-dark secondary-hover fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fas fa-atom text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-twitter text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-linkedin-in text-light fa-2x bg-dark secondary-hover invisiborder circle-border p-1 custom-fa-2x"></i></a>
						<a href="" class="mx-1"><i class="fab fa-github text-dark secondary-hover fa-2x"></i></a>
					</p>
				</div>
			</div>
		</div>
	</div>
	
	{{-- COURSE MATERIALS --}}
	<h2 class="text-custom-2 my-2 mb-3">COURSE MATERIALS</h2>
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

		<div class="col-12 col-md-9">
			<div class="container-fluid">
				<h4>Branding (1)</h4>
				<div class="row flex-row flex-nowrap overflow-x-auto p-2 div-hover-zoom">
					<div class="col-12 col-md-4 m-3 bg-custom-light p-3">
						<p><em>Branding</em></p>

						<p class="font-weight-bold">
							<a href="" class="text-decoration-none text-dark">
								Logo Documentation
							</a>
						</p>

						<p class="readmore" data-rm-show-lines='3'>
							In this course material, I will be discussing on how to create a documentation for a logo or brand. This material would include the important information that should be in the documentation, formatting the document and detailed user instruction.
							<span class="readmore-link readmore-link-custom-bg text-custom-2"></span>
						</p>
					</div>
				</div>

				<h4>Microsoft (1)</h4>
				<div class="row flex-row flex-nowrap overflow-x-auto p-2 div-hover-zoom">
					<div class="col-12 col-md-4 m-3 bg-custom-light p-3">
						<p><em>Microsoft</em></p>

						<p class="font-weight-bold">
							<a href="" class="text-decoration-none text-dark">
								Basics of MS Powerpoint
							</a>
						</p>

						<p class="readmore" data-rm-show-lines='3'>
							PowerPoint presentations work like slide shows. To convey a message or a story, you break it down into slides. Think of each slide as a blank canvas for the pictures and words that help you tell your story. In this course material, I would be teaching you on how to
							<span class="readmore-link readmore-link-custom-bg text-custom-2"></span>
						</p>
					</div>
				</div>

				<h4>Programming (2)</h4>
				<div class="row flex-row flex-nowrap overflow-x-auto p-2 div-hover-zoom">
					<div class="col-12 col-md-4 m-3 bg-custom-light p-3">
						<p><em>Programming</em></p>

						<p class="font-weight-bold">
							<a href="" class="text-decoration-none text-dark">
								Getting started with GitLab
							</a>
						</p>

						<p class="readmore" data-rm-show-lines='3'>
							In this course material, I will be discussing on how to get started with GitLab to practice version control on all programming related projects. This course materials includes introduction to GitLab, setting up, creating a repository, etc.
							<span class="readmore-link readmore-link-custom-bg text-custom-2"></span>
						</p>
					</div>

					<div class="col-12 col-md-4 m-3 bg-custom-light p-3">
						<p><em>Programming</em></p>

						<p class="font-weight-bold">
							<a href="" class="text-decoration-none text-dark">
								Object-Oriented Programming
							</a>
						</p>

						<p class="readmore" data-rm-show-lines='3'>
							In this course material, I would be teaching object-oriented programming. It is used to structure a software program into simple, reusable pieces of code blueprints (usually called classes), which are used to create individual instances of objects
							<span class="readmore-link readmore-link-custom-bg text-custom-2"></span>
						</p>
					</div>
				</div>

				<h4>Project Management (1)</h4>
				<div class="row flex-row flex-nowrap overflow-x-auto p-2 div-hover-zoom">
					<div class="col-12 col-md-4 m-3 bg-custom-light p-3">
						<p><em>Project Management</em></p>

						<p class="font-weight-bold">
							<a href="" class="text-decoration-none text-dark">
								Developers Timeline
							</a>
						</p>

						<p class="readmore" data-rm-show-lines='3'>
							In this course material, I will be discussing on how to create a developer's timeline to track project timeline using Microsoft Excel. This material includes formatting of document and creating a Gantt chart. This material would ensure to increase productivity.
							<span class="readmore-link readmore-link-custom-bg text-custom-2"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection