require.config({
	paths: {
		"zepto": "libs/zepto",
		"jquery": "libs/jquery-latest",
		"jquery2": "libs/jquery",
		"underscore": "libs/underscore",
		"backbone": "libs/backbone",
		"unslider": "libs/unslider.min",
		"swipe": "libs/jquery.event.swipe",
		"move": "libs/jquery.event.move",
		"text": "libs/text"
	},
	shim: {
		'jquery':{
			exports: '$'
		},
		'underscore': {
			exports: '_'
		},
		'backbone': {
			deps: ['jquery','underscore'],
			exports: 'Backbone'
		}
	}
});

require(['router'], function(Router) {
	window.router = new Router();
	Backbone.history.start();

	$(window.router).on('render', function(){
		var router = this;
		console.log('======== render =======');
		$('footer li').each(function(){
			$(this).on('tap', function(){
				router.navigate(['#', this.id].join(''),{trigger:true});
			});
		});
	});
});
