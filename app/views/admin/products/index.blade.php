@extends('admin.layouts.admin')

@section('head')
@parent
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/editor.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('container')
<div class="col-xs-12">
    <table id="productTables" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>名称</th>
                <th>编号</th>
                <th>品号</th>
                <th>国产/进口</th>
                <th>原产地</th>
                <th>品牌</th>
                <th>价格</th>
                <th>详细介绍</th>
                <th>创建时间</th>
            </tr>
        </thead>
    </table>
</div>
@stop

@section('end')
@parent
<script src="{{ asset('/static/admin/js/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/datatables/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/datatables/dataTables.editor.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/datatables/editor.bootstrap.js') }}"></script>
<script src="{{ asset('/static/admin/views/products/main.js') }}"></script>
@stop