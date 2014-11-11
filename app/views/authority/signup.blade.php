@extends('layouts.default')

@section('head')
@parent
@section('title')用户注册 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="sign-in-up">
        <h4>使用”合作网站“帐号快速注册</h4>
        <span class="separated"></span>
        <div class="quick-login">
            <button class="btn btn-info btn-lg"><i class="fa fa-qq"></i> QQ注册</button>
            <button class="btn btn-warning btn-lg"><i class="fa fa-weibo"></i> 微博注册</button>
            <button class="btn btn-success btn-lg"><i class="fa fa-wechat"></i> 微信注册</button>
        </div>
        <h4>注册”食客网“帐号</h4>
        <span class="separated"></span>
        <div class="form-box">
            @if(count($errors) > 0)
            <div class="error-box">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif
            <form action="/auth/signup" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-envelope"></i></span></span>
                            <input type="email" class="form-control" name="email" placeholder="邮箱" value="{{Input::old('email');}}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-lock"></i></span></span>
                            <input type="password" class="form-control" name="password" placeholder="密码（6-16位数字，字母或符号的组合）">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-lock"></i></span></span>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">同意协议并注册</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <span class="go-login pull-left">已有账号？<a href="/auth/signin">去登录</a></span>
                        <span class="protocol pull-right">查看<a href="#">《食客网注册协议》</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/authority/signup/main" src="/static/library/requirejs/require.js"></script>
@stop

