@extends('template.user')

@section('title', 'My Profile')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.topics.materials.index', [$selected_topic->id]) }}')" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>{{$selected_topic->topic_name}}</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="{{route('profile.topics.store')}}" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="hidden" name="fromMats" value="true"/>

				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="topic_name" class="form-label font-weight-bold important">Topic Name</label>
							<input type="text" class="form-control" value="{{$selected_topic->topic_name}}" disabled/>
							<input type="hidden" name="topic_name" id="topic_name" class="form-control" value="{{$selected_topic->topic_name}}"/>
							<span style="color: #FC1838">{!!$errors->first('topic_name')!!}</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="material_name" class="form-label font-weight-bold important">Material Name/Title</label>
							<input type="text" name="material_name" id="material_name" class="form-control" value="{{old('material_name')}}"/>
							<span style="color: #FC1838">{!!$errors->first('material_name')!!}</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-6">
						<div class="row">
							<div class="form-group col-12 col-lg-10" id="source_parent">
								@if (old('is_file') == 1)
								<label class="form-label">File</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="url" id="url" onchange="swapLbl(this);" accept=".pdf,.pptx,.docx">
			  						<label class="custom-file-label font-weight-bold" for="url" id="file_label" style="overflow: hidden; white-space: nowrap">Choose File</label>
			  					</div>
								@else
								<label class="form-label font-weight-bold important" for="url">URL/Link to source</label>
								<input type="text" class="form-control" name="url" value="{{old('url')}}"/>
								@endif
								<span style="color: #FC1838" id="url_error">{!!$errors->first('url')!!}</span>
							</div>

							<div class="col-12 col-lg-2 my-lg-auto mb-3 my-lg-0 text-center text-lg-left">
								<div class="custom-control custom-switch custom-switch-md">
									<input type="checkbox" class="custom-control-input" name="is_file" id="is_file">
									<label class="custom-control-label font-weight-bold pl-3 pt-1 pb-0" for="is_file">File</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-6">
						<label for="description" class="form-label font-weight-bold important">Description</label>
						<textarea class="form-control" name="description" id="description" placeholder="Description goes here..." rows="5">{{old('description')}}</textarea>
						<span style="color: #FC1838">{!!$errors->first('description')!!}</span>
					</div>
				</div>

				<br>
				<div class="row">
					<div class="col-12 text-center text-lg-left">
						<button type="submit" class="btn btn-custom" data-action="submit">Submit</button>
						<a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.topics.index') }}')" class="btn btn-secondary">Cancel</a>
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
		// AUTOCOMPLETE
		let availableTags = [
			@foreach ($topics as $t)
			'{{$t->topic_name}}',
			@endforeach
		];

		$('#topic_name').autocomplete({
			source: availableTags,
			delay: 0
		});
		
		$('#is_file').on('change', function() {
			if ($(this).prop('checked')) {
				let parent = $("#source_parent");
				parent.html(
					'<label class="form-label font-weight-bold important">File</label>' +
					'<div class="custom-file">' +
						'<input type="file" class="custom-file-input cursor-pointer" name="url" id="url" onchange="swapLbl(this);" accept=".pdf,.pptx,.docx">' +
  						'<label class="custom-file-label cursor-pointer" for="url" id="file_label" style="overflow: hidden; white-space: nowrap">Choose file</label>' +
  					'</div>' + 
  					`<span style="color: #FC1838" id="url_error">{!!$errors->first('url')!!}</span>`
				);
				$('#misc').find('input').prop('disabled', false);
			}
			else {
				let parent = $("#source_parent");
				parent.html(
					'<label class="form-label font-weight-bold important" for="url">URL/Link to source</label>' +
					'<input type="text" class="form-control" name="url" value="{{old("url")}}"/>' +
					`<span style="color: #FC1838" id="url_error">{!!$errors->first('url')!!}</span>`
				);
				$('#misc').find('input').prop('disabled', true);
			}
		});
		
		@if (old('is_file'))
		$('[name=is_file]').click();
		@endif
	});

	function swapLbl(obj) {
		// IS_FILE
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