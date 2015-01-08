@extends('layouts.default')

@section('head')
@parent
@section('title')美食图文{{ action('RemindersController@postRemind') }} @parent @stop
@stop

@section('container')
<div class="osk-screening">
    <div class="tag">
        图文
    </div>
    <div id="waterfall" class="osk-article-waterfall"></div>
</div>

<div id="elevator_item">
    <a id="elevator" href="#" onclick="$(window).scrollTop();" title="回到顶部"></a>
</div>
@stop

@section('end')
@parent
<script src="/static/js/views/article/index.js"></script>
@stop

