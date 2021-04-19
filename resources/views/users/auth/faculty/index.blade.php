@extends('template.user')

@section('title', 'Faculty')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/faculty.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light h3 h1-md">Department</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light">Meet our faculty members with their expertise in their respective department</p>
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

			<span class="font-weight-bold">Select Department</span>
			<div class="input-group">
				<select name="dept" class="custom-select">
					<option value="All" {{$dept == 'all' ? 'selected' : ''}}>All</option>
					<option value="CompSci" {{$dept == 'CompSci' ? 'selected' : ''}}>Computer Science</option>
				</select>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sort" class="custom-select">
					<option value="firstName" selected>First Name</option>
					<option value="lastName">Last Name</option>
				</select>
			</div>
		</div>

		{{-- DEFINES THE COLUMN --}}
		<div class="col col-lg-9 my-4 mb-md-4">
			{{-- DEFINES THE ROW INSIDE THE COLUMN --}}
			<div class="row">
				{{-- DEFINES A CELL --}}
				<div class="col-12 col-lg-6 my-3">
					<div class="container-fluid dark-shadow invisiborder rounded overflow-hidden h-100 w-100">
						<div class="row h-100">
							<div class="col-12 col-md-4 pb-faculty-holder p-0">
								<div class="pb-faculty text-center mx-auto h-100" style="background: #fff url('/images/TEMPORARY/home/user1.jpg') no-repeat center; background-size: cover;">
								</div>
							</div>

							<div class="col-12 col-md-8 py-3">
								<div class="text-center text-md-left">
									<h3 class="font-weight-bold m-0">Dr. Angelique Lacasandile</h3>
									<p class="font-weight-bold m-0">Department Chair, National University</p>
									<p class="m-0"><em>Computer Science</em></p>
								</div>

								<p class="text-truncate-2 my-2">
									Dr. Angelique D. Lacasandile is the Department Chair of the Computer Science Department at National University, Manila. She is also the Academe and Industry Linkage Coordinator, and a recipient of CHED Scholarship for Graduate Studies that enjoys full-privileges to earn doctorate degree. She graduated at Technological Institute of the Philippines – Manila with a degree of Doctor in Information Technology (DIT), her current research papers and system developed focused on the projects about the government.
								</p>

								<p class="m-3 mt-4">
									<a class="float-right text-decoration-none read-more bottom-left" href="{{ route('faculty.show', [1]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>

				{{-- DEFINES A CELL --}}
				<div class="col-12 col-lg-6 my-3">
					<div class="container-fluid dark-shadow invisiborder rounded overflow-hidden h-100 w-100">
						<div class="row h-100">
							<div class="col-12 col-md-4 pb-faculty-holder p-0">
								<div class="pb-faculty text-center mx-auto h-100" style="background: #fff url('/images/TEMPORARY/home/user4.jpg') no-repeat center; background-size: cover;">
								</div>
							</div>

							<div class="col-12 col-md-8 py-3">
								<div class="text-center text-md-left">
									<h3 class="font-weight-bold m-0">Dr. Arlene O. Trillanes</h3>
									<p class="font-weight-bold m-0">Dean, National University</p>
									<p class="m-0"><em>Computer Science</em></p>
								</div>

								<p class="text-truncate-2 my-2">
									Dr. Arlese Trillanes is the Dean of the College of Computing and Information Technologies at National University, Manila.
								</p>

								<p class="m-3 mt-4">
									<a class="float-right text-decoration-none read-more bottom-left" href="{{ route('faculty.show', [4]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- DEFINES THE ROW INSIDE THE COLUMN --}}
			<div class="row my-4">
				{{-- DEFINES A CELL --}}
				<div class="col-12 col-lg-6 my-3">
					<div class="container-fluid dark-shadow invisiborder rounded overflow-hidden h-100 w-100">
						<div class="row h-100">
							<div class="col-12 col-md-4 pb-faculty-holder p-0">
								<div class="pb-faculty text-center mx-auto h-100" style="background: #fff url('/images/TEMPORARY/home/user2.jpg') no-repeat center; background-size: cover;">
								</div>
							</div>

							<div class="col-12 col-md-8 py-3">
								<div class="text-center text-md-left">
									<h3 class="font-weight-bold m-0">Joseph Marvin Imperial</h3>
									<p class="font-weight-bold m-0">Professor, National University</p>
									<p class="m-0"><em>Computer Science</em></p>
								</div>

								<p class="text-truncate-2 my-2">
									I am a graduate student at De La Salle University under the MS Computer Science program. I am also a full-time faculty member of the Computer Science Department at National University-Manila. My research works are focused on applying Natural Language Processing (NLP) on Philippine languages using Machine Learning and Deep Learning methods.
								</p>

								<p class="m-3 mt-4">
									<a class="float-right text-decoration-none read-more bottom-left" href="{{ route('faculty.show', [2]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>

				{{-- DEFINES A CELL --}}
				<div class="col-12 col-lg-6 my-3">
					<div class="container-fluid dark-shadow invisiborder rounded overflow-hidden h-100 w-100">
						<div class="row h-100">
							<div class="col-12 col-md-4 pb-faculty-holder p-0">
								<div class="pb-faculty text-center mx-auto h-100" style="background: #fff url('/images/TEMPORARY/home/user3.jpg') no-repeat center; background-size: cover;">
								</div>
							</div>

							<div class="col-12 col-md-8 py-3">
								<div class="text-center text-md-left">
									<h3 class="font-weight-bold m-0">Manolito Octaviano Jr.</h3>
									<p class="font-weight-bold m-0">Professor, National University</p>
									<p class="m-0"><em>Computer Science</em></p>
								</div>

								<p class="text-truncate-2 my-2">
									Manolito Octaviano is a Professor at the Computer Science Department at National University, Manila. His research works are more focused on Natural Language Processing and Computational Linguistics.
								</p>

								<p class="m-3 mt-4">
									<a class="float-right text-decoration-none read-more bottom-left" href="{{ route('faculty.show', [3]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection