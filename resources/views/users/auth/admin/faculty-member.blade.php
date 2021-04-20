@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<div class="container-fluid px-6 py-2">
	<div class="row">
		<div class="col">
			<h2 class="font-weight-bold">Faculty Members</h2>
		</div>

		<div class="col-6 col-lg text-right">
			<a href="" class="btn btn-success">Add Faculty Member</a>
		</div>

		<div class="col-6 col-lg">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>

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
				<td class="hr-thick"><img src="/images/TEMPORARY/home/{{$s->avatar}}" class="img-fluid user-icon invisiborder circle-border" draggable="false"/></td>
				<td class="hr-thick">{{$s->name}}</td>
				<td class="hr-thick">{{$s->department}}</td>
				<td class="hr-thick">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown{{$s->id}}" aria-haspopup="true" aria-expanded="false">
							Action
						</button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown{{$s->id}}">
							<a href="" class="dropdown-item">View</a>
							<a href="" class="dropdown-item">Edit Details</a>
							<a href="" class="dropdown-item">Set Skills</a>
							<a href="" class="dropdown-item">Manage Contents</a>
							<a href="" class="dropdown-item">Delete</a>
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
@endsection