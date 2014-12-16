require.config({
	paths: {
		'jquery': '/static/library/jquery-1.11.1/dist/jquery.min',
		'bootstrap': '/static/library/bootstrap/dist/js/bootstrap.min',
		'bootstrap-dialog': '/static/library/bootstrap3-dialog/dist/js/bootstrap-dialog',
		'stickUp': '/static/library/stickUp/stickUp',
		'jquery.easing': '/static/library/jquery.easing/js/jquery.easing.min',
		'text': '/static/library/requirejs-text/text',
		'handlebars': '/static/library/handlebars/handlebars.min',
		'waterfall': '/static/library/waterfall/src/waterfall',
		'cropper': '/static/library/cropper/dist/cropper.min',
		'crop-avatar': '/static/library/cropper/examples/crop-avatar/js/crop-avatar',
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
		'bootstrap': {
			deps: ['jquery']
		},
		'handlebars': {
			exports: 'Handlebars'
		},
		'waterfall': {
			deps: ['jquery', 'handlebars']
		},
		'summernote-zh-CN': {
			deps: ['bootstrap']
		},
		'crop-avatar': {
			deps: ['bootstrap']
		}
	}
});

require(['jquery', 'jquery.easing', 'stickUp', 'bootstrap'], function($) {
	$('.navbar-osk').stickUp({
		topMargin: -79
	});
});