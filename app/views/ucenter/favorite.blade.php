@extends('layouts.default')

@section('head')
@parent
@section('title')用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="ucenter row">
        <div class="col-sm-3">
            <div class="portrait-box">
                <img src="/static/img/blank-head.jpg" alt="更改头像">
                <div class="row">
                    <button class="btn btn-success">更改头像</button>
                    <h5>做个有头有脸的吃货吧</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a href="#base-info" role="tab" data-toggle="tab">基本资料</a></li>
                <li role="presentation"><a href="#change-password" role="tab" data-toggle="tab">密码修改</a></li>
                <li role="presentation"><a href="#self-favorite" role="tab" data-toggle="tab">收藏</a></li>
                <li role="presentation"><a href="#buy-record" role="tab" data-toggle="tab">购买记录</a></li>
                <li role="presentation"><a href="#self-like" role="tab" data-toggle="tab">喜欢</a></li>
                <li role="presentation"><a href="#self-article" role="tab" data-toggle="tab">图文</a></li>
                <li role="presentation"><a href="#self-cookbook" role="tab" data-toggle="tab">菜谱</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="base-info">
                    <div class="base-info-box">
                        <form action="/auth/signup" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">邮箱：</label>
                                <div class="col-sm-8">
                                    <p class="form-control-static">email@example.com</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">昵称：</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nickname" placeholder="请输入昵称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">联系电话：</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone_number" placeholder="请输入联系电话">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">QQ：</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="qq" placeholder="请输入QQ号码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">微信：</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="wechat" placeholder="请输入微信号码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">收货地址：</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="address" placeholder="请输入收货地址">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">用户签名：</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="3" placeholder="请输入您的签名信息"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success btn-block">更 新</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="change-password">
                    <div class="change-pass-box">
                        <form action="/auth/signup" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">旧密码：</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="old_password" placeholder="请输入旧密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">新密码：</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" placeholder="密码（6-16位数字，字母或符号的组合）">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">确认密码：</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success btn-block">修改密码</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="self-favorite">功能开发中...</div>
                <div role="tabpanel" class="tab-pane fade" id="buy-record">功能开发中...</div>
                <div role="tabpanel" class="tab-pane fade" id="self-like">功能开发中...</div>
                <div role="tabpanel" class="tab-pane fade" id="self-article">
                    <div class="self-article-box">
                        <p>你还没有发布任何图文信息，快来创建第一条吧</p>
                        <a class="btn btn-success btn-block" href="/article/create"><i class="fa fa-plus-square-o"></i> 发布图文</a>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="self-cookbook">
                    <div class="self-cookbook-box">
                        <p>你还没有创建任何菜谱，快和厨友们分享一下自己的拿手好菜吧</p>
                        <a class="btn btn-success btn-block" href="#"><i class="fa fa-plus-square-o"></i> 创建菜谱</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/ucenter/main" src="/static/library/requirejs/require.js"></script>
@stop

