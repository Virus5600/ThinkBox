/**
 * Opens a new window for sharing the content.
 * @param url String value. This value determines where it will be shared.
 */
function genericSocialShare(url){
	window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
	return true;
}

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
	let $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(element).attr("data-copy-link")).select();
	document.execCommand("copy");
	$temp.remove();
	
	Swal.fire({
		title: `Link copied`,
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
	// For sharing link on a different window. This way, the session won't get interrupted.
	$('.share-link').on('click', function(e) {
		genericSocialShare($(e.currentTarget).attr('data-link'));
	});

	// For copying link function to work
	$('[data-copy-link]').on('click', function(e) {
		if ($(e.currentTarget).attr('onclick') == undefined) {
			$(e.currentTarget).attr('onclick', 'copyToClipboard(this);');
			$(e.currentTarget).trigger('click');
		}
	})
	
	// Activate tooltip
	$('[data-toggle=tooltip]').tooltip();

	// Activate masking
	$("[data-mask]").inputmask('mask', {'mask' : "+63 999 999 9999",'removeMaskOnSubmit' : true,'autoUnmask':true});

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