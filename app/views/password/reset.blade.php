@extends('layouts.default')

@section('head')
@parent
@section('title')重设密码 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <form action="{{ action('RemindersController@postReset') }}" method="POST">
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <input type="submit" value="Reset Password">
    </form>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/password/reset/main" src="/static/library/requirejs/require.js"></script>
@stop

