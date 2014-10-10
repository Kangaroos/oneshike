define(['text!./../../tpl/inner.html'], function(Template) {
    var View = Backbone.View.extend({
        el: $('body'),
        events: {
			'tap .back' : 'backHandler'
        },

        render: function() {
            var html = Template;
            this.$el.html(html);
            return this;
        },

        initialize: function(param){
            this.render();
        },

		backHandler: function(e) {
			window.history.back();
		}
    });

    return View;
});