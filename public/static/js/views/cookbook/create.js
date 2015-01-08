require(['text!/static/tpl/cookbook/cookbook-tpl.hbs', 'handlebars', 'bootstrap-dialog'], function(cookbookTpl, Handlebars, BootstrapDialog){

	var template = Handlebars.compile(cookbookTpl);

	$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			files = input.get(0).files,
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

		var data = new FormData();
		data.append("file", files[0]);
		$.ajax({
			data: data,
			type: 'POST',
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			},
			url: '/cookbook/images/' + $('#cookbook_id').val(),
			cache: false,
			contentType: false,
			processData: false,
			success: function(response) {
				if(response.success) {

				} else {
					BootstrapDialog.alert(response.message);
				}
			}
		});

	});

	$('#save-cookbook').on('click', function(e){
		var $btn = $(this).button('loading');
		$.ajax({
			type: "POST",
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			},
			url: '/cookbook/save/' + $('#article_id').val(),
			data: {
				"title": $('#article-title').val(),
				"content": $('#article-content').code()
			},
			dataType: "json"
		}).done(function(response){
			if(response.success) {
			} else {
				BootstrapDialog.alert(response.message);
			}
			$btn.button('reset');
		});
	});

	$('#cancle-cookbook').on('click', function(e){
		BootstrapDialog.confirm('取消后您之前编辑的内容将会丢失，您确定要取消发布？', function(result){
			if(result) {
				$.ajax({
					type: 'DELETE',
					headers: {
						'X-CSRF-Token': $('meta[name="_token"]').attr('content')
					},
					url: '/cookbook/draft/delete/' + $('#article_id').val(),
					dataType: "json"
				}).done(function(response){
					if(response.success) {
						history.back();
					} else {
						BootstrapDialog.alert(response.message);
					}
				});
			}
		});
	});

	$('#publish-cookbook').on('click', function(e){
		var $btn = $(this).button('loading');
		$.ajax({
			type: "POST",
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			},
			url: '/article/publish/' +  + $('#article_id').val(),
			data: {
				"title": $('#article-title').val(),
				"content": $('#article-content').code()
			},
			dataType: "json"
		}).done(function(response){
			if(response.success) {
				BootstrapDialog.confirm('图文信息已经发布成功，您是否要继续发布?', function(result){
					if(result) {
						location.reload();
					} else {
						history.back();
					}
				});
			} else {
				BootstrapDialog.alert(response.message);
			}
			$btn.button('reset');
		});
	});

	$(document).on('click', 'a.delete-image', function(e){
		var self = $(this),
			path = self.closest('.picture-group').data('path'),
			id = self.closest('.picture-group').data('id');

		BootstrapDialog.confirm('确定要删除这张图片?', function(result){
			if(result) {
				$.ajax({
					type: 'DELETE',
					headers: {
						'X-CSRF-Token': $('meta[name="_token"]').attr('content')
					},
					url: '/article/images/delete/' + id,
					dataType: "json"
				}).done(function(response){
					if(response.success) {
						self.closest('.picture-group').remove();
						$('img[src="'+path+'"]').remove();
					} else {
						BootstrapDialog.alert(response.message);
					}
				});
			}
		});
	});

	$(document).on('blur', 'textarea.textarea-image-desc', function(e){
		var self = $(this),
			id = self.closest('.picture-group').data('id');
		if(self.val() !== '') {
			if(self.data('old-value') !== self.val()) {
				self.data('old-value', self.val());

				$.ajax({
					type: "POST",
					headers: {
						'X-CSRF-Token': $('meta[name="_token"]').attr('content')
					},
					url: '/cookbook/images/desc/' + id,
					data: {
						"desc": self.val()
					},
					dataType: "json"
				}).done(function(response){
					if(response.success) {
					} else {
						BootstrapDialog.alert(response.message);
					}
				});
			}

		}
	});
});