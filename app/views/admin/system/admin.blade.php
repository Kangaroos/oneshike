@extends('admin.layouts.admin')

@section('head')
@parent
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/editor.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('container')
<div class="col-xs-12">
    <table id="adminTables" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>编号</th>
            <th>帐号</th>
            <th>姓名</th>
            <th>注册时间</th>
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
<script src="{{ asset('/static/admin/views/system/admin.js') }}"></script>
@stop