$(function(){
	var editor = new $.fn.dataTable.Editor( {
		ajax: "/admin/dicts/store",
		table: "#dictTables",
		idSrc: "id",
		fields: [{
			label: "字典组编码：",
			name: "code"
		}, {
			label: "字典组名称：",
			name: "name"
		}, {
			label: "字典编码：",
			name: "para_code"
		}, {
			label: "字典名称：",
			name: "para_name"
		}, {
			label: "字典附加属性1：",
			name: "para_add1"
		}, {
			label: "描述：",
			name: "desc"
		}]
	} );

	editor.on( 'onInitCreate', function () {
		editor.enable('code');
	});

	editor.on( 'onInitEdit', function () {
		editor.disable('code');
	});

	var table = $('#dictTables').dataTable({
		"bProcessing": false,
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		"sAjaxSource": "/admin/dicts/tables",
		"bServerSide": true,
		"columns": [
			{ data: "id" },
			{ data: "code" },
			{ data: "name" },
			{ data: "para_code" },
			{ data: "para_name" },
			{ data: "para_add1" },
			{ data: "desc" },
			{ data: "created_at" }
		],
		"fnDrawCallback": function ( oSettings ) {
			if ( oSettings.bSorted || oSettings.bFiltered ) {
				for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
					$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
				}
			}
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
	$( tableTools.fnContainer() ).appendTo( '#dictTables_wrapper .col-xs-6:eq(0)' );
});