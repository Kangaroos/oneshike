require(['jquery'], function($){
	$('.edit-btn').on('click', function(e) {
		location.href = $(this).data("url");
	});
});