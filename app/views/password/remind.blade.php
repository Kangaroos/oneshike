@extends('layouts.default')

@section('head')
@parent
@section('title')找回密码 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="sign-in-up">
        <h4>请输入您的注册邮箱</h4>
        <span class="separated"></span>
        <div class="form-box">
            <form action="{{ action('RemindersController@postRemind') }}" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-envelope"></i></span></span>
                            <input type="email" class="form-control" name="email" placeholder="请输入邮箱账号" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">找回密码</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/password/remind/main" src="/static/library/requirejs/require.js"></script>
@stop

