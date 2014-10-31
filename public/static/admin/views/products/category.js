$(function(){
    var editor = new $.fn.dataTable.Editor( {
        ajax: "/admin/products/category/store",
        table: "#categoryTables",
        idSrc: "id",
        fields: [{
            label: "品类字段码：",
            name: "code",
            def: "PRODUCT_CATEGORY_"
        }, {
            label: "品类名称：",
            name: "name"
        }, {
            label: "描述：",
            name: "desc"
        }]
    } );

    var editorCity = new $.fn.dataTable.Editor( {
        ajax: "/admin/products/category/store",
        table: "#categoryTables",
        idSrc: "id",
        fields: [{
            label: "父类名称：",
            name: "parent_code"
        }, {
            label: "品类编码：",
            name: "code",
            def: "FOOD_AREA_"
        }, {
            label: "品类名称：",
            name: "name"
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
        "sAjaxSource": "/admin/products/category/tables",
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
            { sExtends: "editor_create", sButtonText: '新增种类', editor: editor },
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