define(['zepto', 'underscore', 'backbone'], function($, _, Backbone) {
	var AppRouter = Backbone.Router.extend({
		routes: {
			'': 'showGywm',
			'qcnr': 'showQcnr',
			'chwl': 'showChwl',
			'txfw': 'showTxfw',
			'inner': 'showInner'
		},

		showQcnr: function() {
			var self = this;
			this.clearBeforeView();
			console.log('========== 调用启程南日页面 ==========');
			require(['views/qcnr'], function(qcnrView){
				self.currView = new qcnrView();
			});
		},

		showChwl: function() {
			var self = this;
			this.clearBeforeView();
			console.log('========== 调用吃喝玩乐页面 ==========');
			require(['views/chwl'], function(chwlView){
				self.currView = new chwlView();
			});
		},

		showTxfw: function() {
			var self = this;
			this.clearBeforeView();
			console.log('========== 调用贴心服务页面 ==========');
			require(['views/txfw'], function(txfwView){
				self.currView = new txfwView();
			});
		},

		showGywm: function() {
			var self = this;
			this.clearBeforeView();
			console.log('========== 调用关于我们页面 ==========');
			require(['views/gywm'], function(txfwView){
				self.currView = new txfwView();
			});
		},

		showInner: function() {
			var self = this;
			this.clearBeforeView();
			console.log('========== 调用内容页面页面 ==========');
			require(['views/inner'], function(innerView){
				self.currView = new innerView();
			});
		},

		clearBeforeView: function() {
			if (this.currView) {
				this.currView.undelegateEvents();
				this.currView.$el.empty();
			}
		}
	});

	return AppRouter;
});

