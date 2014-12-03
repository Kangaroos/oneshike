require.config({
	paths: {
		'jquery': '/static/library/jquery/dist/jquery.min',
		'bootstrap': '/static/library/bootstrap/dist/js/bootstrap.min',
		'bootstrap-dialog': '/static/library/bootstrap3-dialog/dist/js/bootstrap-dialog',
		'stickUp': '/static/library/stickUp/stickUp',
		'jquery.easing': '/static/library/jquery.easing/js/jquery.easing.min',
		'text': '/static/library/requirejs-text/text',
		'handlebars': '/static/library/handlebars/handlebars.min',
		'summernote': '/static/library/summernote/dist/summernote',
		'summernote-zh-CN': '/static/library/summernote/lang/summernote-zh-CN'
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
		'bootstrap': {
			deps: ['jquery']
		},
		'summernote-zh-CN': {
			deps: ['jquery']
		}
	}
});

require(['create'], function(create) {});