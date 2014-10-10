define(['text!./../../tpl/txfw.html'], function(Template) {
    var View = Backbone.View.extend({
        el: $('body'),
        events: {
			'tap nav img': 'navHandler'
        },

        render: function() {
            var html = Template;
            this.$el.html(html);
            return this;
        },

        initialize: function(param){
            this.render();
			$(window.router).trigger('render');
        },

		navHandler: function(e){
			alert('我是'+ e.target.src);
		}
    });

    return View;
});