@extends('template.user')

@section('title', 'My Profile')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.topics.materials.index', [$selected_topic->id]) }}')" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Topics</a></h2>
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

					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="material_name" class="form-label font-weight-bold important">Material Name/Title</label>
							<input type="text" name="material_name" id="material_name" class="form-control" value="{{old('material_name')}}"/>
							<span style="color: #FC1838">{!!$errors->first('material_name')!!}</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">
						<label for="description" class="form-label font-weight-bold important">Description</label>
						<textarea class="form-control" name="description" id="description" placeholder="Description goes here..." rows="5">{{old('description')}}</textarea>
						<span style="color: #FC1838">{!!$errors->first('description')!!}</span>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-6">
						<label class="form-label font-weight-bold">File(s)</label>

						<div class="form-group col-12 d-flex flex-d-col mb-1" id="files">
							<div class="custom-file my-2">
								<input type="file" class="custom-file-input cursor-pointer" name="file[]" onchange="swapLbl(this);" data-target="#files" accept=".pdf">
		  						<label class="custom-file-label font-weight-bold cursor-pointer" style="overflow: hidden; white-space: nowrap">Choose File</label>
		  						<span style="position: absolute; top: -0.75rem; right: -0.625rem; z-index: 1; cursor: pointer; font-size: medium;" class="text-custom close-btn" tabindex="1"><i class="fas fa-times-circle fa-lg"></i></span>
		  					</div>
						</div>
						@if ($errors->has('file.*'))
							@foreach ($errors->get('file.*') as $e)
			  				<span style="color: #FC1838">{!!$e!!}</span>
			  				@endforeach
		  				@endif

						<div class="form-group col-12 d-flex flex-d-col mt-1">
							<button type="button" class="btn btn-custom-inverted w-100" id="addFileField" style="border-style: dashed; border-width: 0.125rem;"><i class="fas fa-plus-circle mr-1"></i>Add File Field</button>
						</div>
					</div>

					<div class="col-12 col-md-6">
						<label class="form-label font-weight-bold">Link(s)</label>

						<div class="form-group col-12 d-flex flex-d-col mb-1" id="links">
							@if (!is_null(old('url')))
							@for ($i = 0; $i < count(old('url')); $i++)
							<div class="my-2" style="display: inline-block; position: relative;">
								<input type="text" class="form-control" name="url[]" placeholder="URL" value="{{old('url.'.$i)}}">
		  						<span style="position: absolute; top: -0.75rem; right: -0.625rem; z-index: 1; cursor: pointer; font-size: medium;" class="text-custom close-btn" tabindex="1"><i class="fas fa-times-circle fa-lg"></i></span>
		  						<span style="color: #FC1838">{!!$errors->first('url.'.$i)!!}</span>
		  					</div>
		  					@endfor
							@else
							<div class="my-2" style="display: inline-block; position: relative;">
								<input type="text" class="form-control" name="url[]" placeholder="URL">
		  						<span style="position: absolute; top: -0.75rem; right: -0.625rem; z-index: 1; cursor: pointer; font-size: medium;" class="text-custom close-btn" tabindex="1"><i class="fas fa-times-circle fa-lg"></i></span>
		  					</div>
							@endif
						</div>

						<div class="form-group col-12 d-flex flex-d-col mt-1">
							<button type="button" class="btn btn-custom-inverted w-100" id="addLinkField" style="border-style: dashed; border-width: 0.125rem;"><i class="fas fa-plus-circle mr-1"></i>Add Link Field</button>
						</div>
					</div>
				</div>

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

		$(document).on('click', '.text-custom.close-btn', (e) => {
			if ($(e.currentTarget).parent().parent().children().length > 1)
				$(e.currentTarget).parent().remove();
		});

		$('#addFileField').on('click', (e) => {
			$('#files').append(
				`<div class="custom-file my-2">` +
					`<input type="file" class="custom-file-input cursor-pointer" name="file[]" onchange="swapLbl(this);" accept=".pdf">` +
					`<label class="custom-file-label font-weight-bold cursor-pointer" style="overflow: hidden; white-space: nowrap">Choose File</label>` +
					`<span style="position: absolute; top: -0.75rem; right: -0.5rem; z-index: 1; cursor: pointer; font-size: medium;" class="text-custom close-btn" tabindex="1"><i class="fas fa-times-circle fa-lg"></i></span>` +
				`</div>`
			);
		});

		$('#addLinkField').on('click', (e) => {
			$('#links').append(
				`<div class="my-2" style="display: inline-block; position: relative;">` +
					`<input type="text" class="form-control" name="url[]" placeholder="URL">` +
					`<span style="position: absolute; top: -0.75rem; right: -0.625rem; z-index: 1; cursor: pointer; font-size: medium;" class="text-custom close-btn" tabindex="1"><i class="fas fa-times-circle fa-lg"></i></span>` +
				`</div>`
			);
		});
	});

	function swapLbl(obj) {
		let elm = $($(obj).attr('data-target'));
		if (obj.files && obj.files[0]) {
			let reader = new FileReader();

			reader.onload = function(e) {
				$(obj).siblings('label').html(obj.files[0].name);
				$(obj).prop('data-has-file', 1);
			}

			reader.readAsDataURL(obj.files[0])
		}
		else {
			$("#file_label").html("Choose File");

			if (elm.children().length > 1) {
				$(obj).parent().remove();
			}
		}
	}
</script>
@endsection