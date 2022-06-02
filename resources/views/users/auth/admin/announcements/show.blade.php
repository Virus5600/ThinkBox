@extends('template.admin')

@section('title', 'Announcements')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="{{ route('admin.announcements.index') }}" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Announcements</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12">
			<h2 class="font-weight-bold mb-2 text-center"><a href="{{$announcement->source}}" class="text-dark text-decoration-none text-wrap">{{$announcement->title}}</a></h2>

			<div class="text-center my-4 mx-3">
				<img src="/images/TEMPORARY/home/{{$announcement->image}}" alt='Announcement {{$announcement->id}}' class="img-fluid img-announcement cursor-pointer" data-toggle='modal' data-target='#modal' draggable='false'/>

				<div class="modal fade" id="modal" data-backdrop='static' role='dialog' aria-labelledby='announcementLabel{{$announcement->id}}' aria-hidden='true'>
					<div class="modal-dialog modal-xl modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="announcementLabel{{$announcement->id}}">{{$announcement->title}}</h5>

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<img src="/images/TEMPORARY/home/{{$announcement->image}}" alt='Announcement {{$announcement->id}}' class="img-fluid" draggable='false'/>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="text-wrap">{!!$announcement->content!!}</div>
		</div>
	</div>
</div>
@endsection