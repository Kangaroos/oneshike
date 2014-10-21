$(function(){
	var editor = new $.fn.dataTable.Editor( {
		ajax: "/admin/store",
		table: "#adminTables",
		idSrc: "id",
		fields: [{
			label: "帐号：",
			name: "account"
		}, {
			label: "姓名：",
			name: "name"
		}]
	} );


	editor.on( 'onInitCreate', function () {
		editor.enable('account');
	});

	editor.on( 'onInitEdit', function () {
		editor.disable('account');
	});

	var table = $('#adminTables').dataTable({
		"bProcessing": false,
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		"sAjaxSource": "/admin/tables",
		"bServerSide": true,
		"columns": [
			{ data: "id" },
			{ data: "account" },
			{ data: "name" },
			{ data: "created_at" }
		]
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
	$( tableTools.fnContainer() ).appendTo( '#adminTables_wrapper .col-xs-6:eq(0)' );
});