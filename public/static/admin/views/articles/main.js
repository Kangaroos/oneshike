$(function() {
	$('[name="check-article"]').bootstrapSwitch({
		onSwitchChange: function(e, state) {
			var self = $(this);

			function sendCheck(data,dialogRef) {
				$.ajax({
//					url: '/admin/articles/check',
					dataType: 'JSON',
					method: 'POST',
					data: data
				}).done(function(response){
					dialogRef.close();
				});
			}

			BootstrapDialog.show({
				title: '美食图文审核',
				message: $('<textarea id="checkMemo" class="form-control" placeholder="请输入审核备注"></textarea>'),
				buttons: [{
					label: '通过审核（Enter）',
					cssClass: 'btn-success',
					hotkey: 13, // Enter.
					action: function(dialogRef) {
						self.bootstrapSwitch('toggleReadonly',true);
						self.bootstrapSwitch('onColor', 'success');
						self.bootstrapSwitch('onText', '已通过');
						sendCheck({
							"id": self.data('article-id'),
							"memo": $('#checkMemo').val(),
							"checked": true
						},dialogRef);
					}
				}, {
					label: '拒绝审核',
					cssClass: 'btn-danger',
					action: function(dialogRef) {
						self.bootstrapSwitch('toggleReadonly',true);
						self.bootstrapSwitch('onColor', 'danger');
						self.bootstrapSwitch('onText', '已拒绝');
						sendCheck({
							"id": self.data('article-id'),
							"memo": $('#checkMemo').val(),
							"checked": false
						},dialogRef);
						sendCheck()
					}
				}],
				onhide: function(dialogRef){
					self.bootstrapSwitch('state', false, true);
				}
			});
		}
	});
});

