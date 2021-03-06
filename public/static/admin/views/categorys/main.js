$(function(){
	var editor = new $.fn.dataTable.Editor( {
		ajax: "/admin/categorys/store",
		table: "#categoryTables",
		idSrc: "id",
		fields: [{
			label: "分类编码：",
			name: "code"
		}, {
			label: "父编码：",
			name: "parent_code"
		}, {
			label: "名称：",
			name: "name"
		}, {
			label: "附加属性：",
			name: "add1"
		}, {
			label: "描述：",
			name: "desc"
		}]
	} );

	var table = $('#categoryTables').dataTable({
		"bProcessing": false,
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		"sAjaxSource": "/admin/categorys/tables",
		"bServerSide": true,
		"columns": [
			{ data: "id" },
			{ data: "code" },
			{ data: "parent_code" },
			{ data: "name" },
			{ data: "add1" },
			{ data: "desc" },
			{ data: "created_at" }
		]
	});

	// Apply the search
//	table.columns().eq( 0 ).each( function ( colIdx ) {
//		$( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
//			table
//				.column( colIdx )
//				.search( this.value )
//				.draw();
//		} );
//	} );

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
	$( tableTools.fnContainer() ).appendTo( '#categoryTables_wrapper .col-xs-6:eq(0)' );
});