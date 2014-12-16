require(['text!/static/tpl/waterfall-tpl.hbs', 'handlebars', 'waterfall'], function(waterfallTpl, Handlebars){
	$('.carousel').carousel({interval: 3000});

	$('#waterfall').waterfall({
		itemCls: 'waterfall-item',
		colWidth: 211,
		gutterWidth: 15,
		gutterHeight: 20,
		maxPage: 5,
		checkImagesLoaded: true,
//				isFadeIn: true,
		isAnimated: true,
		template: Handlebars.compile(waterfallTpl),
		callbacks: {
			loadingFinished: function($loading, isBeyondMaxPage) {
				if ( !isBeyondMaxPage ) {
					$loading.fadeOut();
				} else {
					$loading.hide();
					$('#page-navigation').show();
				}
			}
		},
		path: function(page) {
			return '/static/data/data' + page + '.json';
		}
	});
})