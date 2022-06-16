@extends('template.admin')

@section('meta-data')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Announcements')

@section('body')
<div class="container-fluid px-2 px-lg-6 py-2">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="font-weight-bold">Announcements</h2>
		</div>

		@if (Auth::user()->hasPrivilege('announcements_create'))
		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<a href="{{ route('admin.announcements.create') }}" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Add Announcement</a>
		</div>
		@endif

		<div class="col-12 col-md-6 col-lg my-2 text-center text-lg-right">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>

	<div class="overflow-x-auto">
		<table class="table">
			<thead>
				<tr>
					@if (Auth::user()->hasPrivilege('announcements_mark'))
					<th scope="col" class="hr-thick"></th>
					@endif
					<th scope="col" class="hr-thick">Title</th>
					<th scope="col" class="hr-thick">Source</th>
					<th scope="col" class="hr-thick">Date Published</th>
					@if (Auth::user()->hasOneOfPrivileges(['announcements', 'announcements_view', 'announcements_edit', 'announcements_delete', 'announcements_mark']))
					<th scope="col" class="hr-thick"></th>
					@endif
				</tr>
			</thead>

			<tbody>
				@foreach ($announcements as $a)
				<tr>
					@if (Auth::user()->hasPrivilege('announcements_mark'))
					<td>
						@if (strlen($a->reason) > 0)
						<div class="mark-button {{ $a->is_marked ? 'active' : ''}}" data-target-uri="{{ route('admin.announcements.' . ($a->is_marked ? 'unmark' : 'mark'), [$a->id]) }}" data-target-item="{{ $a->title }}" data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus' title="{{ $a->reason }}">
						@else
						<div class="mark-button {{ $a->is_marked ? 'active' : ''}}" data-target-uri="{{ route('admin.announcements.' . ($a->is_marked ? 'unmark' : 'mark'), [$a->id]) }}" data-target-item="{{ $a->title }}">
						@endif
							<i class="fa-solid fa-exclamation"></i>
						</div>
					</td>
					@endif

					<td>{{$a->title}}</td>
					<td>{{$a->source}}</td>
					<td>{{Carbon\Carbon::parse($a->created_at)->setTimezone('Asia/Manila')->format('M d, Y')}}</td>
					@if (Auth::user()->hasOneOfPrivileges(['announcements_view', 'announcements_edit', 'announcements_delete', 'announcements_mark']))
					<td>
						<div class="dropdown">
							<button class="btn btn-primary {{ $a->is_marked ? 'btn-warning' : '' }} btn-sm dropdown-toggle mark-affected" type="button" data-toggle="dropdown" id="dropdown{{$a->id}}" aria-haspopup="true" aria-expanded="false" data-id="{{ $a->id }}">
								Action
							</button>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown{{$a->id}}">
								@if (Auth::user()->hasPrivilege('announcements_view'))
								<a href="{{ route('admin.announcements.show', [$a->id]) }}" class="dropdown-item">View</a>
								@endif

								@if (Auth::user()->hasPrivilege('announcements_edit'))
								<a href="{{ route('admin.announcements.edit', [$a->id]) }}" class="dropdown-item">Edit Details</a>
								@endif

								@if (Auth::user()->hasPrivilege('announcements_delete'))
								@include('include.delete_btn', ['item' => $a->title, 'route' => route('admin.announcements.delete', [$a->id]), 'formClass' => 'w-100, 'class' => 'dropdown-item delete-btn'])
								@endif
							</div>
						</div>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>

			<tfoot></tfoot>
		</table>
	</div>
</div>
@endsection