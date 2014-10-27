$(function(){
	var editor = new $.fn.dataTable.Editor( {
		ajax: "/admin/foods/area/store",
		table: "#areaTables",
		idSrc: "id",
		fields: [{
			label: "产地编码：",
			name: "code",
			def: "FOOD_AREA_"
		}, {
			label: "产地名称：",
			name: "name"
		}, {
			label: "描述：",
			name: "desc"
		}]
	} );

	var editorCity = new $.fn.dataTable.Editor( {
		ajax: "/admin/foods/area/store",
		table: "#areaTables",
		idSrc: "id",
		fields: [{
			label: "父产地名称：",
			name: "parent_code"
		}, {
			label: "产地编码：",
			name: "code",
			def: "FOOD_AREA_"
		}, {
			label: "产地名称：",
			name: "name"
		}, {
			label: "描述：",
			name: "desc"
		}]
	} );

	var table = $('#areaTables').dataTable({
		"bProcessing": false,
		"bPaginate": true,
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": true,
		"bAutoWidth": false,
		"sAjaxSource": "/admin/foods/area/tables",
		"bServerSide": true,
		"columns": [
			{ data: "id" },
			{ data: "code" },
			{ data: "name" },
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
			{ sExtends: "editor_create", sButtonText: '新增省份', editor: editor },
			{
				sExtends: 'select_single',
				sButtonClass: 'marginLeft',
				sButtonText: '新增市区',
				fnClick: function (){
					editorCity
						.title( '新增市区' )
						.buttons( { label: '保存', fn: function() { this.submit(); } } )
						.edit( table.api().row('.active').node() );
				}
			},
			{ sExtends: "editor_edit",   editor: editor },
			{ sExtends: "editor_remove", editor: editor },
			{
				sExtends: "collection",
				sButtonText: "导出",
				aButtons: [ 'copy', 'csv', 'xls', 'pdf' ]
			}
		]
	} );
	$( tableTools.fnContainer() ).appendTo( '#areaTables_wrapper .col-xs-6:eq(0)' );
});