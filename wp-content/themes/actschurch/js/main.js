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

	$('.tab-link').on('click', function() {
		var id = $(this).data('tab');

		var tablink = $('.tab-link');
		tablink.each(function() {
			tablink.removeClass('current-link');
		});

		$(this).addClass('current-link');

		var tabcontent = $('.tab-content');
		tabcontent.each(function() {
			tabcontent.removeClass('current-tab');
		});

		$('#' + id).addClass('current-tab');
	});

	$('#homes-city').change(function() {
		var rex = new RegExp($('#homes-city').val());
		if(rex =="/All/") {
			$('tr').show();
		} else{
			$('tr:not(.table-header)').hide();
			$('tr:not(.table-header)').filter(function() {
				return rex.test($(this).text());
			}).show();
		}
	});
});