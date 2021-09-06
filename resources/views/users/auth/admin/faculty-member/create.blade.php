@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('admin.faculty-member.index') }}');" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Manage Faculty Members</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="{{route('admin.faculty-member.store')}}" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}

				<div class="row">
					{{-- PROFILE IMAGE --}}
					<div class="col-12 col-md-4">
						{{-- FILE IMAGE --}}
						<div class="form-group text-center collapse {{old('isAvatarLink') ? '' : 'show'}} avatar_holder" id="fileAvatar">
							<label class="form-label font-weight-bold" for="avatar">Avatar</label><br>
							<div class="hover-cam mx-auto avatar">
								<img src="/uploads/users/default.png" class="hover-zoom img-fluid avatar circle-border" width="250" height="250" id="avatarContainer" alt="Profile Image">
								<span class="icon circle-border text-center" id="avatar">
									<i class="fas fa-camera text-white hover-icon-2x"></i>
								</span>
							</div>
							<input type="file" {{old('isAvatarLink') ? '' : 'name=avatar'}} class="hidden" accept=".jpg,.jpeg,.png">
							<h6 id="profile_img">default.png</h6>
							<small class="text-muted pb-0 mb-0"><b>FORMATS ALLOWED:</b> JPEG, JPG, PNG</small><br>
							<small class="text-muted pt-0 mt-0"><b>MAX SIZE:</b> 5MB</small>
						</div>

						{{-- URL IMAGE --}}
						<div class="form-group text-center collapse {{old('isAvatarLink') ? 'show' : ''}} avatar_holder" id="linkAvatar">
							<label class="form-label font-weight-bold" for="avatarLink">Avatar</label><br>
							<img src="{{old('avatar') == null ? '/uploads/users/default.png' : (old('isAvatarLink') ? old('avatar') : '/uploads/users/default.png')}}" class="img-fluid avatar circle-border" style="cursor: default!important;" id="avatarLink" width="250" height="250" alt="Profile Image">
							<input type="text" {{old('isAvatarLink') ? 'name=avatar' : ''}} class="form-control mt-2 w-75 mx-auto" placeholder="Image URL" value="{{old('avatar')}}"/>
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
								<input class="form-control" type="text" name="first_name" value="{{old('first_name')}}"/>
								<span style="color: #FC1838">{{$errors->first('first_name')}}</span>
							</div>

							<div class="col-12 col-md-4 form-group">
								<label class="form-label font-weight-bold" for="middle_name">Middle Name</label>
								<input class="form-control" type="text" name="middle_name" value="{{old('middle_name')}}"/>
								<span style="color: #FC1838">{{$errors->first('middle_name')}}</span>
							</div>

							<div class="col-12 col-md-4 form-group">
								<label class="form-label font-weight-bold important" for="last_name">Last Name</label>
								<input class="form-control" type="text" name="last_name" value="{{old('last_name')}}"/>
								<span style="color: #FC1838">{{$errors->first('last_name')}}</span>
							</div>
						</div>

						<div class="row order-2 order-md-1">
							<div class="col-6 col-md-2 form-group">
								<label class="form-label font-weight-bold" for="title">Title</label>
								<input class="form-control" type="text" name="title" value="{{old('title')}}"/>
								<span style="color: #FC1838">{{$errors->first('title')}}</span>
							</div>

							<div class="col-6 col-md-2 form-group">
								<label class="form-label font-weight-bold" for="suffix">Suffix</label>
								<input class="form-control" type="text" name="suffix" value="{{old('suffix')}}"/>
								<span style="color: #FC1838">{{$errors->first('suffix')}}</span>
							</div>

							<div class="col-12 col-md-4">
								<label class="form-label font-weight-bold" for="contact_no">Contact No.</label>
								<input class="form-control" type="text" name="contact_no" data-mask title="+63 xxx xxx xxxx" value="{{old('contact_no')}}">
								<span style="color: #FC1838">{{$errors->first('contact_no')}}</span>
							</div>

							<div class="col-12 col-md-4">
								<label class="form-label font-weight-bold important" for="email">Email</label>
								<input class="form-control" type="email" name="email" value="{{old('email')}}">
								<span style="color: #FC1838">{{$errors->first('email')}}</span>
							</div>
						</div>

						<div class="row order-0 order-md-2">
							<div class="col-12 col-md-4 form-group my-auto">
								<div class="custom-control custom-switch custom-switch-md text-center">
									<input type='checkbox' class="custom-control-input disable-while-animating" id="isAvatarLink" data-toggle="collapse" data-target=".avatar_holder" name="isAvatarLink" {{ old('isAvatarLink') ? 'checked' : ''}} data-animating-target='#fileAvatar'/>
									<label class="custom-control-label pt-1 pl-3" for="isAvatarLink">Use an online image.</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- ABOUT --}}
				<div class="row my-3">
					<div class="col">
						<label class="form-label font-weight-bold float-left" for="about">About</label>
						<span class="float-right" style="color: #FC1838">{{$errors->first('description')}}</span>
						<textarea class="form-control not-resizable" name="description" rows="5">{{old('description')}}</textarea>
					</div>
				</div>

				{{-- AFFILIATIONS & OTHER PROFILE --}}
				<div class="row">
					{{-- AFFILIATIONS --}}
					<div class="col-12 col-lg-6 mt-5">
						<h3>Affiliations</h3>
						
						<div class="row mx-2">
							<div class="col-4 offset-1">Position</div>
							<div class="col-7">Organization</div>
						</div>

						<hr class="hr-thick-50 border-gray mt-1 mb-3">
						<div id="affiliations">
							@if (old('position') == null && old('organization') == null)
							<div class="row mx-2" id="affiliations_empty">
								<div class="col">
									Nothing to show.
								</div>
							</div>
							@else
								@php ($len = count(old('position')) > count(old('organization')) ? count(old('position')) : count(old('organization')))
								@for ($i = 1; $i <= $len; $i++)
								<div class="row m-2" id="affiliations{{$i}}">
									<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>
									<div class="col-4"><input class="form-control" name="position[]" value="{{old('position.'.($i-1))}}"/></div>
									<div class="col-6 col-md-7"><input class="form-control" name="organization[]" value="{{old('organization.'.($i-1))}}"/></div>
								</div>
								@endfor
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
							@if(old('url') != null)
							@for ($i = 1; $i <= count(old('url')); $i++)
							<div class="row m-2" id="other_profiles{{$i}}">
								<div class="col-1"><span class="cursor-pointer remove-row"><i class="fas fa-minus-circle"></i></span></div>
								<div class="col-4">
									<select class="custom-select" name="website[]">
										<option value="Facebook" {{old('website.'.($i-1)) == 'Facebook' ? 'selected' : ''}}>Facebook</option>
										<option value="Github" {{old('website.'.($i-1)) == 'Github' ? 'selected' : ''}}>Github</option>
										<option value="Google Scholar" {{old('website.'.($i-1)) == 'Google Scholar' ? 'selected' : ''}}>Google Scholar</option>
										<option value="LinkedIn" {{old('website.'.($i-1)) == 'LinkedIn' ? 'selected' : ''}}>LinkedIn</option>
										<option value="Twitter" {{old('website.'.($i-1)) == 'Twitter' ? 'selected' : ''}}>Twitter</option>
									</select>
								</div>
								<div class="col-6 col-md-7"><input class="form-control" name="url[]" value="{{old('url.'.($i-1))}}"/></div>
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

				{{-- COLLEGE, DEPARTMENT AND POSITION --}}
				<hr class="hr-thick-50 border-gray my-3">
				<h3>Position</h3>
				<div class="row">
					<div class="col-12 col-md-4 form-group">
						<label for='staff_position' class="form-label font-weight-bold">Position</label><br>
						<select class="custom-select" name="staff_position">
							@foreach ($positions as $p)
							<option value="{{$p->id}}" {{ old('staff_position') == $p->id ? 'selected' : '' }}>{{ucwords(preg_replace('/_/', ' ',$p->type))}}</option>
							@endforeach
						</select>
					</div>

					<div class="col-12 col-md-4 form-group">
						<label for='college' class="form-label font-weight-bold">College</label><br>
						<select class="custom-select" name="college">
							@foreach ($colleges as $c)
							<option value="{{$c->id}}" {{ old('college') == $c->id ? 'selected' : '' }}>{{$c->name}}{{$c->abbr == '' || $c->abbr == null ? '' : ' (' . $c->abbr . ')'}}</option>
							@endforeach
						</select>
					</div>

					<div class="col-12 col-md-4 form-group">
						<label for='department' class="form-label font-weight-bold">Department</label><br>
						<select class="custom-select" name="department" {{(old('staff_position') == $dean->id) ? 'disabled' : ((old('staff_position') == null && $positions[0]->id == $dean->id) ? 'disabled' : '')}}>
							@if (old('college') == null)
								@foreach ($departments as $d)
								<option value="{{$d->id}}" {{ old('department') == $d->id ? 'selected' : '' }}>{{$d->name}}{{$d->abbr == '' || $d->abbr == null ? '' : ' (' . $d->abbr . ')'}}</option>
								@endforeach
							@else
								@foreach (\App\Departments::where('college', '=', old('college'))->get() as $d)
								<option value="{{$d->id}}" {{ old('department') == $d->id ? 'selected' : '' }}>{{$d->name}}{{$d->abbr == '' || $d->abbr == null ? '' : ' (' . $d->abbr . ')'}}</option>
								@endforeach
							@endif
						</select>
					</div>
				</div>

				{{-- USERNAME AND PASSWORD --}}
				<hr class="hr-thick-50 border-gray my-3">
				<h3>Credentials</h3>
				<div class="row">
					<div class="col-12 col-md-6 form-group">
						<label for='username' class="form-label font-weight-bold">Generated Username</label>
						<input type="hidden" name="username" class="form-control" value="{{$username = str_random(10)}}" />
						<input type="text" class="form-control" value="{{$username}}" disabled/>
					</div>

					<div class="col-12 col-md-6 form-group">
						<label for="password" class="form-label font-weight-bold">Generated Password</label>
						<input type="hidden" name="password" class="form-control" value="{{$password = str_random(10)}}" />
						<input type="text" class="form-control" value="{{$password}}" disabled/>
					</div>
				</div>

				<textarea class="hidden" id="credentials">Username: {{$username}} - Password: {{$password}}</textarea>
				<button type="button" class="btn btn-success" onclick="copyToClipboard(this);" data-copy-target="#credentials">Copy generated credentials</button>

				{{-- EMAIL(S) OF THE RECIPIENT OF NEW ACCOUNT DETAILS --}}
				<hr class="hr-thick-50 border-gray my-3">
				<h3>Recipients</h3>
				<p>Providing an email will send the generated account details to the provided emails. You, the one who created this will still receive an email through your profile email. (OPTIONAL)</p>
				<div class="row">
					<div class="col-12 col-md-8" id="email_field">
						<div class="row">
							<div class="col-12 col-md-4">
								<label class="form-label" for="recipient">
									Email
									<span data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus click' title="Providing an email will send the generated account details to the provided emails. (OPTIONAL)"><i class="far fa-question-circle ml-2"></i></span>
								</label>
								<input class="form-control" type="email" name="recipient[]" value="{!! old('recipient.0') !!}">
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-2">
					<div class="col-12 col-md-8">
						<div class="row">
							<div class="col-12 col-md-4">
								<button id="add_email_field" type="button" class="btn btn-custom-inverted w-100" style="border-style: dashed; border-width: .125rem;" data-toggle="tooltip" data-trigger="hover focus" data-placement="bottom" title="Add another email field"><i class="fas fa-plus fa-lg"></i></button>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-5">
					<div class="col">
						<button type="submit" class="btn btn-custom" data-action="submit">Submit</button>
						<button type="button" class="btn btn-custom-inverted" onclick="confirmLeave('{{ route('admin.faculty-member.index') }}')">Cancel</button>
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
			$("#avatarContainer").attr("src", "/uploads/users/default.png");
			$("#profile_img").html("default.png");
		}
	}

	$(document).ready(function() {
		// Profile Image Changing
		$("#avatar").on("click", function() {
			openInput($(this));
		});

		$("#fileAvatar input").on("change", function() {swapImgFile(this)});
		$("#linkAvatar input").on("change keyup", function(e) {
			let obj = $(e.currentTarget);

			if (obj.val().length == 0)
				$("#avatarLink").attr("src", "/uploads/users/default.png");
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

		// Add Row button
		$("#add_email_field").on('click', function(e) {
			$("#email_field").append(
				`<div class="row mt-2">` +
					`<div class="col-12 col-md-4">` +
						`<input class="form-control" type="email" name="recipient[]">` +
					`</div>` +
				`</div>`
			);
		});

		// Change Department Based on Position and College
		$('[name=staff_position], [name=college]').on('change', (e) => {
			let obj = $(e.currentTarget);

			if (obj.attr('name') == 'staff_position') {
				if (obj.val() == '{{$dean->id}}')
					$('[name=department]').prop('disabled', true);
				else
					$('[name=department]').prop('disabled', false);
			}
			else if (obj.attr('name') == 'college') {
				$.post('{{ route('get-college-departments') }}', {
					_token: '{{csrf_token()}}',
					collegeID: obj.val()
				}).done((data) => {
					$('[name=department]').html('');

					$.each(data, (k, v) => {
						$('[name=department]').append('<option value="' + v['id'] + '">' + v['name'] + ((v['abbr'] == '' || v['abbr'] == null) ? '' : (' (' + v['abbr'] + ')')) + '</option>')
					});
				});
			}
		});

		@if (old('recipient') != null)
		@for ($i = 1; $i < count(old('recipient')); $i++)
		$("#email_field").append(
			`<div class="row mt-2">` +
				`<div class="col-12 col-md-4">` +
					`<input class="form-control" type="email" name="recipient[]" value="{{old('recipient.' . $i)}}">` +
				`</div>` +
			`</div>`
		);
		@endfor
		@endif
	});
</script>
@endsection