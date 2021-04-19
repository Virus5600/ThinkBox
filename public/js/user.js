function genericSocialShare(url){
	window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
	return true;
}

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
	$('.items-inherit-height .custom-link').addClass('py-auto');
	
	$('.share-link').click(function() {
		genericSocialShare($(this).attr('data-link'));
	});
	
	$('[data-toggle=tooltip]').tooltip();
});