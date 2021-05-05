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
				<div class="col-12 col-lg-7 text-center text-lg-left"><h1>Course Materials</h1></div>

				<div class="col-12 col-sm-4 col-lg-2 text-center text-md-left my-2">
					<button type="button" class="btn btn-success px-2 py-1" data-toggle="modal" data-target="#addItem">Add Item</button>

					<div class="modal fade" id="addItem" data-backdrop="static" role="dialog" aria-hidden="true" aria-labelledby="addItemTitle">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addItemTitle">Create Topic</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<div class="modal-body">
									<form>
										<div class="form-group">
											<label class="form-label font-weight-bold" for="topic_name">Topic Name</label>
											<input type="text" class="form-control" name="topic_name"/>
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
							<td scope="col" class="font-weight-bold">Topic Name</td>
							<td scope="col" class="font-weight-bold">No. of Materials Uploaded</td>
							<td scope="col" class="font-weight-bold">Date Added</td>
							<td scope="col" class="font-weight-bold">Last Updated</td>
							<td></td>
						</tr>
					</thead>

					<tbody id="research_table">
						<tr>
							<td>Topic 1</td>
							<td>5</td>
							<td>Mar 1, 2021</td>
							<td>Mar 5, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{ route('profile.materials.topics.index', [$id]) }}">View</a>
										<button type="button" class="dropdown-item" data-toggle="modal" data-target="#editItem1">Edit</button>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>

							<div class="modal fade" id="editItem1" data-backdrop="static" role="dialog" aria-hidden="true" aria-labelledby="editItemTitle1">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="editItemTitle1">Edit Topic 1</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">
											<form>
												<div class="form-group">
													<label class="form-label font-weight-bold" for="topic_name1">Topic Name</label>
													<input type="text" class="form-control" name="topic_name1" value="Topic 1"/>
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
							<td>Topic 2</td>
							<td>3</td>
							<td>Mar 1, 2021</td>
							<td>Mar 5, 2021</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="">View</a>
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
						`<td>` + $("[name=topic_name]").val() + `</td>` +
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

				$("[name=topic_name]").val("");
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