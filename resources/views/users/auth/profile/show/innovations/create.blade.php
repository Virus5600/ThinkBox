@extends('template.user')

@section('title', 'My Profile')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('profile.innovations.index') }}')" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Innovations</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="{{route('profile.innovations.store')}}" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}

				<div class="row">
					<div class="form-group col-lg-6">
						<label class="form-label font-weight-bold important" for="title">Innovation Title</label>
						<input type="text" class="form-control" name="title" value="{{old('title')}}"/>
						<span style="color: #FC1838">{{$errors->first('title')}}</span>
					</div>

					<div class="col-lg-6">
						<div class="row">
							<div class="form-group col-12" id="source_parent">
								<label class="form-label font-weight-bold important" for="url">URL/Link to source</label>
								<input type="text" class="form-control" name="url" value="{{old('url')}}"/>
								<span style="color: #FC1838" id="url_error">{!!$errors->first('url')!!}</span>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-lg-6">
						{{-- TO BE UPDATED TO WORK AKIN TO PROJECT RUSH'S "ADD PROFESSIONAL TO PROJECT" --}}
						<div class="row">
							<div class="form-group col-12 col-lg-6">
								<label class="form-label font-weight-bold important" for="registeredAuthors">Authors</label><br>
								<select class="selectpicker border rounded multiple-select w-100" name="registeredAuthors[]" data-live-search="true" multiple>
									@foreach ($staff as $s)
									<option value="{{$s->id}}" {{App\User::find(Auth::user()->id)->id == $s->id ? 'selected' : ''}}>{{$s->user->first_name}} {{$s->user->middle_name == null ? '' : substr($s->user->middle_name, 0) . '. '}}{{$s->user->last_name}}{{$s->user->suffix == null ? '' : ', ' . $s->user->suffix}}</option>
									@endforeach
								</select>
								<!-- <input type="text" class="form-control" name="authors" multiple="multiple" /> -->
								<span style="color: #FC1838">{{$errors->first('registeredAuthors')}}</span>
							</div>

							<div class="form-group col-12 col-lg-6">
								<label class="form-label font-weight-bold" for="authors">Authors</label>
								<span data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus click' title="You can add the authors who are not listed on the dropdown.<br><b>This is optional.</b>"><i class="far fa-question-circle ml-2"></i></span>
								<input type="text" class="form-control" name="authors" value="{{old('authors')}}"/>
								<span style="color: #FC1838">{{$errors->first('authors')}}</span>
							</div>
						</div>
					</div>

					<div class="form-group col-12 col-lg-6">
						<label class="form-label font-weight-bold important" for="date_published">Date Published</label>
						<input type="date" class="form-control" name="date_published" value="{{old('date_published')}}"/>
						<span style="color: #FC1838">{{$errors->first('date_published')}}</span>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-12">
						<label class="form-label font-weight-bold important" for="description">Abstract/Description</label>
						<textarea class="form-control not-resizable" rows="5" name="description" placeholder="Provide an abstract or description here...">{{old('description')}}</textarea>
						<span style="color: #FC1838">{{$errors->first('description')}}</span>
					</div>
				</div>

				<div class="row">
					<div class="col col-lg-6 form-group">
						<label class="form-label font-weight-bold">Innovation Focus</label><br>
						<select class="selectpicker border rounded multiple-select" name="focus[]" data-live-search="true" multiple>
							@foreach ($focus as $f)
							@if (old('focus') == null)
							<option value="{{$f->id}}">{{ucwords($f->name)}}</option>
							@else
							<option value="{{$f->id}}" {{in_array($f->id, old('focus')) ? 'selected' : ''}}>{{ucwords($f->name)}}</option>
							@endif
							@endforeach
						</select>
						<span style="color: #FC1838">{{$errors->first('focus')}}</span>
					</div>
				</div>

				<div class="row">
					<label class="form-label font-weight-bold">Miscellaneous</label>
					<div class="form-group col-12 d-flex flex-d-row" id="misc">
						<div class="form-check mx-3">
							<input class="form-check-input" type="checkbox" name="is_file_requestable" id="is_file_requestable" {{old('is_file_requestable') ? 'checked' : ''}}/>
							<label class="form-check-label font-weight-bold" for="is_file_requestable">Allow Requesting of Document Copy</label>
							<span data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus click' title="Check if you want to allow users to request for a copy of the document."><i class="far fa-question-circle ml-2"></i></span>
						</div>

						<div class="form-check mx-3">
							<input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" {{old('is_featured') ? 'checked' : ''}}/>
							<label class="form-check-label font-weight-bold" for="is_featured">Feature this Document</label>
							<span data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus click' title="Check if you want to feature this document. Featured documents will also be visible to Guest Users."><i class="far fa-question-circle ml-2"></i></span>
						</div>
					</div>
				</div>

				<div class="row">
					<label class="form-label font-weight-bold">File(s)</label>
					<div class="form-group col-12 d-flex flex-d-col mb-1" id="files">
						<div class="custom-file my-2">
							<input type="file" class="custom-file-input cursor-pointer" name="file[]" onchange="swapLbl(this);" accept=".pdf">
	  						<label class="custom-file-label font-weight-bold cursor-pointer" style="overflow: hidden; white-space: nowrap">Choose File</label>
	  						<span style="position: absolute; top: -0.75rem; right: -0.5rem; z-index: 1; cursor: pointer; font-size: medium;" class="text-custom close-btn" tabindex="1"><i class="fas fa-times-circle fa-lg"></i></span>
	  					</div>
					</div>

					<div class="form-group col-12 d-flex flex-d-col mt-1">
						<button type="button" class="btn btn-custom-inverted w-100" id="addFileField" style="border-style: dashed; border-width: 0.125rem;"><i class="fas fa-plus-circle mr-1"></i>Add File Field</button>
					</div>
				</div>

				<div class="row">
					<div class="col text-center text-lg-left">
						<button type="submit" class="btn btn-custom" data-action="submit">Submit</button>
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
	});

	function swapLbl(obj) {
		let elm = $('#files');
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