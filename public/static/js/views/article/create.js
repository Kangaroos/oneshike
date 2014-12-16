require(['text!/static/tpl/article/article-tpl.hbs', 'handlebars', 'bootstrap-dialog', '../../.', 'summernote-zh-CN'], function(articleTpl, Handlebars, BootstrapDialog){

	var template = Handlebars.compile(articleTpl);

	$('#save-article').on('click', function(e){
		var $btn = $(this).button('loading');
		$.ajax({
			type: "POST",
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			},
			url: '/article/save/' + $('#article_id').val(),
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

	$('#cancle-article').on('click', function(e){
		BootstrapDialog.confirm('取消后您之前编辑的内容将会丢失，您确定要取消发布？', function(result){
			if(result) {
				$.ajax({
					type: 'DELETE',
					headers: {
						'X-CSRF-Token': $('meta[name="_token"]').attr('content')
					},
					url: '/article/draft/delete/' + $('#article_id').val(),
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

	$('#publish-article').on('click', function(e){
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
					url: '/article/images/desc/' + id,
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

	$(document).on('click', 'a.insert-picture-editor', function(e){
		var self = $(this),
			path = self.closest('.picture-group').data('path');
		var info = summernote.data('layoutInfo');
		var editor = summernote.data('editor'),
			editable = info.editable;
		editor.saveRange(editable);
		editor.insertImage(editable, path);
		editor.restoreRange(editable);
	});

	var summernote = $('#article-content').summernote({
		height: 300,
		focus: true,
		lang: 'zh-CN',
		toolbar: [
			['misc', ['undo', 'redo']],
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough']],
			['fontname', ['fontname']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['link', 'picture']],
			['view', ['codeview', 'fullscreen']]
		],
		onImageUpload: function(files, editor, $editable) {
			var data = new FormData();
			data.append("file", files[0]);
			$.ajax({
				data: data,
				type: 'POST',
				headers: {
					'X-CSRF-Token': $('meta[name="_token"]').attr('content')
				},
				url: '/article/images/' + $('#article_id').val(),
				cache: false,
				contentType: false,
				processData: false,
				success: function(response) {
					if(response.success) {
						var data = response.data;
						data.isPictures = true;
						data.imgindex = $('.picture-group').length+1;
						editor.insertImage($editable, data.path);
						$('.pictures').append(template(data));
					} else {
						BootstrapDialog.alert(response.message);
					}
				}
			});
		},
		onImageUploadError: function() {
			BootstrapDialog.alert("上传图片出错");
		}
	});
});