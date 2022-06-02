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
			<form action="{{ route('profile.topics.materials.index', [$topic->id]) }}" action="GET" class="row">
				<div class="col-12 col-lg-7 text-center text-lg-left overflow-x-hidden text-overflow-ellipsis"><h1 class="overflow-hidden text-overflow-ellipsis"><a href="{{ route('profile.topics.index') }}" class="text-decoration-none text-dark text-overflow-ellipsis"><i class="fas fa-chevron-left mr-2"></i>Course Materials - {{$topic->topic_name}}</a></h1></div>

				<div class="col-12 col-sm-4 col-lg-2 text-center text-md-left my-2">
					<a class="btn btn-success px-2 py-1 float-right" href="{{ route('profile.topics.materials.create', [$topic->id]) }}">Add Item</a>
				</div>
				
				<div class="col-12 col-sm-8 col-lg-3 text-center my-2">
					<div class="input-group">
						<input type="text" class="form-control" name="search" placeholder="Search..."/>
						<div class="input-group-append">
							<button type="button" class="btn btn-custom"><i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</form>

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
						@php ($i = 0)
						@foreach ($materials as $m)
						<tr>
							<td>{{$m->material_name}}</td>
							<td>{{$m->links[0]->url}}</td>
							<td>{{\Carbon\Carbon::parse($m->created_at)->format('M d, Y')}}</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-custom btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{ route('profile.topics.materials.edit', [$topic->id ,$m->id]) }}">Edit</a>
										<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#moveDetail{{$m->id}}">Move</a>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>

								{{-- MODAL FOR MOVING SINGLE MATERIAL --}}
								<div class="modal fade ui-front" id="moveDetail{{$m->id}}" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<form class="modal-content" action="{{route('profile.topics.materials.move', [$topic->id, $m->id])}}" method="POST" enctype="multipart/form-data">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Move Material</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" style="white-space: normal;">
												{{csrf_field()}}
												<div class="form-group">
													<label class="form-label font-weight-bold important-left">Move to this topic:</label>
													<input class="form-control autocomplete" type="text" name="topic" value="{{$m->topic->topic_name}}">
													<p>
														<span class="font-weight-bold">NOTE:</span> Editing the name will <span class="font-weight-bold">move</span> all the materials under this topic to the given topic.
													</p>
													<span style="color: #FC1838">{!!$errors->first('topic')!!}</span>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-custom-inverted" data-dismiss="modal">Close</button>
												<button type="submit" data-action="update" class="btn btn-custom">Save changes</button>
											</div>
										</form>
									</div>
								</div>
							</td>
						</tr>
						@php ($i++)
						@endforeach
					</tbody>
				</table>
			</div>

			<div class="d-flex flex-d-row">
				<nav class="mx-auto">{{ $materials->links() }}</nav>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(() => {
		@if (Session::has('toggle_modal'))
		$('[data-target="#moveDetail{{Session::get(`toggle_modal`)}}"]').trigger('click');
		@endif

		// AUTOCOMPLETE
		let availableTags = [
			@foreach ($topics as $t)
			'{{$t->topic_name}}',
			@endforeach
		];

		$('.autocomplete').autocomplete({
			source: availableTags,
			delay: 0
		});
	});
</script>
@endsection