require.config({
	paths: {
		'jquery': '/static/library/jquery-1.11.1/dist/jquery.min',
		'bootstrap': '/static/library/bootstrap/dist/js/bootstrap.min',
		'stickUp': '/static/library/stickUp/stickUp',
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
		'bootstrap': {
			deps: ['jquery']
		}
	}
});

require(['reset'], function(reset) {});