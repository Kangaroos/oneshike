@extends('layouts.default')

@section('head')
@parent
@section('title')找回密码 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <form action="{{ action('RemindersController@postRemind') }}" method="POST">
        <input type="email" name="email">
        <input type="submit" value="Send Reminder">
    </form>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/password/remind/main" src="/static/library/requirejs/require.js"></script>
@stop

