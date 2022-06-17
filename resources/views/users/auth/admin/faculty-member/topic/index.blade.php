@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<div class="container-fluid px-2 px-lg-5">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="h5 h2-lg text-center text-lg-left"><a href="{{route('admin.faculty-member.contents', [$staff->id])}}" class="text-dark text-decoration-none font-weight-bold"><i class="fas fa-chevron-left fa-lg mr-2"></i>{{ $topic->name }}</a></h2>
		</div>

		@if (Auth::user()->hasPrivilege('faculty_members_contents_create'))
		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<a href="{{ route('admin.faculty-member.manage-contents.topic.create', [$staff->id, $topic->id]) }}" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Add Item</a>
		</div>
		@endif

		<form class="col-12 col-md-6 col-lg my-2 text-center text-lg-right" action="{{ route('admin.faculty-member.index') }}" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." value="{{ $searchVal }}"/>
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>
	
	<div class="row">
		<div class="overflow-y-auto custom-scrollbar" style="max-height: 37.5vh; min-width: 100%">
			<table class="table">
				<thead>
					<tr>
						<th scope="col" class="hr-thick">Material Name</th>
						<th scope="col" class="hr-thick">Material URL</th>
						<th scope="col" class="hr-thick">Date Added</th>
						<th scope="col" class="hr-thick"></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($materials as $m)
					<tr>
						<td>{{ $m->material_name }}</td>
						<td><a href="{{ $m->links[0]->url }}" class="text-dark">{{ $m->links[0]->url }}</a></td>
						<td>{{ Carbon\Carbon::parse($m->created_at)->setTimezone('Asia/Manila')->format('M d, Y')}}</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown1" aria-haspopup="true" aria-expanded="false">
									Action
								</button>

								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
									<a href="#" class="dropdown-item">View</a>
									<a href="#" class="dropdown-item">Edit</a>
									<a href="#" class="dropdown-item">Delete</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>

				<tfoot></tfoot>
			</table>
		</div>
	</div>
</div>
@endsection