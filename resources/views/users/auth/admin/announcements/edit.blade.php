@extends('template.admin')

@section('title', 'Announcements')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('admin.announcements.index') }}')" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Announcements</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-0 px-lg-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="{{ route('admin.announcements.update', [$announcement->id]) }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="row">
					<div class="col-12 col-lg-6">
						{{-- ANNOUNCEMENT IMAGE --}}
						<div class="form-group text-center text-lg-left w-100" style="max-height: 20rem;">
							<label class="h5" for="image">Announcement Image</label><br>
							<img src="{{ asset('uploads/announcements/' . $announcement->image) }}" class="img-fluid cursor-pointer border" style="border-width: 0.25rem!important; max-height: 16.25rem;" id="image" alt="Announcement Image">
							<input type="file" name="image" class="hidden" accept=".jpg,.jpeg,.png"><br>
							<small class="text-muted"><b>FORMATS ALLOWED:</b> JPEG, JPG, PNG</small>
						</div>
					</div>

					<div class="col-12 col-lg-6">
						<div class="form-group">
							<label class="h5 important" for="title">Title</label>
							<input class="form-control" type="text" name="title" value="{{$announcement->title}}"/>
						</div>

						<div class="form-group">
							<label class="h5" for="source">Source</label>
							<input class="form-control" type="text" name="source" value="{{$announcement->source}}"/>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<label class="h5 important" for="content">Content</label>
						<textarea class="form-control summernote" name="content" rows="5" style="resize: none;">{!!$announcement->content!!}</textarea>
					</div>
				</div>

				<div class="row py-3">
					<div class="col">
						<button type="submit" class="btn btn-primary" data-action="update">Submit</button>
						<button type="button" class="btn border-primary text-primary" onclick="confirmLeave('{{ route('admin.announcements.index') }}')">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	function openInput(obj) {
		$("[name=" + obj.attr("id") + "]").trigger("click");
	}

	function swapImg(obj) {
		if (obj.files && obj.files[0]) {
			let reader = new FileReader();

			reader.onload = function(e) {
				$("#image").attr("src", e.currentTarget.result);
			}

			reader.readAsDataURL(obj.files[0])
		}
		else {
			$("#image").attr("src", "{{ asset('uploads/announcements/' . $announcement->image) }}");
		}
	}

	$(document).ready(function() {
		// Profile Image Changing
		$("#image").on("click", function() {openInput($(this))});
		$("[name=image]").on("change", function() {swapImg(this)});
	});
</script>
@endsection