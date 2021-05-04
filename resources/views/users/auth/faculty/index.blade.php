@extends('template.user')

@section('title', 'Faculty')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/faculty.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light h3 h1-md">Department</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light h4">Meet our faculty members and learn about their expertise.</p>
		</div>
	</div>
</div>

<div class="container-fluid my-5 mb-7">
	<div class="row">
		<form class="col-12 col-lg-3" action="{{route('faculty.index')}}" method="GET" >
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Select Department</span>
			<div class="input-group">
				<select name="dept" class="custom-select" onchange="$('#facultyParamSubmit').trigger('click');">
					<option value="All" {{$dept == 'All' ? 'selected' : ''}}>All</option>
					<option value="CompSci" {{$dept == 'CompSci' ? 'selected' : ''}}>Computer Science</option>
				</select>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sortBy" class="custom-select" onchange="$('#facultyParamSubmit').trigger('click');">
					<option value="firstName" {{$sortBy == 'firstName' ? 'selected' : ''}}>First Name</option>
					<option value="lastName" {{$sortBy == 'lastName' ? 'selected' : ''}}>Last Name</option>
				</select>
			</div>

			<input type="submit" class="hidden" id="facultyParamSubmit">
		</form>
		{{-- DEFINES THE COLUMN --}}
		<div class="col col-lg-9 my-4 mb-md-4">
			<div class="row">
				@foreach ($staff as $s)
				{{-- DEFINES A CELL --}}
				<div class="col-12 col-lg-6 my-3">
					<div class="container-fluid dark-shadow invisiborder rounded overflow-hidden h-100 w-100">
						<div class="row h-100">
							<div class="col-12 col-md-4 pb-faculty-holder p-0">
								<div class="pb-faculty text-center mx-auto h-100" style="background: #fff url('/images/TEMPORARY/home/{{$s->avatar or 'default.png'}}') no-repeat center; background-size: cover;">
								</div>
							</div>

							<div class="col-12 col-md-8 py-3">
								<div class="text-center text-md-left">
									<h3 class="font-weight-bold m-0">{{$s->name}}</h3>
									<p class="font-weight-bold m-0">{{$s->position}}</p>
									<p class="m-0"><em>{{$s->department}}</em></p>
								</div>

								<p class="text-truncate-2 my-2">{{$s->description}}</p>

								<p class="m-3 mt-4">
									<a class="float-right text-decoration-none read-more bottom-left" href="{{ route('faculty.show', [$s->id]) }}">View Profile <i class="fas fa-chevron-right"></i></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection