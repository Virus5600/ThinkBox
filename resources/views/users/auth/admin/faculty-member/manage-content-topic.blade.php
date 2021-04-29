@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<div class="container-fluid px-2 px-lg-5">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="h5 h2-lg text-center text-lg-left"><a href="{{route('admin.faculty-member.manage-contents', [$id])}}" class="text-dark text-decoration-none font-weight-bold"><i class="fas fa-chevron-left fa-lg mr-2"></i>Topic 1</a></h2>
		</div>

		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<button class="btn btn-success" data-toggle="modal" data-target="#addMaterials"><i class="fas fa-plus-circle mr-2"></i>Add Item</button>
						
			<div class="modal fade" id="addMaterials" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<form class="modal-content" action="" method="{{-- POST --}}" enctype="multipart/form-data">
						<div class="modal-header">
							<h5 class="modal-title">Add Research</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

						<div class="modal-body text-left">
							<div class="form-group">
								<label class="form-label" for='material_name'>Material Name</label>
								<input class="form-control" type="text" name="material_name" value="{{old('material_name')}}">
							</div>

							<div class="form-group">
								<label class="form-label" for='material_url'>URL</label>
								<input class="form-control" type="text" name="material_url" value="{{old('material_url')}}">
							</div>
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
			@for ($i = 0; $i < 2; $i++)
			<tr>
				<td>Material {{$i+1}}</td>
				<td>https://www.sample.com/articles/64209</td>
				<td>Mar 1, 2021</td>
				<td>
					<div class="dropdown">
						<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown1" aria-haspopup="true" aria-expanded="false">
							Action
						</button>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
							<button class="dropdown-item" data-toggle="modal" data-target="#editMaterials{{$i+1}}">Edit</button>
							<a href="" class="dropdown-item">Delete</a>
						</div>
					</div>

					<div class="modal fade" id="editMaterials{{$i+1}}" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<form class="modal-content" action="" method="{{-- POST --}}" enctype="multipart/form-data">
								<div class="modal-header">
									<h5 class="modal-title">Edit Research</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								
								<div class="modal-body text-left">
									<div class="form-group">
										<label class="form-label" for='material_name'>Material Name</label>
										<input class="form-control" type="text" name="material_name" value="Material {{$i+1}}">
									</div>
									
									<div class="form-group">
										<label class="form-label" for='material_url'>URL</label>
										<input class="form-control" type="text" name="material_url" value="https://www.sample.com/articles/64209">
									</div>
								</div>
								
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary" data-action="submit">Submit</button>
									<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel"/>
								</div>
							</form>
						</div>
					</div>
				</td>
			</tr>
			@endfor
		</tbody>

		<tfoot></tfoot>
	</table>
</div>
@endsection