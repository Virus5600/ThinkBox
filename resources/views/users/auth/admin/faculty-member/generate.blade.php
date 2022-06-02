@extends('template.admin')

@section('title', 'Faculty Staff')

@section('body')
<h2 class="h5 h2-lg text-center text-lg-left mx-0 mx-lg-5 my-4"><a href="javascript:void(0);" onclick="confirmLeave('{{ route('admin.faculty-member.index') }}');" class="text-decoration-none text-dark"><i class="fas fa-chevron-left mr-2"></i>Generate New Faculty Staff</a></h2>
<hr class="hr-thick" style="border-color: #707070;">

<div class="container-fluid my-5 px-0 px-lg-5">
	<div class="row">
		<div class="col-12 my-3">
			<form action="{{ route('admin.faculty-member.generate.store') }}" method="POST" enctype="multipart/form-data">
				{{csrf_field()}}

				{{-- COLLEGE, DEPARTMENT AND POSITION --}}
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

				<hr class="hr-thick-50 border-gray my-3">
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

				<hr class="hr-thick-50 border-gray my-3">
				<h3>Recipients</h3>
				<p>Providing an email will send the generated account details to the provided emails. You, the one who created this will still receive an email through your profile email. (OPTIONAL)</p>
				<div class="row">
					<div class="col-12 col-md-8" id="email_field">
						<div class="row">
							<div class="col-12 col-md-4">
								<label class="form-label" for="email">
									Email
									<span data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus click' title="Providing an email will send the generated account details to the provided emails. (OPTIONAL)"><i class="far fa-question-circle ml-2"></i></span>
								</label>
								<input class="form-control" type="email" name="email[]" value="{!! old('email.0') !!}">
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
	$(document).ready(function() {
		// Add Row button
		$("#add_email_field").on('click', function(e) {
			$("#email_field").append(
				`<div class="row mt-2">` +
					`<div class="col-12 col-md-4">` +
						`<input class="form-control" type="email" name="email[]">` +
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

		@if (old('email') != null)
		@for ($i = 1; $i < count(old('email')); $i++)
		$("#email_field").append(
			`<div class="row mt-2">` +
				`<div class="col-12 col-md-4">` +
					`<input class="form-control" type="email" name="email[]" value="{{old('email.' . $i)}}">` +
				`</div>` +
			`</div>`
		);
		@endfor
		@endif
	});
</script>
@endsection