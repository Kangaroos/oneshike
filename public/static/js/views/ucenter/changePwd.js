require(['bootstrap-dialog', 'cropper', 'crop-avatar'], function(BootstrapDialog){
	$('#change-pass-btn').on('click', function(e){
		var $form = $('#change-pass-form'), $btn = $(this).button('loading');
		$.ajax({
			type: 'POST',
			headers: {
				'X-CSRF-Token': $('meta[name="_token"]').attr('content')
			},
			url: $form.attr('action'),
			data: $form.serialize(),
			dataType: "json"
		}).done(function(response){
			if(response.success) {
			} else {
				BootstrapDialog.alert(response.message);
			}
			$btn.button('reset');
		});
	});
});
