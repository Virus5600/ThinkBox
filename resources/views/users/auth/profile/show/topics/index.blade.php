@extends('template.user')

@section('title', 'My Profile')

@section('body')
<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 col-lg-3 px-0 pr-5">
			<div class="border rounded" style="border-width: 1.5px!important;">
				@include('users.auth.profile.sidenav')
			</div>
		</div>

		<div class="col-12 col-lg-9 px-5">
			<div class="row">
				<div class="col-12 col-lg-7 text-center text-lg-left"><h1>Course Materials - Topics</h1></div>

				<div class="col-12 col-sm-4 col-lg-2 text-center text-md-left my-2">
					<a class="btn btn-success px-2 py-1" href="{{ route('profile.topics.create') }}">Add Item</a>
				</div>
				
				<form action="{{ route('profile.topics.index') }}" method="GET" class="col-12 col-sm-8 col-lg-3 text-center my-2">
					<div class="input-group">
						<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$searchVal}}"/>
						<div class="input-group-append">
							<button type="submit" class="btn btn-custom"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</form>
			</div>

			<div class="row overflow-x-auto" style="white-space: nowrap; display: block;">
				<table class="table">
					<thead>
						<tr>
							<td scope="col" class="font-weight-bold">Topic Name</td>
							<td scope="col" class="font-weight-bold">No. of Materials Uploaded</td>
							<td scope="col" class="font-weight-bold">Date Added</td>
							<td scope="col" class="font-weight-bold">Last Updated</td>
							<td></td>
						</tr>
					</thead>

					<tbody id="research_table">
						@forelse($topic_names as $t)
						@php
						$topic = App\Topic::where('topic_name', '=', $t)->first();
						$material = App\Material::where('topic_id', '=', $topic->id)->where('faculty_staff_id', '=', App\FacultyStaff::where('user_id', '=', Auth::user()->id)->first()->id)->get();
						@endphp
						<tr>
							<td>{{$t}}</td>
							<td>{{count($material)}}</td>
							<td>{{$topic->getFirstDateAdded()}}</td>
							<td>{{$topic->getLatestDateUpdate()}}</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-custom btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{ route('profile.topics.materials.index', [$topic->id]) }}">View</a>
										<a class="dropdown-item" href="{{ route('profile.topics.edit', [$topic->id]) }}" class="dropdown-item">Edit</a>
										<a href="javascript:void(0);" onclick="confirmDelete('{{ route('profile.topics.delete', [$topic->id]) }}', '{{$t}}', true)" class="dropdown-item">Delete</a>
									</div>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="5" class="text-center">Nothing to show</td>
						</tr>
						@endforelse
					</tbody>

					<tfoot>
						<div class="row">
							<div class="col justify-content-center">
							</div>
						</div>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection