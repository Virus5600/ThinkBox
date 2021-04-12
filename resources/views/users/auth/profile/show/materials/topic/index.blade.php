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
				<div class="col-12 col-lg-7 text-center text-lg-left"><h1><a href="{{ route('profile.materials.index') }}" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Topic 1</a></h1></div>

				<div class="col-12 col-sm-4 col-lg-2 text-center text-md-left my-2">
					<button type="button" class="btn btn-success px-2 py-1" data-toggle="modal" data-target="#addItem">Add Item</button>

					<div class="modal fade" id="addItem" data-backdrop="static" role="dialog" aria-hidden="true" aria-labelledby="addItemTitle">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addItemTitle">Create Material</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<div class="modal-body">
									<form>
										<div class="form-group">
											<label class="form-label" for="material_name">Material Name</label>
											<input type="text" class="form-control" name="material_name"/>
										</div>

										<div class="form-group">
											<label class="form-label" for="url">URL/Link</label>
											<input type="text" class="form-control" name="url"/>
										</div>
									</form>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="submitAddItem">Submit</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-12 col-sm-8 col-lg-3 text-center my-2">
					<div class="input-group">
						<input type="text" class="form-control" name="search" placeholder="Search..."/>
						<div class="input-group-append">
							<button type="button" class="btn btn-secondary"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>

			<div class="row overflow-x-auto" style="white-space: nowrap; display: block;">
				<table class="table">
					<thead>
						<tr>
							<td scope="col" class="font-weight-bold">Material Name</td>
							<td scope="col" class="font-weight-bold">Material URL</td>
							<td scope="col" class="font-weight-bold">Date Added</td>
							<td></td>
						</tr>
					</thead>

					<tbody id="research_table">
						<tr>
							<td>Material 1</td>
							<td>https://www.sample.com/...</td>
							<td>Mar 1, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<button type="button" class="dropdown-item" data-toggle="modal" data-target="#editItem1">Edit</button>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>

							<div class="modal fade" id="editItem1" data-backdrop="static" role="dialog" aria-hidden="true" aria-labelledby="editItemTitle1">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="editItemTitle1">Edit Material 1</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">
											<form>
												<div class="form-group">
													<label class="form-label" for="material_name1">Material Name</label>
													<input type="text" class="form-control" name="material_name1" value="Material 1"/>
												</div>

												<div class="form-group">
													<label class="form-label" for="url1">URL/Link</label>
													<input type="text" class="form-control" name="url1" value="https://www.sample.com/articles/64209"/>
												</div>
											</form>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-primary" id="submitEditItem1">Submit</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</tr>

						<tr>
							<td>Material 2</td>
							<td>https://www.sample.com/...</td>
							<td>Mar 1, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="">Edit</a>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>Material 3</td>
							<td>https://www.sample.com/...</td>
							<td>Mar 3, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="">Edit</a>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>Material 4</td>
							<td>https://www.sample.com/...</td>
							<td>Mar 5, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="">Edit</a>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>
						</tr>

						<tr>
							<td>Material 5</td>
							<td>https://www.sample.com/...</td>
							<td>Mar 5, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="">Edit</a>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>
						</tr>
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

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		// Submitting new entry
		$("#submitAddItem").click(function(e) {
			{{-- ADD THE AJAX HERE THEN ADD A SUCCESS AND ERROR HANDLER --}}
			{{-- This will be the success handler --}}
			{
				if ($("#research_table").children().length == 5)
					location.reload(true);

				$("#research_table").append(
					`<tr>` +
						`<td>` + $("[name=material_name]").val() + `</td>` +
						`<td>0</td>` +
						`<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>` +
						`<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>` +
						`<td>` +
							`<div class="dropdown">` +
								`<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">` +
									`Action` +
								`</a>` +
								
								`<div class="dropdown-menu dropdown-menu-right">` +
									`<a class="dropdown-item" href="">View</a>` +
									`<a class="dropdown-item" href="">Edit</a>` +
									`<a class="dropdown-item" href="">Delete</a>` +
								`</div>` +
							`</div>` +
						`</td>` +
					`</tr>`
				);

				$("[name=material_name]").val("");
			}

			{{-- This will be the error handler --}}
			{
				// codes here...
			}

			$("#addItem").modal("hide");
		});
	});
</script>
@endsection