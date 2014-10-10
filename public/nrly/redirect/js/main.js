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

		//列表样式 2014-09-28
		$('.gywm-list .desc').each(function(){
			if($(this).text().length>45){
				//给td设置title属性,并且设置td的完整值.给title属性.
				$(this).attr("title",$(this).text());
				//获取td的值,进行截取。赋值给text变量保存.
				var text=$(this).text().substring(0,45)+"...";
				//重新为td赋值;
				$(this).text(text);
			}
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
