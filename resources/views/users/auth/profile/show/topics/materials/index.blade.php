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
				<div class="col-12 col-lg-7 text-center text-lg-left overflow-x-hidden text-overflow-ellipsis"><h1 class="overflow-hidden text-overflow-ellipsis"><a href="{{ route('profile.topics.index') }}" class="text-decoration-none text-dark text-overflow-ellipsis"><i class="fas fa-chevron-left mr-2"></i>Course Materials - {{$topic->topic_name}}</a></h1></div>

				<div class="col-12 col-sm-4 col-lg-2 text-center text-md-left my-2">
					<a class="btn btn-success px-2 py-1 float-right" href="{{ route('profile.topics.materials.create', [$topic->id, true]) }}">Add Item</a>
				</div>
				
				<div class="col-12 col-sm-8 col-lg-3 text-center my-2">
					<div class="input-group">
						<input type="text" class="form-control" name="search" placeholder="Search..."/>
						<div class="input-group-append">
							<button type="button" class="btn btn-custom"><i class="fas fa-search"></i></button>
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
						@foreach ($materials as $m)
						<tr>
							<td>{{$m->material_name}}</td>
							<td>{{$m->url}}</td>
							<td>{{\Carbon\Carbon::parse($m->created_at)->format('M d, Y')}}</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-custom btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="">Edit</a>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>
						</tr>
						@endforeach
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
				if ($("#research_table").children().length >= 5) {
					location.reload(true);
				}
				else {
					$("#research_table").append(
						`<tr>` +
							`<td>` + $("[name=material_name]").val() + `</td>` +
							`<td>0</td>` +
							`<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>` +
							`<td>{{ \Carbon\Carbon::now()->format('M d, Y') }}</td>` +
							`<td>` +
								`<div class="dropdown">` +
									`<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-custom btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">` +
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
				}

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