@extends('admin.layouts.admin')

@section('head')
@parent
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/editor.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('container')
<div class="col-xs-12">
    <table id="userTables" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>编号</th>
                <th>邮箱</th>
                <th>签名</th>
                <th>昵称</th>
                <th>状态</th>
                <th>等级</th>
                <th>积分</th>
                <th>联系电话</th>
                <th>QQ</th>
                <th>微信</th>
                <th>年龄</th>
                <th>收货地址</th>
                <th>最后登录时间</th>
                <th>最后登录IP</th>
                <th>登录次数</th>
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
<script src="{{ asset('/static/admin/views/users/main.js') }}"></script>
@stop