@extends('layouts.default')

@section('head')
@parent
@section('title')激活成功 @parent @stop
@stop

@section('container')
    <h2 style="text-align:center;">账号激活成功</h2>
@stop

@section('end')
@parent
<script data-main="/static/js/views/authority/activationSuccess/main" src="/static/library/requirejs/require.js"></script>
@stop
