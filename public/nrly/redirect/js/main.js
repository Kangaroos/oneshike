require.config({
	paths: {
		"jquery": "libs/jquery",
		"unslider": "libs/unslider.min",
		"swipe": "libs/jquery.event.swipe",
		"move": "libs/jquery.event.move",
		"text": "libs/text"
	}
});

require(['jquery'], function($) {
	$(document).ready(function(){
		$('footer li').each(function(){
			$(this).on('click', function(){
				location.href = $(this).data("url");
			});
		});

		$('.nav img').each(function(){
			$(this).on('click', function(){
				console.log("test");
				location.href = $(this).data("url");
			});
		});

		$('nav img').each(function(){
			$(this).on('click', function(){
				alert($(this).attr("src"));
			});
		});

		$('.list img').each(function(){
			$(this).on('click', function(){
				location.href = $(this).data("url");
			});
		});
		$('.back').on('click', function(){
			window.history.back();
		});
		require(['unslider','swipe','move'], function(){
			$('.banner').unslider({
				arrows: true,
				fluid: true,
				dots: true
			});
		});
	});
});
