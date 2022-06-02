@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{route('admin.faculty-member.index')}}');" class="text-dark text-decoration-none font-weight-normal"><i class="fas fa-chevron-left fa-lg mr-2"></i>Manage Faculty Members</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="row">
	<div class="col my-3">
		<form action="{{ route('admin.faculty-member.update', [$staff->id]) }}" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}

			<div class="row">
				{{-- PROFILE IMAGE --}}
				<div class="col-12 col-md-4">
					{{-- FILE IMAGE --}}
					<div class="form-group text-center collapse {{$staff->user->isAvatarLink ? '' : 'show'}} avatar_holder" id="fileAvatar">
						<label class="form-label font-weight-bold" for="avatar">Avatar</label><br>
						<div class="hover-cam mx-auto avatar">
							<img src="/uploads/users/{{$staff->user->avatar == null ? 'default.png' : ($staff->user->isAvatarLink ? 'default.png' : '/user' . $staff->user_id . '/' . $staff->user->avatar)}}" class="hover-zoom img-fluid avatar circle-border" width="250" height="250" id="avatarContainer" alt="Profile Image">
							<span class="icon circle-border text-center" id="avatar">
								<i class="fas fa-camera text-white hover-icon-2x"></i>
							</span>
						</div>
						<input type="file" {{$staff->user->isAvatarLink ? '' : 'name=avatar'}} class="hidden" accept=".jpg,.jpeg,.png">
						<h6 id="profile_img">{{$staff->user->avatar == null ? 'default.png' : 'profile' . substr($staff->user->avatar, strripos($staff->user->avatar, '.'), strlen($staff->user->avatar))}}</h6>
						<small class="text-muted pb-0 mb-0"><b>FORMATS ALLOWED:</b> JPEG, JPG, PNG</small><br>
						<small class="text-muted pt-0 mt-0"><b>MAX SIZE:</b> 5MB</small>
					</div>

					{{-- URL IMAGE --}}
					<div class="form-group text-center collapse {{$staff->user->isAvatarLink ? 'show' : ''}} avatar_holder" id="linkAvatar">
						<label class="form-label font-weight-bold" for="avatarLink">Avatar</label><br>
						<img src="{{$staff->user->avatar == null ? '/uploads/users/default.png' : ($staff->user->isAvatarLink ? $staff->user->avatar : '/uploads/users/default.png')}}" class="img-fluid avatar circle-border" style="cursor: default!important;" id="avatarLink" width="250" height="250" alt="Profile Image">
						<input type="text" {{$staff->user->isAvatarLink ? 'name=avatar' : ''}} class="form-control mt-2 w-75 mx-auto" placeholder="Image URL" value="{{$staff->user->isAvatarLink ? $staff->user->avatar : ''}}"/>
					</div>

					{{-- AVATAR ERROR --}}
					<div class="text-center">
						<span style="color: #FC1838">{{$errors->first('avatar')}}</span>
					</div>
				</div>

				{{-- PERSONAL DETAILS --}}
				<div class="col-12 col-md-8 d-flex flex-d-col">
					<div class="row order-1 order-md-0">
						<div class="col-12 col-md-4 form-group">
							<label class="form-label font-weight-bold important" for="first_name">First Name</label>
							<input class="form-control" type="text" name="first_name" value="{{$staff->user->first_name}}"/>
							<span style="color: #FC1838">{{$errors->first('first_name')}}</span>
						</div>

						<div class="col-12 col-md-4 form-group">
							<label class="form-label font-weight-bold" for="middle_name">Middle Name</label>
							<input class="form-control" type="text" name="middle_name" value="{{$staff->user->middle_name}}"/>
							<span style="color: #FC1838">{{$errors->first('middle_name')}}</span>
						</div>

						<div class="col-12 col-md-4 form-group">
							<label class="form-label font-weight-bold important" for="last_name">Last Name</label>
							<input class="form-control" type="text" name="last_name" value="{{$staff->user->last_name}}"/>
							<span style="color: #FC1838">{{$errors->first('last_name')}}</span>
						</div>
					</div>

					<div class="row order-2 order-md-1">
						<div class="col-6 col-md-2 form-group">
							<label class="form-label font-weight-bold" for="title">Title</label>
							<input class="form-control" type="text" name="title" value="{{$staff->user->title}}"/>
							<span style="color: #FC1838">{{$errors->first('title')}}</span>
						</div>

						<div class="col-6 col-md-2 form-group">
							<label class="form-label font-weight-bold" for="suffix">Suffix</label>
							<input class="form-control" type="text" name="suffix" value="{{$staff->user->suffix}}"/>
							<span style="color: #FC1838">{{$errors->first('suffix')}}</span>
						</div>

						<div class="col-12 col-md-4">
							<label class="form-label font-weight-bold" for="contact_no">Contact No.</label>
							<input class="form-control" type="text" name="contact_no" data-mask title="+63 xxx xxx xxxx" value="{{$staff->user->contact_no}}">
							<span style="color: #FC1838">{{$errors->first('contact_no')}}</span>
						</div>

						<div class="col-12 col-md-4">
							<label class="form-label font-weight-bold" for="email">Email</label>
							<input class="form-control" type="email" name="email" value="{{$staff->user->email}}">
							<span style="color: #FC1838">{{$errors->first('email')}}</span>
						</div>
					</div>

					<div class="row order-0 order-md-2">
						<div class="col-12 col-md-4 form-group my-auto">
							<div class="custom-control custom-switch custom-switch-md text-center">
								<input type='checkbox' class="custom-control-input disable-while-animating" id="isAvatarLink" data-toggle="collapse" data-target=".avatar_holder" name="isAvatarLink" {{ $staff->user->isAvatarLink ? 'checked' : ''}} data-animating-target='#fileAvatar'/>
								<label class="custom-control-label pt-1 pl-3" for="isAvatarLink">Use an online image.</label>
							</div>
						</div>

						<div class="col-12 col-md-4 form-group my-auto text-center">
							<input type="button" id="removeAvatar" class="btn btn-custom" value="Remove Image"/>
						</div>
					</div>
				</div>
			</div>

			{{-- ABOUT --}}
			<div class="row my-3">
				<div class="col">
					<label class="form-label font-weight-bold float-left" for="about">About</label>
					<span class="float-right" style="color: #FC1838">{{$errors->first('description')}}</span>
					<textarea class="form-control not-resizable" name="description" rows="5">{{$staff->description}}</textarea>
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
						@if(count($staff->affiliations) > 0)
						@for ($i = 1; $i <= count($staff->affiliations); $i++)
						<div class="row m-2" id="affiliations{{$i}}">
							<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>
							<div class="col-4"><input class="form-control" name="position[]" value="{{$staff->affiliations[$i-1]->position}}"/></div>
							<div class="col-6 col-md-7"><input class="form-control" name="organization[]" value="{{$staff->affiliations[$i-1]->organization}}"/></div>
						</div>
						@endfor
						@else
						<div class="row mx-2" id="affiliations_empty">
							<div class="col">
								Nothing to show.
							</div>
						</div>
						@endif
					</div>
					<hr class="hr-thick-50 border-gray my-3">
					@foreach ($errors->all() as $e)
					@if ($e == "Position is required.")
					<span class="float-right" style="color: #FC1838">{{$e}}</span>
					@endif
					@if ($e == "Organization is required.")
					<span class="float-right" style="color: #FC1838">{{$e}}</span>
					@endif
					@endforeach

					<div class="row">
						<div class="col-4">
							<input type="button" class="btn btn-custom add-row" value="Add Row" for="affiliations">
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
						@if(count($staff->otherProfiles) > 0)
						@for ($i = 1; $i <= count($staff->otherProfiles); $i++)
						<div class="row m-2" id="other_profiles{{$i}}">
							<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>
							<div class="col-4">
								<select class="custom-select" name="website[]">
									<option value="Facebook" {{$staff->otherProfiles[$i-1]->website == 'Facebook' ? 'selected' : ''}}>Facebook</option>
									<option value="Github" {{$staff->otherProfiles[$i-1]->website == 'Github' ? 'selected' : ''}}>Github</option>
									<option value="Google Scholar" {{$staff->otherProfiles[$i-1]->website == 'Google Scholar' ? 'selected' : ''}}>Google Scholar</option>
									<option value="LinkedIn" {{$staff->otherProfiles[$i-1]->website == 'LinkedIn' ? 'selected' : ''}}>LinkedIn</option>
									<option value="Twitter" {{$staff->otherProfiles[$i-1]->website == 'Twitter' ? 'selected' : ''}}>Twitter</option>
								</select>
							</div>
							<div class="col-6 col-md-7"><input class="form-control" name="url[]" value="{{$staff->otherProfiles[$i-1]->url}}"/></div>
						</div>
						@endfor
						@else
						<div class="row mx-2" id="other_profiles_empty">
							<div class="col">
								Nothing to show.
							</div>
						</div>
						@endif
					</div>
					<hr class="hr-thick-50 border-gray my-3">
					@foreach ($errors->all() as $e)
					@if ($e == "URL is required.")
					<span class="float-right" style="color: #FC1838">{{$e}}</span>
					@endif
					@endforeach
					<div class="row">
						<div class="col-4">
							<input type="button" class="btn btn-custom add-row" value="Add Row" for="other_profiles">
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<button type="submit" class="btn btn-custom" data-action="update">Submit</button>
					<button type="button" class="btn border-custom text-custom" onclick="confirmLeave('{{route('admin.faculty-member.index')}}');">Cancel</button>
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

	function swapImgFile(obj) {
		if (obj.files && obj.files[0]) {
			let reader = new FileReader();

			reader.onload = function(e) {
				$("#avatarContainer").attr("src", e.target.result);
				$("#profile_img").html(obj.files[0].name);
			}

			reader.readAsDataURL(obj.files[0])
		}
		else {
			$("#avatarContainer").attr("src", "/uploads/users/{{$staff->user->avatar == null ? 'default.png' : ($staff->user->isAvatarLink ? 'default.png' : '/user' . $staff->user_id . '/' . $staff->user->avatar)}}");
			$("#profile_img").html("{{$staff->user->avatar == null ? 'default.png' : ($staff->user->isAvatarLink ? 'default.png' : 'profile' . substr($staff->user->avatar, strripos($staff->user->avatar, '.'), strlen($staff->user->avatar)))}}");
		}
	}

	$(document).ready(function() {
		// Profile Image Changing
		$("#avatar").on("click", function() {
			openInput($(this));
		});

		$("#fileAvatar input").on("change", function() {swapImgFile(this)});
		$("#linkAvatar input").on("change, keyup", function(e) {
			let obj = $(e.currentTarget);

			if (obj.val().length == 0)
				$("#avatarLink").attr("src", "/uploads/users/{{$staff->user->avatar == null ? 'default.png' : ($staff->user->isAvatarLink ? '/user' . $staff->user_id . '/' . $staff->user->avatar : 'default.png')}}");
			else {
				$("#avatarLink").attr("src", obj.val());

				$("#avatarLink").bind("error", function(e) {
					$(e.currentTarget).attr("src", "/uploads/users/default.png");
				})
			}
		});

		// Profile Image Changing method swapping (File to URL and vice versa)
		$("#isAvatarLink").on('change, click', function(e) {
			let obj = $(e.currentTarget);
			$("input[name=avatar]").removeAttr('name');

			if (obj.prop('checked')) {
				$("#linkAvatar input").attr('name', 'avatar');
			}
			else {
				$("#fileAvatar input").attr('name', 'avatar');
			}
		});

		// Removing Profile Image
		$("#removeAvatar").on('click', function(e) {
			if ($("#isAvatarLink").prop('checked'))
				$("#isAvatarLink").trigger("click");

			$.ajax({
				url: "{{route('profile.removeAvatar')}}",
				type: "POST",
				data: {
					"_token": '{{csrf_token()}}',
					'id': {{Auth::user()->id}}
				},
				success: function(response) {
					Swal.fire({
						icon: `info`,
						title: response.success,
						position: `top`,
						showConfirmButton: false,
						toast: true,
						timer: 5000,
						background: `#17a2b8`,
						customClass: {
							title: `text-white`,
							popup: `px-3`
						},
					});

					$("#avatarContainer").attr("src", "/uploads/users/default.png");
					$("#profile_img").html("default.png");
				},
				error: function(response) {
					Swal.fire({
						icon: `error`,
						title: `Success`,
						html: `<div class='text-white'>`+JSON.stringify(response)+`</div>`,
						confirmButtonText: 'Ok',
						background: `#dc3545`,
						customClass: {
							title: `text-white`,
							popup: `px-3`
						},
					});
				}
			});
		});

		// Remove Row button
		$("#affiliations, #other_profiles").on('click', '.remove-row', function(e) {
			let obj = $(e.currentTarget);
			Swal.fire({
				icon: 'info',
				title: 'Are you sure you want to remove this ' + (obj.id == "affiliations" ? "Affiliations" : "Other Profile") + '?',
				text: $(obj.parent().siblings()[0]).children(0).val() + ' - ' + $(obj.parent().siblings()[1]).children(0).val(),
				position: 'center',
				showConfirmButton: true,
				showCancelButton: true,
				confirmButtonText: "Yes",
				cancelButtonText: "No",
				confirmButtonColor: "#28a745",
				cancelButtonColor: "#dc3545",
				background: `#17a2b8`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			}).then((result) => {
				if (result.isConfirmed) {
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
						}
						else if (passedRemove && $(e.currentTarget).parent().parent('.row').parent().attr('id') == 'other_profiles') {
							$(siblings[i]).attr('id', 'other_profiles' + i);
						}
					}

					if ($(e.currentTarget).parent().parent('.row').parent().children().length == 1) {
						$(e.currentTarget).parent().parent('.row').parent().append(
							`<div class="row mx-2" id="` + $(e.currentTarget).parent().parent('.row').parent().attr('id') + `_empty">` +
								`<div class="col">` +
									`Nothing to show.` +
								`</div>` +
							`</div>`
						);
					}

					$(e.currentTarget).parent().parent('.row').remove();
				}
			});
		});

		// Add Row button
		$(".col-4").on('click', '.add-row', function(e) {
			let targetRow = "#" + $(e.currentTarget).attr('for');
			let lengthCount = $(targetRow).children().length + 1 - $(targetRow + "_empty").length;

			if ($(targetRow + "_empty").length == 1)
				$(targetRow + "_empty").remove();
			
			if (targetRow == "#affiliations") {
				$(targetRow).append(
					'<div class="row m-2" id="affiliations' + lengthCount + '">' +
						'<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>' +
						'<div class="col-4"><input class="form-control" name="position[]"/></div>' +
						'<div class="col-7"><input class="form-control" name="organization[]"/></div>' +
					'</div>'
				);
			}
			else if (targetRow == "#other_profiles") {
				$(targetRow).append(
					`<div class="row m-2" id="other_profiles` + lengthCount + `">` +
						`<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>` +
						`<div class="col-4">` +
							`<select class="custom-select" name="website[]">` +
								`<option value="facebook" selected><i class="fab fa-facebook-f mr-2"></i>Facebook</option>` +
								`<option value="github"><i class="fab fa-github mr-2"></i>Github</option>` +
								`<option value="google_scholar"><i class="fas fa-atom mr-2"></i>Google Scholar</option>` +
								`<option value="linked"><i class="fab fa-linkedin mr-2"></i>LinkedIn</option>` +
								`<option value="twitter"><i class="fab fa-twitter mr-2"></i>Twitter</option>` +
							`</select>` +
						`</div>` +
						`<div class="col-7"><input class="form-control" name="url[]" /></div>` +
					`</div>`
				);
			}
		});
	});
</script>
@endsection