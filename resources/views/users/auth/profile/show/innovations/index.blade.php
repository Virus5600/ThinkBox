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
				<div class="col-12 col-lg-7 text-center text-lg-left"><h1>Innovations</h1></div>

				<div class="col-12 col-sm-4 col-lg-2 text-center text-md-left my-2">
					<button type="button" class="btn btn-success px-2 py-1" data-toggle="modal" data-target="#addItem">Add Item</button>

					<div class="modal fade" id="addItem" data-backdrop="static" role="dialog" aria-hidden="true" aria-labelledby="addItemTitle">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addItemTitle">Add Innovations</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>

								<div class="modal-body">
									<form>
										<div class="form-group">
											<label class="form-label" for="innovations_title">Innovation Title</label>
											<input type="text" class="form-control" name="innovations_title"/>
										</div>

										<div class="form-group">
											<label class="form-label" for="url">URL/Link to source</label>
											<input type="text" class="form-control" name="url"/>
										</div>

										<div class="form-group">
											<label class="form-label" for="description">Abstract/Description</label>
											<textarea class="form-control not-resizable" rows="5" name="description"></textarea>
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
							<td scope="col" class="font-weight-bold">Innovations Title</td>
							<td scope="col" class="font-weight-bold">Innovations URL</td>
							<td scope="col" class="font-weight-bold">Date Added</td>
							<td></td>
						</tr>
					</thead>

					<tbody id="Innovations_table">
						<tr>
							<td>Innovations 1</td>
							<td>https://www.sample.com/...</td>
							<td>Jan 4, 2021</td>
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
											<h5 class="modal-title" id="editItemTitle1">Edit Innovations 1</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">
											<form>
												<div class="form-group">
													<label class="form-label" for="innovations_title">Innovations Title</label>
													<input type="text" class="form-control" name="innovations_title1" value="Innovations 1"/>
												</div>

												<div class="form-group">
													<label class="form-label" for="url">URL/Link to source</label>
													<input type="text" class="form-control" name="url1" value="https://www.sample.com/articles/64209"/>
												</div>

												<div class="form-group">
													<label class="form-label" for="description">Abstract/Description</label>
													<textarea class="form-control not-resizable" rows="5" name="description1">This paper presents the development of an accent recognition system for the native speakers of Bikol and Tagalog using deep learning. The results of the work serve as baseline for the advancement of recognizing speakers with Tagalog and Bikol accents in Filipino language. A monologue written in Filipino is prepared as script for the development of the speech corpus. The script is used to capture the Bikol accent and Tagalog accent in the recordings. The corpus was validated, cleaned and divided into 80:20 ratios for training and testing. Afterwards, Praat is utilized to analyze and extract prosodic features such as F1 and energy of speech. The model was tested and yields 79.28% and 78.33% accuracy for Tagalog and Bikol accent, respectively.</textarea>
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
							<td>Innovations 2</td>
							<td>https://www.sample.com/...</td>
							<td>Feb 14, 2021</td>
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
							<td>Innovations 3</td>
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
				if ($("#Innovations_table").children().length == 5)
					location.reload(true);

				$("#Innovations_table").append(
					`<tr>` +
						`<td>` + $("[name=innovations_title]").val() + `</td>` +
						`<td>https://www.sample.com/...</td>` +
						`<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>` +
						`<td>` +
							`<div class="dropdown">` +
								`<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">` +
									`Action` +
								`</a>` +
								
								`<div class="dropdown-menu dropdown-menu-right">` +
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