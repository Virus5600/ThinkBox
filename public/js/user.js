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

/**
 * Warns the user that they're leaving without saving their changes.
 * @param urlTo String value. The page they'r attempting to open.
 * @param item String value. The item you're trying to delete.
 * @param isItem boolean value. An optional item that determines if you're deleting a container or an item. This will change the warning message.
 */
function confirmDelete(urlTo, item, isItem = false) {
	Swal.fire({
		icon: 'warning',
		html: '<h4>Proceed to delete?</h4>' + (isItem ? '<p>You want to delete the container ' + item + ', along with all the items inside it?</p>' : '<p>You wanted to delete this item: ' + item +'</p>'),
		showDenyButton: true,
		confirmButtonText: 'Yes',
		denyButtonText: 'No'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = urlTo;
		}
	});
}

function copyLinkToClipboard(element) {
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
			$(e.currentTarget).attr('onclick', 'copyLinkToClipboard(this);');
			$(e.currentTarget).trigger('click');
		}
	})
	
	// Activate tooltip
	$('[data-toggle=tooltip]').tooltip();

	// Activate masking
	$("[data-mask]").inputmask('mask', {'mask' : "+63 999 999 9999",'removeMaskOnSubmit' : true,'autoUnmask':true});

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
			else if (action == 'confirm') {
				let obj = $(e.currentTarget);

				msg = "Are you sure you want to proceed?";
				title = "Are you sure?";
				mimic = null;
				target = null;
				if (typeof obj.attr('data-message') != 'undefined' && obj.attr('data-message').length != 0)
					msg = obj.attr('data-message');
				
				if (typeof obj.attr('data-title') != 'undefined' && obj.attr('data-title').length != 0)
					title = obj.attr('data-title');

				if (typeof obj.attr('data-mimic') != 'undefined' && obj.attr('data-mimic').length != 0)
					mimic = obj.attr('data-mimic');
				
				if (typeof obj.attr('data-click-target') != 'undefined' && obj.attr('data-click-target').length != 0)
					target = obj.attr('data-click-target') + "";
				else {
					Swal.fire({
						icon: 'info',
						html: '<h4 class="text-white">Missing target!</h4><p class="text-white">Use <code class="text-white">data-click-target</code> to set target.',
						toast: true,
						timer: 7500,
						timerProgressBar: true,
						background: `#17a2b8`,
						customClass: {
							popup: `px-3`
						},
					});
					return false;
				}

				Swal.fire({
					icon: 'warning',
					html: '<h4>' + title + '</h4><p>' + msg + '</p>',
					showDenyButton: true,
					confirmButtonText: 'Yes',
					denyButtonText: 'No'
				}).then((result) => {
					if (result.isConfirmed) {
						if (action == 'confirm') {
							// Mimics the effect of the said action
							if (mimic == 'submit')
								$(e.currentTarget).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div> Submitting...`);
							else if (mimic == 'update')
								$(e.currentTarget).html(`<div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only"></span></div> Updating...`);

							console.log(target);
							console.log($(target));
							$(target).trigger('click');
						}
						else
							window.location.href = urlTo;
					}
				});
			}
		}

		$(e.currentTarget).addClass(`disabled cursor-default`);
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

		objAnim.on('shown.bs.collapse hidden.bs.collapse webkitTransitionEnd oTransitionEnd transitionend animationend bsTransitionEnd', function(e) {
			objTarget.prop('disabled', false);
		});
	});
});

var cssUtil = {
	remToPx: function(rem, includeUnit=false) {
		return (rem * 16) + (includeUnit ? 'px' : '');
	},
	pxToRem: function (px, includeUnit=false) {
		return (px / 16) + (includeUnit ? 'rem' : '');
	}
}

const _ = cssUtil;