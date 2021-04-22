@extends('template.user')

@section('title', 'Announcements')

@section('body')
<h2 class="h2-lg h4 mx-5 my-4"><a href="{{route('announcements.index')}}" class="text-dark text-decoration-none"><i class="fas fa-chevron-left fa-lg mr-3"></i>Announcements</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 col-md-9">
			<h2 class="font-weight-bold mb-2 text-center"><a href="{{$announcements->source}}" class="text-dark text-decoration-none">{{$announcements->title}}</a></h2>

			<div class="text-center my-4 mx-3">
				<img src="/images/TEMPORARY/home/{{$announcements->image}}" alt='Announcement {{$announcements->id}}' class="img-fluid img-announcement cursor-pointer" data-toggle='modal' data-target='#modal' draggable='false'/>

				<div class="modal fade" id="modal" data-backdrop='static' role='dialog' aria-labelledby='announcementLabel{{$announcements->id}}' aria-hidden='true'>
					<div class="modal-dialog modal-xl modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="announcementLabel{{$announcements->id}}">{{$announcements->title}}</h5>

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<img src="/images/TEMPORARY/home/{{$announcements->image}}" alt='Announcement {{$announcements->id}}' class="img-fluid" draggable='false'/>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div>{!!$announcements->content!!}</div>
		</div>

		<div class="col-3 d-none d-md-block">
			<div class="card">
				<h4 class="card-header card-title">Other Announcements</h4>

				<div class="card-body d-flex flex-d-col flex-d-spacing-2">
					@foreach ($otherAnnouncements as $o)
					<div class="announcement-img d-flex flex-d-inv-col p-0" style="background: #fff url('/images/TEMPORARY/home/{{$o->image}}') no-repeat center;">
						<a href="{{ route('announcements.show', [$o->id]) }}" class="text-white text-decoration-none other-announcement custom-hover"><h5 class="card-title text-truncate p-1 pb-2 m-0 text-center">{{$o->title}}</h5></a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection