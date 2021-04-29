@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{route('admin.faculty-member.index')}}');" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-2"></i>Manage Faculty Members</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="row">
	<div class="col my-3">
		<form action="" method="{{-- POST --}}" enctype="multipart/form-data">
			<div class="row">
				{{-- PROFILE IMAGE --}}
				<div class="col-12 col-md-4">
					<div class="form-group text-center">
						<img src="/images/TEMPORARY/home/{{$staff->avatar}}" class="img-fluid avatar circle-border" id="avatar" width="250" height="250" alt="Profile Image">
						<input type="file" name="avatar" class="hidden" accept=".jpg,.jpeg,.png">
						<h6 id="profile_img">{{ $staff->avatar }}</h6>
						<small class="text-muted"><b>FORMATS ALLOWED:</b> JPEG, JPG, PNG</small>
					</div>
				</div>

				{{-- PERSONAL DETAILS --}}
				<div class="col-12 col-md-8">
					<div class="row">
						<div class="col-12 col-md-4 form-group">
							<label class="form-label" for="first_name">First Name</label>
							<input class="form-control" type="text" name="first_name" value="{{ $staff->first_name }}"/>
						</div>

						<div class="col-12 col-md-4 form-group">
							<label class="form-label" for="last_name">Last Name</label>
							<input class="form-control" type="text" name="last_name" value="{{ $staff->last_name }}"/>
						</div>

						<div class="col-6 col-md-2 form-group">
							<label class="form-label" for="suffix">Suffix</label>
							<input class="form-control" type="text" name="suffix" value="{{ $staff->suffix }}"/>
						</div>

						<div class="col-6 col-md-2 form-group">
							<label class="form-label" for="title">Title</label>
							<input class="form-control" type="text" name="title" value="{{ $staff->title }}"/>
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-md-4">
							<label class="form-label" for="contact_no">Contact No.</label>
							<input class="form-control" type="text" name="contact_no" data-mask title="+63 xxx xxx xxxx" value="{{ $staff->contact_no }}">
						</div>

						<div class="col-12 col-md-4">
							<label class="form-label" for="email">Email</label>
							<input class="form-control" type="email" name="email" value="{{ $staff->email }}">
						</div>
					</div>
				</div>
			</div>

			{{-- ABOUT --}}
			<div class="row my-3">
				<div class="col">
					<label class="form-label" for="about">About</label>
					<textarea class="form-control not-resizable" name="description" rows="5">{{ $staff->description }}</textarea>
				</div>
			</div>

			{{-- AFFILIATIONS & OTHER PROFILE --}}
			<div class="row">
				{{-- AFFILIATIONS --}}
				<div class="col-12 col-lg-6 mt-5">
					<h3>Affiliations</h3>

					<div class="row mx-2">
						<div class="col-4 offset-1">Position</div>
						<div class="col-7">Orgnization</div>
					</div>

					<hr class="hr-thick-50 border-gray mt-1 mb-3">
					<div id="affiliations">
						@if(count($positions) > 0)
						@for ($i = 1; $i <= count($positions); $i++)
						<div class="row m-2" id="affiliations{{$i}}">
							<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>
							<div class="col-4"><input class="form-control" name="position{{$i}}" value="{{$positions[$i-1]}}"/></div>
							<div class="col-6 col-md-7"><input class="form-control" name="organization{{$i}}" value="{{$organizations[$i-1]}}"/></div>
						</div>
						@endfor
						@else
						<div class="row mx-2">
							<div class="col">
								Nothing to show.
							</div>
						</div>
						@endif
					</div>
					<hr class="hr-thick-50 border-gray my-3">

					<div class="row">
						<div class="col-4">
							<input type="button" class="btn btn-primary add-row" value="Add Row" for="affiliations">
						</div>
					</div>
				</div>

				{{-- OTHER PROFILE --}}
				<div class="col-12 col-lg-6 mt-5">
					<h3>Other Profile</h3>
						
					<div class="row mx-2">
						<div class="col-4 offset-1">Website</div>
						<div class="col-7">URL</div>
					</div>

					<hr class="hr-thick-50 border-gray mt-1 mb-3">
					<div id="other_profiles">
						@if(count($website) > 0)
						@for ($i = 1; $i <= count($website); $i++)
						<div class="row m-2" id="other_profiles{{$i}}">
							<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>
							<div class="col-4">
								<select class="custom-select" name="website{{$i}}">
									<option value="facebook" {{$website[$i-1] == 'facebook' ? 'selected' : ''}}>Facebook</option>
									<option value="github" {{$website[$i-1] == 'github' ? 'selected' : ''}}>Github</option>
									<option value="google_scholar" {{$website[$i-1] == 'google_scholar' ? 'selected' : ''}}>Google Scholar</option>
									<option value="linked" {{$website[$i-1] == 'linked' ? 'selected' : ''}}>LinkedIn</option>
									<option value="twitter" {{$website[$i-1] == 'twitter' ? 'selected' : ''}}>Twitter</option>
								</select>
							</div>
							<div class="col-6 col-md-7"><input class="form-control" name="url{{$i}}" value="{{$url[$i-1]}}"/></div>
						</div>
						@endfor
						@else
						<div class="row mx-2">
							<div class="col">
								Nothing to show.
							</div>
						</div>
						@endif
					</div>
					<hr class="hr-thick-50 border-gray my-3">

					<div class="row">
						<div class="col-4">
							<input type="button" class="btn btn-primary add-row" value="Add Row" for="other_profiles">
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<button type="submit" class="btn btn-primary" data-action="update">Submit</button>
					<button type="button" class="btn border-primary text-primary" onclick="confirmLeave('{{ route('profile.index', ['1']) }}')">Cancel</button>
				</div>
			</div>
		</form>
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
				$("#avatar").attr("src", e.target.result);
				$("#profile_img").html(obj.files[0].name);
			}

			reader.readAsDataURL(obj.files[0])
		}
		else {
			$("#avatar").attr("src", "/images/users/default.png");
			$("#profile_img").html("default.png");
		}
	}

	$(document).ready(function() {
		// Profile Image Changing
		$("#avatar").on("click", function() {openInput($(this))});
		$("[name=avatar]").on("change", function() {swapImg(this)});

		// Remove Row button
		$("#affiliations, #other_profiles").on('click', '.remove-row', function(e) {
			let siblings = $(e.currentTarget).parent().parent('.row').parent().children();
			let removed = $(e.currentTarget).parent().parent('.row').attr('id');

			let passedRemove = false;
			for (let i = 0; i < siblings.length; i++) {
				if ($(siblings[i]).attr('id') == removed) {
					passedRemove = true;
					continue;
				}

				if (passedRemove && $(e.currentTarget).parent().parent('.row').parent().attr('id') == 'affiliations') {
					$(siblings[i]).attr('id', 'affiliations' + i);
					$(siblings[i]).children('.col-4').children('[name=position' + (i+1) + ']').attr('name', 'position' + i);
					$(siblings[i]).children('.col-7').children('[name=organization' + (i+1) + ']').attr('name', 'organization' + i);
				}
				else if (passedRemove && $(e.currentTarget).parent().parent('.row').parent().attr('id') == 'other_profiles') {
					$(siblings[i]).attr('id', 'other_profiles' + i);
					$(siblings[i]).children('.col-4').children('[name=website' + (i+1) + ']').attr('name', 'website' + i);
					$(siblings[i]).children('.col-7').children('[name=url' + (i+1) + ']').attr('name', 'url' + i);
				}
			}

			$(e.currentTarget).parent().parent('.row').remove();
		});

		// Add Row button
		$(".col-4").on('click', '.add-row', function(e) {
			let targetRow = "#" + $(e.currentTarget).attr('for');
			let lengthCount = $(targetRow).children().length + 1;
			
			if (targetRow == "#affiliations") {
				$(targetRow).append(
					'<div class="row m-2" id="affiliations' + lengthCount + '">' +
						'<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>' +
						'<div class="col-4"><input class="form-control" name="position' + lengthCount + '"/></div>' +
						'<div class="col-7"><input class="form-control" name="organization' + lengthCount + '"/></div>' +
					'</div>'
				);
			}
			else if (targetRow == "#other_profiles") {
				$(targetRow).append(
					`<div class="row m-2" id="other_profiles` + lengthCount + `">` +
						`<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>` +
						`<div class="col-4">` +
							`<select class="custom-select" name="website` + lengthCount + `">` +
								`<option value="facebook" selected><i class="fab fa-facebook-f mr-2"></i>Facebook</option>` +
								`<option value="github"><i class="fab fa-github mr-2"></i>Github</option>` +
								`<option value="google_scholar"><i class="fas fa-atom mr-2"></i>Google Scholar</option>` +
								`<option value="linked"><i class="fab fa-linkedin mr-2"></i>LinkedIn</option>` +
								`<option value="twitter"><i class="fab fa-twitter mr-2"></i>Twitter</option>` +
							`</select>` +
						`</div>` +
						`<div class="col-7"><input class="form-control" name="url` + lengthCount + `" /></div>` +
					`</div>`
				);
			}
		});
	});
</script>
@endsection