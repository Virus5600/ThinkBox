/**
 * Warns the user that they're leaving without saving their changes.
 * @param urlTo String value. The page they'r attempting to open.
 */
function confirmLeave(urlTo) {
	Swal.fire({
		icon: 'warning',
		html: '<h4>Are you sure?</h4><p>You have unsave changes.</p>',
		showDenyButton: true,
		confirmButtonText: 'Yes',
		denyButtonText: 'No'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = urlTo;
		}
	});
}

function copyToClipboard(element) {
	let temp = $("<input>");
	$("body").append(temp);

	let textToCopy;
	if (typeof $(element).attr('data-copy-target') != 'undefined')
		textToCopy = $($(element).attr('data-copy-target')).val();
	else if (typeof $(element).attr('data-copy-text') != 'undefined')
		textToCopy = $(element).attr('data-copy-text');
	else
		textToCopy = $(element).val();

	temp.val(textToCopy).select();
	document.execCommand("copy");
	temp.remove();
	
	Swal.fire({
		title: `Text copied`,
		position: `bottom`,
		showConfirmButton: false,
		toast: true,
		timer: 3750,
		background: `#28a745`,
		customClass: {
			title: `text-white`,
			popup: `px-0`
		},
		width: 150
	});
}

$(document).ready(function() {
	// Activate tooltip
	$('[data-toggle=tooltip]').tooltip();

	// Activate masking
	$("[data-mask]").inputmask('mask', {'mask' : "+63 999 999 9999",'removeMaskOnSubmit' : true,'autoUnmask':true});

	// Toggle the sidebar on smaller screen
	$('[data-toggle=sidebar-collapse]').on('click', function(e) {
		let obj = $(e.currentTarget);
		let target = $(obj.attr('data-target'));

		if (target.hasClass("show"))
			target.removeClass("show");
		else
			target.addClass("show");
	});

	// Change submit to either "Updating" or "Submitting" after click
	$('[type=submit], [data-action]').click(function(e) {
		let action = $(e.currentTarget).attr('data-action');

		if ($(e.currentTarget).attr('data-clicked') == 'true') {
			e.preventDefault()
		}
		else {
			if (action == 'submit')
				$(e.currentTarget).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div> Submitting...`);
			else if (action == 'update')
				$(e.currentTarget).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div> Updating...`);
		}

		$(e.currentTarget).addClass(`disabled cursor-default`);
		$(e.currentTarget).attr('data-clicked', 'true');
	});

	// Asks for confirmation before deleting an item
	$('.delete-btn').on('click', (e) => {
		e.preventDefault();
		
		let obj = $(e.target);

		let isContainer = obj.attr('data-is-container');
		let item = obj.attr('data-item');

		Swal.fire({
			icon: 'warning',
			html: '<h4>Proceed to delete?</h4>' + (isContainer ? '<p>You want to delete the container ' + item + ', along with all the items inside it?</p>' : '<p>You wanted to delete this item: ' + item +'</p>'),
			showDenyButton: true,
			confirmButtonText: 'Yes',
			denyButtonText: 'No'
		}).then((result) => {
			if (result.isConfirmed) {
				obj.closest('form').submit();
			}
			else {
				obj.removeClass('disabled');
				obj.attr('data-clicked', 'false');
			}
		});
	});

	// Marking and Unmarking stuff
	$('.mark-button').on('click', (e) => {
		let obj = $(e.target);

		Swal.fire({
			title: `${(obj.hasClass('active') ? 'Unm' : 'M')}ark "${obj.attr('data-target-item')}"${obj.hasClass('active') ? '?' : ' for reviewing?'}`,
			html: `<textarea id="reason" class="swal2-input not-resizable" style="height: 10rem;" placeholder="State your reason..."></textarea>`,
			confirmButtonText: 'Submit',
			showCancelButton: true,
			focusConfirm: false,
			allowOutsideClick: false,
			preConfirm: () => {
				const reason = Swal.getPopup().querySelector('#reason').value;

				if (obj.attr('data-triggered-from-response')) {
					Swal.showValidationMessage(obj.attr('data-validation-message'));
					obj.removeAttr('data-triggered-from-response').removeAttr('data-validation-message');
				}
				else
					if (!reason || reason.length <= 2)
						Swal.showValidationMessage(`Please provide a proper reason why this item is being marked`);

				return {
					reason: reason
				}
			}
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				$.post(obj.attr('data-target-uri'), {
					_token: $('meta[name="csrf-token"]').attr('content'),
					_method: 'POST',
					reason: result.value.reason
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
								.attr('title', result.value.reason)
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

	// Disables an input while animation is in progress
	$(document).on('change', '.disable-while-animating', function(e) {
		let obj = $(e.currentTarget);
		let objAnim = obj;
		let objTarget = obj;

		if (typeof obj.attr('data-animating-target') != 'undefined')
			objAnim = $(obj.attr('data-animating-target'));
		if (typeof obj.attr('data-disable-target') != 'undefined')
			objTarget = $(obj.attr('data-disable-target'));

		objTarget.prop('disabled', true);

		objAnim.on('shown.bs.collapse hidden.bs.collapse', function(e) {
			objTarget.prop('disabled', false);
		});
	});
});