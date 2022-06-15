@extends('template.admin')

@section('title', 'Announcements')

@section('body')
<div class="container-fluid px-2 px-lg-6 py-2">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="font-weight-bold">Announcements</h2>
		</div>

		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<a href="{{ route('admin.announcements.create') }}" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Add Announcement</a>
		</div>

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
					<th scope="col" class="hr-thick">Title</th>
					<th scope="col" class="hr-thick">Source</th>
					<th scope="col" class="hr-thick">Date Published</th>
					<th scope="col" class="hr-thick"></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($announcements as $a)
				<tr>
					<td class="hr-thick">{{$a->title}}</td>
					<td class="hr-thick">{{$a->source}}</td>
					<td class="hr-thick">{{Carbon\Carbon::parse($a->created_at)->setTimezone('Asia/Manila')->format('M d, Y')}}</td>
					<td class="hr-thick">
						<div class="dropdown">
							<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown{{$a->id}}" aria-haspopup="true" aria-expanded="false">
								Action
							</button>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown{{$a->id}}">
								<a href="{{ route('admin.announcements.show', [$a->id]) }}" class="dropdown-item">View</a>
								<a href="{{ route('admin.announcements.edit', [$a->id]) }}" class="dropdown-item">Edit Details</a>
								@include('include.delete_btn', ['item' => $a->title, 'route' => route('admin.announcements.delete', [$a->id]), 'class' => 'dropdown-item delete-btn'])
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
@endsection