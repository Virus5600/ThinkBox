@extends('template.admin')

@section('meta-data')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'Skills')

@section('body')
<div class="container-fluid px-2 px-lg-6 py-2">
	<div class="row">
		<div class="col-12 col-lg text-center text-lg-left">
			<h2 class="font-weight-bold">Skills</h2>
		</div>

		@if (Auth::user()->hasPrivilege('skills_create'))
		<div class="col-12 col-md-6 col-lg my-2 text-center text-md-left text-lg-right">
			<button class="btn btn-success" id="addSkill"><i class="fas fa-plus-circle mr-2"></i>Add Skill</button>
		</div>
		@endif

		<div class="col-12 col-md-6 col-lg my-2 text-center text-lg-right">
			<div class="input-group">
				<input type="text" class="form-control" name='search' placeholder="Search..." />
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</div>
	</div>

	<div class="overflow-x-auto">
		<table class="table">
			<thead>
				<tr>
					@if (Auth::user()->hasPrivilege('skills_mark'))
					<th scope="col" class="hr-thick"></th>
					@endif
					<th scope="col" class="hr-thick">Name</th>
					<th scope="col" class="hr-thick"></th>
				</tr>
			</thead>

			<tbody>
				@foreach ($skills as $s)
				<tr>
					@if (Auth::user()->hasPrivilege('skills_mark'))
					<td>
						@if (strlen($s->reason) > 0)
						<div class="mark-button {{ $s->is_marked ? 'active' : ''}}" data-target-uri="{{ route('admin.skills.' . ($s->is_marked ? 'unmark' : 'mark'), [$s->id]) }}" data-target-item="{{ $s->skill }}" data-toggle="tooltip" tabindex='0' data-html='true' data-trigger='hover focus' title="{{ $s->reason }}">
						@else
						<div class="mark-button {{ $s->is_marked ? 'active' : ''}}" data-target-uri="{{ route('admin.skills.' . ($s->is_marked ? 'unmark' : 'mark'), [$s->id]) }}" data-target-item="{{ $s->skill }}">
						@endif
							<i class="fa-solid fa-exclamation"></i>
						</div>
					</td>
					@endif

					<td>{{$s->skill}}</td>
					<td class="text-right">
						@if (Auth::user()->hasPrivilege('skills_view'))
						<a href="{{ route('admin.skills.show', [$s->id]) }}" class="btn btn-sm btn-primary {{ $s->is_marked ? 'btn-warning' : '' }} mark-affected" data-id="{{ $s->id }}">View</a>
						@endif

						@if (Auth::user()->hasPrivilege('skills_edit'))
						<button class="btn btn-sm btn-primary edit {{ $s->is_marked ? 'btn-warning' : '' }} mark-affected" data-skill="{{ $s->skill }}" data-uri-target="{{ route('admin.skills.update', [$s->id]) }}" data-id="{{ $s->id }}">Edit</button>
						@endif

						@if (Auth::user()->hasPrivilege('skills_delete'))
						@include('include.delete_btn', ['item' => $s->skill, 'route' => route('admin.skills.delete', [$s->id]), 'formClass' => 'd-inline-block', 'class' => 'btn btn-sm btn-danger delete-btn'])
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>

			<tfoot></tfoot>
		</table>
		
		<div class="d-flex flex-row">
			<nav class="mx-auto">{{ $skills->links() }}</nav>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		@if (Auth::user()->hasPrivilege('skills_create'))
		// ADDING
		$('#addSkill').on('click', (e) => {
			let obj = $(e.target);

			Swal.fire({
				title: `Add Skill`,
				html: `<input class="swal2-input" type="text" name="skill" placeholder="Skill Name...">`,
				confirmButtonText: 'Submit',
				showCancelButton: true,
				focusConfirm: false,
				allowOutsideClick: false,
				preConfirm: () => {
					const skill = Swal.getPopup().querySelector('[name=skill]').value;

					if (obj.attr('data-triggered-from-response')) {
						Swal.showValidationMessage(obj.attr('data-validation-message'));
						obj.removeAttr('data-triggered-from-response').removeAttr('data-validation-message');
					}
					else
						if (!skill)
							Swal.showValidationMessage(`Please provide a skill name`);
						else if (skill.length <= 2)
							Swal.showValidationMessage(`Skill name provided is too short`);

					return {
						skill: skill
					}
				}
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.post("{{ route('admin.skills.store') }}", {
						_token: $('meta[name="csrf-token"]').attr('content'),
						_method: 'POST',
						skill: result.value.skill
					}).done((response) => {
						if (response.has_error) {
							Swal.fire({
								title: `${response.message}`,
								position: `top`,
								showConfirmButton: false,
								toast: true,
								timer: 10000,
								background: `#dc3545`,
								customClass: {
									title: `text-white`,
									content: `text-white`,
									popup: `px-3`
								},
							});
						}
						else if (response.has_validation_error) {
							obj.attr('data-validation-message', response.message);
							obj.attr('data-triggered-from-response', 'true');
							obj.trigger('click');
							$('.swal2-confirm').trigger('click');
						}
						else {
							localStorage.setItem('m', `${response.message}`);
							window.location.reload();
						}
					});
				}
			});
		});

		if (localStorage.getItem('m') != null) {
			Swal.fire({
				title: `${localStorage.getItem('m')}`,
				position: `top`,
				showConfirmButton: false,
				toast: true,
				timer: 10000,
				background: `#28a745`,
				customClass: {
					title: `text-white`,
					content: `text-white`,
					popup: `px-3`
				},
			});

			localStorage.removeItem('m');
		}
		@endif

		@if (Auth::user()->hasPrivilege('skills_edit'))
		$('.edit').on('click', (e) => {
			let obj = $(e.target);

			Swal.fire({
				title: `Edit Skill "${obj.attr('data-skill')}"`,
				html: `<input class="swal2-input" type="text" name="skill" placeholder="Skill Name...">`,
				confirmButtonText: 'Submit',
				showCancelButton: true,
				focusConfirm: false,
				allowOutsideClick: false,
				preConfirm: () => {
					const skill = Swal.getPopup().querySelector('[name=skill]').value;

					if (obj.attr('data-triggered-from-response')) {
						Swal.showValidationMessage(obj.attr('data-validation-message'));
						obj.removeAttr('data-triggered-from-response').removeAttr('data-validation-message');
					}
					else
						if (!skill)
							Swal.showValidationMessage(`Please provide a skill name`);
						else if (skill.length <= 2)
							Swal.showValidationMessage(`Skill name provided is too short`);

					return {
						skill: skill
					}
				}
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.post(`${obj.attr('data-uri-target')}`, {
						_token: $('meta[name="csrf-token"]').attr('content'),
						_method: 'POST',
						skill: result.value.skill
					}).done((response) => {
						if (response.has_error) {
							Swal.fire({
								title: `${response.message}`,
								position: `top`,
								showConfirmButton: false,
								toast: true,
								timer: 10000,
								background: `#dc3545`,
								customClass: {
									title: `text-white`,
									content: `text-white`,
									popup: `px-3`
								},
							});
						}
						else if (response.has_validation_error) {
							obj.attr('data-validation-message', response.message);
							obj.attr('data-triggered-from-response', 'true');
							obj.trigger('click');
							$('.swal2-confirm').trigger('click');
						}
						else {
							localStorage.setItem('m', `${response.message}`);
							window.location.reload();
						}
					});
				}
			});
		});
		@endif
	});
</script>
@endsection