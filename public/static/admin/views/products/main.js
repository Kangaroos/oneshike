$(function(){
	var editor = new $.fn.dataTable.Editor( {
		ajax: "/admin/products/store",
		table: "#productTables",
		idSrc: "id",
		fields: [{
            label: "名称：",
            name: "name"
        }, {
			label: "编号：",
			name: "identifier"
        },{
            label: "品类：",
            name: "category",
            type:  "select"
        }, {
            label: "国产/进口：",
            name: "import"
        }, {
            label: "原产地：",
            name: "source_area"
        }, {
            label: "品牌：",
            name: "brand"
        }, {
            label: "价格：",
            name: "price"
        }, {
            label: "详细介绍：",
            name: "desc"
        }]
	} );

	var table = $('#productTables').dataTable({
        "sScrollX": "200%",
        "bProcessing": false,
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": true,
        "bAutoWidth": false,
		"sAjaxSource": "/admin/products/tables",
		"bServerSide": true,
		"columns": [
			{ data: "name" },
            { data: "identifier" },
            { data: "products_category.label" },
            { data: "import" },
            { data: "source_area" },
            { data: "brand" },
            { data: "price" },
            { data: "desc" },
            { data: "created_at" },
		],
        initComplete: function ( settings, json ) {
            editor.field( 'category' ).update( json.products_category);
        }
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
	$( tableTools.fnContainer() ).appendTo( '#productTables_wrapper .col-xs-6:eq(0)' );
});