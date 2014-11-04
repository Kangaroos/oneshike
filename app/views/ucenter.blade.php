@extends('layouts.default')

@section('head')
@parent
@section('title')用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/ucenter/main" src="/static/library/requirejs/require.js"></script>
@stop

