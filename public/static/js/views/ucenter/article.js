require(['jquery', 'cropper', 'crop-avatar'], function($){
	$('.edit-btn').on('click', function(e) {
		location.href = $(this).data("url");
	});
});