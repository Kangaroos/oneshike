@extends('layouts.default')

@section('head')
@parent
@section('title')注册成功 @parent @stop
@stop

@section('container')
    <h2 class="center">请激活您的账号</h2>
    <p class="center">激活邮件已发送，请登录您的邮箱（{{ $email }}）激活账号。</p>
@stop

@section('end')
@parent
<script data-main="/static/js/views/authority/signupSuccess/main" src="/static/library/requirejs/require.js"></script>
@stop