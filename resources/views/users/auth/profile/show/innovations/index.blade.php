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
					<a href="{{route('profile.innovations.create')}}" class="btn btn-success px-2 py-1">Add Item</a>
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
							<td scope="col" class="font-weight-bold">Innovations URL/PDF File</td>
							<td scope="col" class="font-weight-bold">Date Published</td>
							<td scope="col" class="font-weight-bold">Date Added</td>
							<td></td>
						</tr>
					</thead>

					<tbody id="Innovations_table">
						@forelse ($innovations as $i)
						<tr>
							<td class="overflow-x-hidden text-overflow-ellipsis" style="max-width: 20vw;">{{$i->title}}</td>
							<td class="overflow-x-hidden text-overflow-ellipsis" style="max-width: 20vw;">{{$i->url}}</td>
							<td>{{$i->date_published->format('M d, Y')}}</td>
							<td>{{$i->date_added->format('M d, Y')}}</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a href="{{route('profile.innovations.edit', [$i->id])}}" class="dropdown-item">Edit</button>
										<a class="dropdown-item" href="">Delete</a>
									</div>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="4">Nothing to show</td>
						</tr>
						@endforelse
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