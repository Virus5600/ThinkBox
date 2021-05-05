@extends('template.user')

@section('title', 'My Profile')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.innovations.index') }}')" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Innovations</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="" method="{{-- POST --}}" enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-6">
						<label class="form-label font-weight-bold" for="title">Innovation Title</label>
						<input type="text" class="form-control" name="title" value="{{$innovation->title}}"/>
					</div>

					<div class="col-md-6">
						<div class="row">
							<div class="col-md-2 my-auto">
								<div class="custom-control custom-switch custom-switch-md">
									<input type="checkbox" class="custom-control-input" name="is_file" id="is_file" {{$innovation->is_file ? 'checked' : ''}}>
									<label class="custom-control-label font-weight-bold pl-3 pt-1 pb-0" for="is_file">File</label>
								</div>
							</div>

							<div class="form-group col-10" id="source_parent">
								@if ($innovation->is_file)
								<label class="form-label">File</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="url" id="url" onchange="swapLbl(this);" accept=".pdf">
			  						<label class="custom-file-label font-weight-bold" for="url" id="file_label">{{$innovation->url}}</label>
			  					</div>
								@else
								<label class="form-label font-weight-bold" for="url">URL/Link to source</label>
								<input type="text" class="form-control" name="url" value="{{$innovation->url}}"/>
								@endif
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-12 col-md-6">
						{{-- TO BE UPDATED TO WORK AKIN TO PROJECT RUSH'S "ADD PROFESSIONAL TO PROJECT" --}}
						<label class="form-label font-weight-bold" for="authors">Authors</label>
						<input type="text" class="form-control" name="authors" value="{{$innovation->authors}}"/>
					</div>

					<div class="form-group col-12 col-md-6">
						<label class="form-label font-weight-bold" for="date_published">Date Publsihed</label>
						<input type="date" class="form-control" name="date_published" value="{{$innovation->date_published->format('Y-m-d')}}"/>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-12">
						<label class="form-label font-weight-bold" for="description">Abstract/Description</label>
						<textarea class="form-control not-resizable" rows="5" name="description" placeholder="Provide an abstract or description here...">{{$innovation->description}}</textarea>
					</div>
				</div>

				<div class="row">
					<div class="form-group">
						<label class="form-label font-weight-bold">Research Focus</label>
						<select class="custom-select">
							<option {{$innovation->focus == null ? 'selected' : ''}}>Select Research Focus</option>
							@foreach ($focus as $f)
							<option value="{{$f->id}}" {{$innovation->focus == $f->id ? 'selected' : ''}}>{{ucwords($f->name)}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row">
					<label class="form-label font-weight-bold">Miscellaneous</label>
					<div class="form-group col-12 d-flex flex-d-row">
						<div class="form-check mx-3">
							<input class="form-check-input" type="checkbox" name="is_viewable" id="is_viewable" {{$innovation->is_viewable ? 'checked' : ''}}/>
							<label class="form-check-label font-weight-bold" for="is_viewable">Viewable</label>
						</div>

						<div class="form-check mx-3">
							<input class="form-check-input" type="checkbox" name="is_downloadable" id="is_downloadable" {{$innovation->is_downloadable ? 'checked' : ''}}/>
							<label class="form-check-label font-weight-bold" for="is_downloadable">Downloadble</label>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<button type="submit" class="btn btn-primary" data-action="update">Submit</button>
						<a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.innovations.index') }}')" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#is_file').on('change', function() {
			if ($(this).prop('checked')) {
				let parent = $("#source_parent");
				parent.html(
					'<label class="form-label font-weight-bold">File</label>' +
					'<div class="custom-file">' +
						'<input type="file" class="custom-file-input" name="url" id="url" onchange="swapLbl(this);" accept=".pdf">' +
						@if ($innovation->is_file)
  						'<label class="custom-file-label" for="url" id="file_label">{{$innovation->url}}</label>' +
  						@else
  						'<label class="custom-file-label" for="url" id="file_label">Choose File</label>' +
  						@endif
  					'</div>'
				);
			}
			else {
				let parent = $("#source_parent");
				parent.html(
					'<label class="form-label font-weight-bold" for="url">URL/Link to source</label>' +
					@if ($innovation->is_file)
					'<input type="text" class="form-control" name="url" value="{{old("url")}}"/>'
					@else
					'<input type="text" class="form-control" name="url" value="{{$innovation->url}}"/>'
					@endif
				);
			}
		});
	});

	function swapLbl(obj) {
		if (obj.files && obj.files[0]) {
			let reader = new FileReader();

			reader.onload = function(e) {
				$("#file_label").html(obj.files[0].name);
			}

			reader.readAsDataURL(obj.files[0])
		}
		else {
			$("#file_label").html("Choose File");
		}
	}
</script>
@endsection