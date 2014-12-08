define(['jquery', 'jquery.easing', 'stickUp', 'bootstrap'], function($){
	$('.navbar-osk').stickUp({
		topMargin: -79
	});

	$('.edit-btn').on('click', function(e) {
		location.href = $(this).data("url");
	});
});