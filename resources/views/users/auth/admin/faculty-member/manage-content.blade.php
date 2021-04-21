@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="{{route('admin.faculty-member.index')}}" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-2"></i>Manage Faculty Members</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

@php
$tab = 'materials';
if(\Request::has('tab')) {
	$tab = \Request::get('tab');
}
@endphp

<div class="container-fluid px-3 px-6-lg py-2">
	<ul class="nav nav-tabs nav-tab-secondary nav-justified flex-d-col flex-d-lg-row" role="tablist">
		<li class="nav-item text-center">
			<a class="nav-link {{$tab == 'materials' ? 'active' : ''}}" href="#materials" data-toggle="tab" role="tab" aria-controls="materials" id="materials-tab"><h3 class="h6 h3-lg">Course Materials</h3></a>
		</li>

		<li class="nav-item text-center">
			<a class="nav-link {{$tab == 'research' ? 'active' : ''}}" href="#research" data-toggle="tab" role="tab" aria-controls="research" id="research-tab"><h3 class="h6 h3-lg">Research</h3></a>
		</li>

		<li class="nav-item text-center">
			<a class="nav-link {{$tab == 'innovations' ? 'active' : ''}}" href="#innovations" data-toggle="tab" role="tab" aria-controls="innovations" id="innovations-tab"><h3 class="h6 h3-lg">Innovations</h3></a>
		</li>
	</ul>

	<div class="tab-content">
		{{-- COURSE MATERIALS --}}
		<div class="tab-pane fade {{$tab == 'materials' ? 'show active' : ''}}" id="materials" aria-labelledby="materials-tab" role="tabpanel">
			<div class="panel-content container-fluid py-3">
				<div class="row">
					<div class="col-12 col-lg text-center text-lg-left">
						<h2 class="font-weight-bold">Course Materials</h2>
					</div>

					<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
						<button class="btn btn-success" data-toggle="modal" data-target="#addTopic"><i class="fas fa-plus-circle mr-2"></i>Add Item</button>
						
						<div class="modal fade" id="addTopic" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<form class="modal-content" action="" method="{{-- POST --}}" enctype="multipart/form-data">
									<div class="modal-header">
										<h5 class="modal-title">Create Topic</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<div class="modal-body text-left">
										<div class="form-group">
											<label class="form-label" for='topic_name'>Topic Name</label>
											<input class="form-control" type="text" name="topic_name" value="{{old('topic_name')}}">
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

				<div class="row">
					<div class="overflow-y-auto custom-scrollbar" style="max-height: 37.5vh; min-width: 100%">
						<table class="table">
							<thead>
								<tr>
									<th class="hr-thick" scope="col">Topic Name</th>
									<th class="hr-thick" scope="col">No. of Materials Uplaoded</th>
									<th class="hr-thick" scope="col">Date Added</th>
									<th class="hr-thick" scope="col">Last Updated</th>
									<th class="hr-thick"></th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Topic 1</td>
									<td>2</td>
									<td>Apr 1, 2021</td>
									<td>Apr 5, 2021</td>
									<td>
										<div class="dropdown">
											<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown1" aria-haspopup="true" aria-expanded="false">
												Action
											</button>

											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
												<a href="" class="dropdown-item">View</a>
												<a href="" class="dropdown-item">Edit</a>
												<a href="" class="dropdown-item">Delete</a>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		{{-- RESEARCH --}}
		<div class="tab-pane fade {{$tab == 'research' ? 'show active' : ''}}" id="research" aria-labelledby="research-tab" role="tabpanel">
			<div class="panel-content container-fluid py-3">
				<div class="row">
					<div class="col-12 col-lg text-center text-lg-left">
						<h2 class="font-weight-bold">Research</h2>
					</div>

					<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
						<button class="btn btn-success" data-toggle="modal" data-target="#addResearch"><i class="fas fa-plus-circle mr-2"></i>Add Item</button>
						
						<div class="modal fade" id="addResearch" role="dialog" aria-hidden="true">
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
											<label class="form-label" for='research_title'>Research Title</label>
											<input class="form-control" type="text" name="research_title" value="{{old('research_title')}}">
										</div>

										<div class="form-group">
											<label class="form-label" for='research_url'>URL</label>
											<input class="form-control" type="text" name="research_url" value="{{old('research_url')}}">
										</div>

										<div class="form-group">
											<label class="form-label" for='research_abstract'>Abstract/Description</label>
											<textarea class="form-control custom-scrollbar" type="text" name="research_abstract" rows="5" style="resize: none;">{{old('research_abstract')}}</textarea>
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

				<div class="row">
					<div class="overflow-y-auto custom-scrollbar" style="max-height: 37.5vh; min-width: 100%">
						<table class="table">
							<thead>
								<tr>
									<th class="hr-thick" scope="col">Research Title</th>
									<th class="hr-thick" scope="col">Research URL</th>
									<th class="hr-thick" scope="col">Date Added</th>
									<th class="hr-thick"></th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Research 1</td>
									<td>https://www.sample.com/articles/64209</td>
									<td>Jan 4, 2021</td>
									<td>
										<div class="dropdown">
											<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="dropdown1" aria-haspopup="true" aria-expanded="false">
												Action
											</button>

											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown1">
												<a href="" class="dropdown-item">Edit</a>
												<a href="" class="dropdown-item">Delete</a>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		{{-- INNOVATIONS --}}
		<div class="tab-pane fade {{$tab == 'innovations' ? 'show active' : ''}}" id="innovations" aria-labelledby="innovations-tab" role="tabpanel">
			<div class="panel-content container-fluid py-3">
			</div>
		</div>
	</div>
</div>
@endsection