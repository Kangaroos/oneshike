$(function(){
	var editor = new $.fn.dataTable.Editor( {
		ajax: "/admin/users/store",
		table: "#userTables",
		idSrc: "id",
		fields: [{
			label: "邮箱：",
			name: "email"
		}, {
			label: "签名：",
			name: "signature"
		}, {
			label: "昵称：",
			name: "nickname"
		}, {
			label: "状态：",
			name: "status",
			type:  "select"
		}, {
			label: "等级：",
			name: "level",
			type:  "select"
		}, {
			label: "积分：",
			name: "points"
		}, {
			label: "联系电话：",
			name: "phone_number"
		}, {
			label: "微信：",
			name: "wechat"
		}, {
			label: "年龄：",
			name: "age"
		}, {
			label: "收货地址：",
			name: "address"
		}]
	} );

	editor.on( 'onInitCreate', function () {
		editor.enable('email');
		editor.val('points',0);
	});

	editor.on( 'onInitEdit', function () {
		editor.disable('email');
	});

	var table = $('#userTables').dataTable({
		"sScrollX": "200%",
		"bProcessing": false,
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		"sAjaxSource": "/admin/users/tables",
		"bServerSide": true,
		"columns": [
			{ data: "id" },
			{ data: "email" },
			{ data: "signature" },
			{ data: "nickname" },
			{ data: "status_list.label" },
			{ data: "level_list.label" },
			{ data: "points" },
			{ data: "phone_number" },
			{ data: "qq" },
			{ data: "wechat" },
			{ data: "age" },
			{ data: "address" },
			{ data: "signin_at" },
			{ data: "signin_ip" },
			{ data: "signin_count" },
			{ data: "created_at" }
		],
		initComplete: function ( settings, json ) {
			editor.field( 'status' ).update( json.status_list );
			editor.field( 'level' ).update( json.level_list );
		}
	});

	var tableTools = new $.fn.dataTable.TableTools( table, {
		sRowSelect: "os",
		sSwfPath: "/static/admin/css/datatables/swf/copy_csv_xls_pdf.swf",
		aButtons: [
			{ sExtends: "editor_create", editor: editor },
			{ sExtends: "editor_edit",   editor: editor },
			{ sExtends: "editor_remove", editor: editor },
			{
				sExtends: "collection",
				sButtonText: "导出",
				aButtons: [ 'copy', 'csv', 'xls', 'pdf' ]
			}
		]
	} );
	$( tableTools.fnContainer() ).appendTo( '#userTables_wrapper .col-xs-6:eq(0)' );
});