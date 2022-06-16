@extends('template.admin')

@section('title', 'Skills')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="{{ route('admin.skills.index') }}" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Skills</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12">
			<h2 class="font-weight-bold mb-2 text-center">{{$skill->skill}}</h2>

			<div class="row">
				<div class="col-12">
					<h3 class="text-center">List of users that has this Skill</h3>
				</div>

				<div class="mx-0 px-0 hr-thick"></div>

				@foreach($skill->users()->sortBy('first_name') as $u)
					<div class="col-4 border">
						@if (Auth::user()->hasPrivilege('faculty_members'))
						<a href="{{ route('admin.faculty-member.index', [$u->id]) }}">
						@endif
						<p class="text-dark py-0 my-0 text-center">
							{{ $u->getFullName() }}
						</p>
						@if (Auth::user()->hasPrivilege('faculty_members'))
						</a>
						@endif
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection