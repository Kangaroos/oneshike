@extends('layouts.default')

@section('head')
@parent
@section('title')重设密码 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="sign-in-up">
        <h4>请设置您的新登录密码</h4>
        <span class="separated"></span>
        <div class="form-box">
            <form action="{{ action('RemindersController@postReset') }}" method="post" class="form-horizontal" role="form">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-lock"></i></span></span>
                            <input type="email" class="form-control" name="email" placeholder="请输入邮箱账号" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-lock"></i></span></span>
                            <input type="password" class="form-control" name="password" placeholder="请输入新密码" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-envelope"></i></span></span>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="请输入确认密码" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">重设密码</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/password/reset/main" src="/static/library/requirejs/require.js"></script>
@stop

