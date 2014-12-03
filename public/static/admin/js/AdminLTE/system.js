$(function(){
	jQuery.validator.addMethod("password", function (value, element) {
		return this.optional(element) || /^[\w-\s_]+$/.test(value);
	}, "请使用字母、数字、下划线、中划线。长度在5-15位之间。");


	$('#logout-system').on('click',function(){
		var link = $(this);
		BootstrapDialog.confirm('您确定要退出系统?', function(result){
			if(result) {
				location.href = link.data('url');
			} else {
				history.back();
			}
		});
	});

	$('#changePwd-form').validate({
		rules: {
			password_old: {
				required: true
			},
			password: {
				required: true,
				rangelength: [5,15],
				password: true
			},
			password_confirmation: {
				required: true,
				equalTo: '#changePwd_password',
				rangelength: [5,15],
				password: true
			}
		},

		messages: {
			password_old: {
				required: "旧密码不能为空"
			},
			password: {
				required: "密码不能为空",
				rangelength: "请使用字母、数字、下划线、中划线。长度在5-15位之间。"
			},
			password_confirmation: {
				required: "确认密码不能为空",
				equalTo: "两次输入的密码不相同",
				rangelength: "请使用字母、数字、下划线、中划线。长度在5-15位之间。"
			}
		},

		highlight: function (e) {
			$(e).closest('.form-group').addClass('has-error');
		},

		success: function (e) {
			$(e).closest('.form-group').removeClass('has-error');
			$(e).remove();
		},

		errorPlacement: function (error, element) {
			if(element.is(':checkbox') || element.is(':radio')) {
				var controls = element.closest('div[class*="col-"]');
				if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
				else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
			}
			else if(element.is('.select2')) {
				error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
			}
			else if(element.is('.chosen-select')) {
				error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
			}
			else error.insertAfter(element.parent());
		},

		submitHandler: function (form) {
			$.ajax({
				url: form.action,
				type: 'PUT',
				headers: {
					'X-CSRF-Token': $('meta[name="_token"]').attr('content')
				},
				data: $(form).serialize()
			}).done(function(data) {
				$('#changePwdModal').modal('hide');
				if(data.success) {
					$.gritter.add({
						title: '提示',
						position: 'bottom-right',
						sticky: false,
						time: 800000,
						text: data.message,
						class_name: 'gritter-success'
					});
				} else {
					$.gritter.add({
						title: '提示',
						position: 'bottom-right',
						sticky: false,
						time: 800000,
						text: data.message,
						class_name: 'gritter-error'
					});
				}
			}).fail(function( jqXHR, textStatus, errorThrown ) {
				$.gritter.add({
					title: '提示',
					position: 'bottom-right',
					sticky: false,
					time: 800000,
					text: '服务器发生错误,请联系管理员处理!',
					class_name: 'gritter-error'
				});
			});
		}
	});

	$('#changePwdSubmit').on('click', function(){
		$('#changePwd-form').submit();
	});

});