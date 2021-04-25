@extends('template.admin')

@section('title', 'Skills')

@section('body')
<div class="container-fluid px-2 px-lg-6 py-2">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="font-weight-bold">Skills</h2>
		</div>

		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<button class="btn btn-success" data-toggle="modal" data-target="#addSkill"><i class="fas fa-plus-circle mr-2"></i>Add Skill</button>
						
			<div class="modal fade" id="addSkill" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<form class="modal-content" action="" method="{{-- POST --}}" enctype="multipart/form-data">
						<div class="modal-header">
							<h5 class="modal-title">Add Skill</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body text-left">
							<div class="form-group">
								<label class="form-label" for='skill'>Skill Name</label>
								<input class="form-control" type="text" name="skill" value="{{old('skill')}}">
							</div>

							{{ csrf_field() }}
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" data-action="submit">Submit</button>
							<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel"/>
						</div>
					</form>
				</div>
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
		<table class="table">
			<thead>
				<tr>
					<th scope="col" class="hr-thick">Name</th>
					<th scope="col" class="hr-thick"></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($skills as $s)
				<tr>
					<td>{{$s->skill}}</td>
					<td class="text-right">
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit{{$s->id}}">Edit</button>
						<button class="btn btn-sm btn-danger">Delete</button>

						<div class="modal fade" id="edit{{$s->id}}" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<form class="modal-content" action="" method="{{-- POST --}}" enctype="multipart/form-data">
									<div class="modal-header">
										<h5 class="modal-title">Edit Skill</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<div class="modal-body text-left">
										<div class="form-group">
											<label class="form-label" for='skill'>Skill Name</label>
											<input class="form-control" type="text" name="skill" value="{{$s->skill}}">
										</div>

										{{ csrf_filed() }}
									</div>

									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" data-action="update">Submit</button>
										<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel"/>
									</div>
								</form>
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