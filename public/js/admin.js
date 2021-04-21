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
	$('[type=submit]').click(function(e) {
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
	});
});