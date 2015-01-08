require(['text!/static/tpl/cookbook/cookbook-tpl.hbs', 'handlebars', 'waterfall'], function(cookbookTpl, Handlebars){

	var template = Handlebars.compile(cookbookTpl);

	$('#waterfall').waterfall({
		itemCls: 'waterfall-item',
		colWidth: 211,
		gutterWidth: 15,
		gutterHeight: 20,
//		maxPage: 5,
		checkImagesLoaded: true,
//				isFadeIn: true,
		isAnimated: true,
		template: template,
		callbacks: {
			loadingFinished: function($loading, isBeyondMaxPage) {
				if ( !isBeyondMaxPage ) {
					$loading.fadeOut();
				} else {
					$loading.hide();
					$('#page-navigation').show();
				}
			},
			renderData: function (data, dataType) {
				data.isWaterfall = true;
				if ( data.data.length < 20) {
					$('#waterfall').waterfall('pause', function() {
						$('#waterfall-message').html('<p style="color:#666;">没有更多数据</p>')
					});
				}
				if ( dataType === 'json' ||  dataType === 'jsonp'  ) {
					return template(data);
				} else {
					return data;
				}
			}
		},
		path: function(page) {
			return '/cookbook/waterfall?page=' + page;
		}
	});
});