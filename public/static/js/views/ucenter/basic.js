require(['bootstrap-dialog', 'cropper', 'crop-avatar'], function(BootstrapDialog){
	$('#basic-btn').on('click', function(e){
		var $form = $('#basic-form'), $btn = $(this).button('loading');
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
