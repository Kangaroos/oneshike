define(['text!./../../tpl/gywm.html', "unslider", "swipe", "move"], function(Template, unslider) {
    var View = Backbone.View.extend({
        el: $('body'),
        events: {
			'tap .nav img': 'navHandler',
			'tap .list img': 'listHandler'
        },

        render: function() {
            var html = Template;
            this.$el.html(html);
            return this;
        },

        initialize: function(param){
            this.render();

			$('.banner').unslider({
				arrows: true,
				fluid: true,
				dots: true
			});

			$(window.router).trigger('render');
        },

		navHandler: function(e){
//			alert('我是'+ e.target.src)
			router.navigate(['#', $(e.target).data('id')].join(''),{trigger:true});
		},

		listHandler: function(e){
//			alert('我是'+ e.target.src)
			router.navigate('#inner',{trigger:true});
		}
    });

    return View;
});