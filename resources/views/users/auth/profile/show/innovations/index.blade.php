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
					<form class="input-group" action="{{route('profile.innovations.index')}}" method="GET">
						<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$searchVal}}"/>
						<div class="input-group-append">
							<button type="button" class="btn btn-custom"><i class="fas fa-search"></i></button>
						</div>
					</form>
				</div>
			</div>

			<div class="row overflow-x-auto" style="white-space: nowrap; display: block;">
				<table class="table">
					<thead>
						<tr>
							<td scope="col" class="font-weight-bold">Innovations Title</td>
							<td scope="col" class="font-weight-bold">Innovations URL/PDF File</td>
							<td scope="col" class="font-weight-bold">Featured</td>
							<td scope="col" class="font-weight-bold">Date Published</td>
							<td scope="col" class="font-weight-bold">Date Added</td>
							<td></td>
						</tr>
					</thead>

					<tbody id="innovations_table">
						@forelse ($innovations as $i)
						<tr>
							<td class="overflow-x-hidden text-overflow-ellipsis" style="max-width: 15vw;">{{$i->title}}</td>
							<td class="overflow-x-hidden text-overflow-ellipsis" style="max-width: 15vw;">{{$i->url == null ? $i->getFileNames(1) : $i->url}}</td>
							<td>
								@if ($i->is_featured)
								<i class="fas fa-circle fa-sm text-success mr-1"></i>Featured
								@else
								<i class="fas fa-circle fa-sm text-danger mr-1"></i>Not Featured
								@endif
							</td>
							<td>{{\Carbon\Carbon::parse($i->date_published)->format('M d, Y')}}</td>
							<td>{{\Carbon\Carbon::parse($i->created_at)->format('M d, Y')}}</td>
							<td>
								<div class="dropdown">
									<a href='javascript:void(0)' role="button" class="dropdown-toggle btn btn-custom btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Action
									</a>
									
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{route('innovations.show', [$i->id])}}">View</a>
										<a href="{{route('profile.innovations.edit', [$i->id])}}" class="dropdown-item">Edit</a>
										<a href="{{route('profile.innovations.toggle.is_featured', [$i->id])}}" class="dropdown-item">{{$i->is_featured ? 'Remove as featured' : 'Add as featured'}}</a>
										<a href="javascript:void(0);" onclick="confirmDelete('{{ route('profile.innovations.delete', [$i->id]) }}', '{{$i->title}}')" class="dropdown-item">Delete</a>
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