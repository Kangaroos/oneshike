@extends('layouts.default')

@section('head')
@parent
@section('title')用户登录 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="sign-in-up">
        <h4>使用”合作网站“帐号快速登录</h4>
        <span class="separated"></span>
        <div class="quick-login">
            <button class="btn btn-info btn-lg"><i class="fa fa-qq"></i> QQ登录</button>
            <button class="btn btn-warning btn-lg"><i class="fa fa-weibo"></i> 微博登录</button>
            <button class="btn btn-success btn-lg"><i class="fa fa-wechat"></i> 微信登录</button>
        </div>
        <h4>使用”食客网“帐号登录</h4>
        <span class="separated"></span>
        <div class="form-box">
            <form action="/auth/signin" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-envelope"></i></span></span>
                            <input type="text" class="form-control" name="email" placeholder="请输入邮箱账号" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-lock"></i></span></span>
                            <input type="password" class="form-control" name="password" placeholder="请输入密码" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">登 录</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <span class="go-register pull-left">还没账号？<a href="/auth/signup">去注册</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/authority/signin/main" src="/static/library/requirejs/require.js"></script>
@stop

