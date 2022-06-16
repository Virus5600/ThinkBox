@extends('template.admin')

@section('title', 'Skills')

@section('meta-data')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit{{$s->id}}">Edit</button>
						<button class="btn btn-sm btn-danger">Delete</button>

						<div class="modal fade" id="edit{{$s->id}}" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<form class="modal-content" action="" method="{{-- POST --}}" enctype="multipart/form-data">
									<div class="modal-header">
										<h5 class="modal-title">Edit Skill</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>

									<div class="modal-body text-left">
										<div class="form-group">
											<label class="form-label" for='skill'>Skill Name</label>
											<input class="form-control" type="text" name="skill" value="{{$s->skill}}">
										</div>

										{{ csrf_field() }}
									</div>

									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" data-action="update">Submit</button>
										<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel"/>
									</div>
								</form>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>

			<tfoot></tfoot>
		</table>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
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
							Swal.showValidationMessage(`Please provide the skill name`);
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
							if (response.is_info) {
								Swal.fire({
									title: `${response.message}`,
									position: `top`,
									showConfirmButton: false,
									toast: true,
									timer: 10000,
									background: `#17a2b8`,
									customClass: {
										title: `text-white`,
										content: `text-white`,
										popup: `px-3`
									},
								});
							}
							else {
								if (obj.hasClass('active')) {
									obj.removeClass('active');
									$(`.mark-affected[data-id=${response.id}]`).removeClass('btn-warning');
								}
								else {
									obj.addClass('active');
									$(`.mark-affected[data-id=${response.id}]`).addClass('btn-warning');
								}

								obj.attr('data-toggle', 'tooltip')
									.attr('tabindex', '0')
									.attr('data-html', 'true')
									.attr('data-trigger', 'hover focus')
									.attr('title', result.value.skill)
									.attr('data-target-uri', response.uri)
									.tooltip('dispose')
									.tooltip();

								Swal.fire({
									title: `${response.message}`,
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
							}
						}
					});
				}
			});

		});
	});
</script>
@endsection