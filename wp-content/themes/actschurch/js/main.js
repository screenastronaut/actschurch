$(document).ready(function() {
	$('.question').on('click', function() {
		var id = $(this).attr('id'); 

		if($('.a-' + id).is(':visible')) {
			$('.a-' + id).hide('slow');
			$('.t-' + id).removeClass('triangle-up');
			$('.t-' + id).addClass('triangle-down');
		} else {
			$('.a-' + id).show('slow');
			$('.t-' + id).removeClass('triangle-down');
			$('.t-' + id).addClass('triangle-up');
		}
	});

	$('.sub-menu-item').on('click', function() {
		var id = $(this).attr('id');
		$('.container-fluid > div').hide();
		$('.' + id).show();
	});
});