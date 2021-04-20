$(document).ready(function() {
	$('.items-inherit-height .custom-link').addClass('py-auto');
	
	$('.share-link').click(function() {
		genericSocialShare($(this).attr('data-link'));
	});
	
	$('[data-toggle=tooltip]').tooltip();

	$('[data-toggle=sidebar-collapse]').on('click', function(e) {
		let obj = $(e.currentTarget);
		let target = $(obj.attr('data-target'));

		if (target.hasClass("show"))
			target.removeClass("show");
		else
			target.addClass("show");
	});
});