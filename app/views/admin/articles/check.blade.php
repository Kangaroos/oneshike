@extends('admin.layouts.admin')

@section('head')
@parent
<link rel="stylesheet" href="{{ asset('/static/library/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}">
@stop

@section('container')
<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">美食图文审核</h3>
            <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table">
                <thead>
                <tr>
                    <th style="width: 5%">编号</th>
                    <th style="width: 25%;">标题</th>
                    <th>作者</th>
                    <th style="width: 35%;">内容</th>
                    <th>发布时间</th>
                    <th>审 核</th>
                </tr>
                <tr>
                </thead>
                <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->user->nickname }}</td>
                    <td>{{ $data->content }}</td>
                    <td>{{ $data->created_at }}</td>
                    <td>
                        <input class="simple" name="check-article" type="checkbox" data-article-id="{{ $data->id }}" data-on-text="审核中" data-off-text="待审核" data-size="mini" data-handle-width="40" data-on-color="default" data-off-color="default">
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
@stop

@section('end')
@parent
<script src="{{ asset('/static/library/bootstrap-switch/dist/js/bootstrap-switch.js') }}"></script>
<script src="{{ asset('/static/admin/views/articles/main.js') }}"></script>
@stop