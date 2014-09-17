define(['router'], function(Router) {
	var initialize = function() {
		window.router = new Router();
		Backbone.history.start();
	};
	return {
		initialize: initialize
	};
});