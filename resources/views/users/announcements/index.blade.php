@extends('template.user')

@section('title', 'Announcements')

@section('body')
<div class="px-0 mx-0" style="max-width: 100vw!important; width: auto!important; height: 50vh!important; background: #fff url('/images/UI/banners/research.jpg') no-repeat center; background-size: cover;">
	<div class="row h-100 darken-backdrop m-0" style="width: 100vw;">
		<div class="col-6 ml-5" style="position: relative; top: 25%;">
			<h1 class="text-light h3 h1-md">Announcements</h1>
			<hr class="hr-thick" style="border-color: white;" />
			<p class="text-light h4">Be updated with the latest announcements from the university.</p>
		</div>
	</div>
</div>

<div class="container-fluid my-5 mb-7">
	<div class="row">
		<form class="col-12 col-lg-3" action="{{route('announcements.index')}}" method="GET">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." value="{{$searchVal}}"/>
				<div class="input-group-append">
					<button type="submit" class="btn btn-custom"><i class="fas fa-search"></i></button>
				</div>
			</div>

			<hr class="hr-thick">

			<span class="font-weight-bold">Sort By</span>
			<div class="input-group">
				<select name="sortBy" class="custom-select" onchange="$('#announcementsParamSubmit').trigger('click');">
					<option value="date" {{$sortBy == 'date' ? 'selected' : ''}}>Date</option>
					<option value="title" {{$sortBy == 'title' ? 'selected' : ''}}>Title</option>
				</select>
			</div>

			<input type="submit" class="hidden" id="announcementsParamSubmit">
		</form>

		<div class="col col-lg-9 my-3 mt-lg-0">
			<div class="row">
				@php ($announcementCount = 0)
				@foreach ($announcements as $a)
				@if ($announcementCount < 3)
				<div class="col-12 col-md-4 my-3 mb-lg-3 mt-lg-0">
				@else
				<div class="col-12 col-md-4 my-3">
				@endif
					<div class="card dark-shadow h-100">
						<div class="card-body">
							<div class="announcement-img" style="background: #fff url('/uploads/announcements/{{$a->image}}') no-repeat center"></div>
							<h5 class="card-title text-truncate-2">{{$a->title}}</h5>
							<div class="card-text">
								{!!$a->content!!}
							</div>
						</div>
						
						<div class="card-footer">
							<div class="dropdown display-inline-block float-left">
								<a class='dropdown-toggle text-decoration-none share-dropdown underline-at-hover' href="" role='button' id='share' data-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-share-alt mr-1"></i> Share
								</a>

								<div class="dropdown-menu dropdown-menu-left" aria-labelledby='share'>
									<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://www.facebook.com/sharer.php?u={{$a->source}}'><i class="fab fa-facebook-f mr-2"></i>Facebook</a>
									{{-- <a class="dropdown-item share-link" href="javascript:void(0)" data-link='fb-messenger://share?link={{$a->source}}'><i class="fab fa-facebook-messenger mr-2"></i>Messenger</a> --}}
									<a class="dropdown-item share-link" href="javascript:void(0)" data-link='http://twitter.com/share?text=Payment%20Options&url={{$a->source}}'><i class="fab fa-twitter mr-2"></i>Twitter</a>
									<a class="dropdown-item" href="javascript:void(0)" data-copy-link='{{$a->source}}'><i class="fas fa-link mr-2"></i>Copy Link</a>
								</div>
							</div>

							<a class="float-right text-decoration-none read-more underline-at-hover" href="{{ route('announcements.show', [$a->id]) }}">View Details <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>
				</div>
				@php ($announcementCount++)
				@endforeach
			</div>
			
			<div class="row">
				<nav class="mx-auto">{{ $announcements->links() }}</nav>
			</div>
		</div>
	</div>
</div>
@endsection