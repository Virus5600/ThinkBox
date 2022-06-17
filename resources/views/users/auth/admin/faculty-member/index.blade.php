@extends('template.admin')

@section('meta-data')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Faculty Staff')

@section('body')
<div class="container-fluid px-2 px-lg-6 py-2">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="font-weight-bold">Faculty Members</h2>
		</div>

		@if (Auth::user()->hasPrivilege('faculty_members'))
		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" id="addFS" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-plus-circle mr-2"></i>Add Faculty Staff
			</button>

			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="addFS">
				<a href="{{ route('admin.faculty-member.create') }}" class="dropdown-item">Detailed</a>
				<a href="{{ route('admin.faculty-member.generate') }}" class="dropdown-item" id="addFSG">Generated</a>
			</div>
		</div>
		@endif

		<form class="col-12 col-md-6 col-lg my-2 text-center text-lg-right" action="{{ route('admin.faculty-member.index') }}" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." value="{{ $searchVal }}" />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</form>
	</div>

	<div class="overflow-x-auto">
		<table class="table my-2">
			<thead>
				<tr>
					@if (Auth::user()->hasPrivilege('faculty_members_mark'))
					<th scope="col" class="hr-thick"></th>
					@endif
					<th scope="col" class="hr-thick"></th>
					<th scope="col" class="hr-thick">Name</th>
					<th scope="col" class="hr-thick">Department</th>
					<th scope="col" class="hr-thick"></th>
				</tr>
			</thead>

			<tbody>
				@foreach($staff as $s)
				<tr>
					@if (Auth::user()->hasPrivilege('faculty_members_mark'))
					<td class="hr-thick">
						@if (strlen($s->reason) > 0)
						<div class="mark-button {{ $s->is_marked ? 'active' : ''}}" data-target-uri="{{ route('admin.faculty-member.' . ($s->is_marked ? 'unmark' : 'mark'), [$s->id]) }}" data-target-item="{{ $s->getFullName() }}" data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus' title="{{ $s->reason }}">
							<i class="fa-solid fa-exclamation"></i>
						</div>
						@else
						<div class="mark-button {{ $s->is_marked ? 'active' : ''}}" data-target-uri="{{ route('admin.faculty-member.' . ($s->is_marked ? 'unmark' : 'mark'), [$s->id]) }}" data-target-item="{{ $s->getFullName() }}">
							<i class="fa-solid fa-exclamation"></i>
						</div>
						@endif
					</td>
					@endif

					<td class="hr-thick">
						@if (!$s->user->isAvatarLink)
							@if ($s->user->avatar == null)
							<img src="{{ asset('uploads/users/default.png') }}" class="img-fluid user-icon invisiborder circle-border" draggable="false"/>
							@else
							<img src="{{ asset('uploads/users/user' . $s->user->id . '/' . $s->user->avatar) }}" class="img-fluid user-icon invisiborder circle-border" draggable="false"/>
							@endif
						@else
						<img src="{{$s->user->avatar}}" class="img-fluid user-icon invisiborder circular-border" draggable='false' alt="User"/>
						@endif
					</td>
					<td class="hr-thick">{{$s->getFullName()}}</td>
					<td class="hr-thick">{{$s->getDepartment()->name}}</td>
					<td class="hr-thick">
						<div class="dropdown">
							<button class="btn btn-custom btn-sm dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown{{$s->id}}" aria-haspopup="true" aria-expanded="false">
								Action
							</button>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown{{$s->id}}">
								@if (Auth::user()->hasPrivilege('faculty_members_view'))
								<a href="{{ route('admin.faculty-member.show', [$s->id]) }}" class="dropdown-item">View</a>
								@endif

								@if (Auth::user()->hasPrivilege('faculty_members_edit'))
								<a href="{{ route('admin.faculty-member.edit', [$s->id]) }}" class="dropdown-item">Edit Details</a>
								@endif

								@if (Auth::user()->hasPrivilege('faculty_members_skills'))
								<a href="{{ route('admin.faculty-member.skills', [$s->id]) }}" class="dropdown-item">Set Skills</a>
								@endif

								@if (Auth::user()->hasPrivilege('faculty_members_contents'))
								<a href="{{ route('admin.faculty-member.contents', [$s->id]) }}" class="dropdown-item">Manage Contents</a>
								@endif

								@if (Auth::user()->hasPrivilege('faculty_members_delete'))
								@include('include.delete_btn', ['item' => $s->title, 'route' => route('admin.faculty-member.delete', [$s->id]), 'formClass' => 'w-100', 'class' => 'dropdown-item delete-btn'])
								@endif
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="d-flex flex-row">
			<nav class="mx-auto">{{ $staff->links() }}</nav>
		</div>
	</div>
</div>
@endsection