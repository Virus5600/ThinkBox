@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<div class="container-fluid px-2 px-lg-6 py-2">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="font-weight-bold">Faculty Members</h2>
		</div>

		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" id="addFS" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-plus-circle mr-2"></i>Add Faculty Staff
			</button>

			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="addFS">
				<a href="{{ route('admin.faculty-member.create') }}" class="dropdown-item">(Detailed)</a>
				<a href="{{ route('admin.faculty-member.generate') }}" class="dropdown-item" id="addFSG">(Generated)</a>
			</div>
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
		<table class="table my-2">
			<thead>
				<tr>
					<th scope="col" class="hr-thick"></th>
					<th scope="col" class="hr-thick">Name</th>
					<th scope="col" class="hr-thick">Department</th>
					<th scope="col" class="hr-thick"></th>
				</tr>
			</thead>

			<tbody>
				@foreach($staff as $s)
				<tr>
					<td class="hr-thick">
						@if (!$s->user->isAvatarLink)
						@if ($s->user->avatar == null)
						<img src="/uploads/users/default.png" class="img-fluid user-icon invisiborder circle-border" draggable="false"/>
						@else
						<img src="/uploads/users/user{{$s->user->id}}/{{$s->user->avatar}}" class="img-fluid user-icon invisiborder circle-border" draggable="false"/>
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
								<a href="{{ route('admin.faculty-member.show', [$s->id]) }}" class="dropdown-item">View</a>
								<a href="{{ route('admin.faculty-member.edit', [$s->id]) }}" class="dropdown-item">Edit Details</a>
								<a href="{{ route('admin.faculty-member.skills', [$s->id]) }}" class="dropdown-item">Set Skills</a>
								<a href="{{ route('admin.faculty-member.manage-contents', [$s->id]) }}" class="dropdown-item">Manage Contents</a>
								<a href="{{ route('admin.faculty-member.delete', [$s->id]) }}" class="dropdown-item">Delete</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>

			<tfoot>
				
			</tfoot>
		</table>
	</div>
</div>
@endsection