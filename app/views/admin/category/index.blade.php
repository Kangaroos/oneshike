@extends('admin.layouts.admin')

@section('head')
@parent
<link href="{{ asset('/static/admin/css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('container')
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">分类管理</h3>
        </div>
        <div class="box-body table-responsive">
            {{$table ->render()}}
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script src="{{ asset('/static/admin/js/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/datatables/dataTables.bootstrap.js') }}"></script>
{{$table ->script()}}
@stop