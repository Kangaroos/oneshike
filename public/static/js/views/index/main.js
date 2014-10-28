require.config({
	paths: {
		'jquery': '/static/library/jquery-1.11.1/dist/jquery.min',
		'bootstrap': '/static/library/bootstrap/dist/js/bootstrap.min',
		'stickUp': '/static/library/stickUp/stickUp',
		'text': '/static/library/requirejs-text/text',
		'waterfall': '/static/library/waterfall/src/waterfall',
		'handlebars': '/static/library/handlebars/handlebars.min',
		'jquery.easing': '/static/library/jquery.easing/js/jquery.easing.min'
	},
	shim: {
		'jquery': {
			exports: '$'
		},
		'jquery.easing': {
			deps: ['jquery']
		},
		'stickUp': {
			deps: ['jquery']
		},
		'handlebars': {
			exports: 'Handlebars'
		},
		'waterfall': {
			deps: ['jquery', 'handlebars']
		},
		'bootstrap': {
			deps: ['jquery']
		}
	}
});

require(['index'], function(index) {});