@extends('layouts.default')

@section('head')
@parent
@section('title')基本资料-用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                @include('widget.ucenter.nav',array('navMenu' => 'basic'))
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="base-info-box">
                            <form id="basic-form" action="/ucenter/basic" method="post" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">邮箱：</label>
                                    <div class="col-sm-8">
                                        <p class="form-control-static">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">昵称：</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nickname" placeholder="请输入昵称" value="{{ Input::old('nickname', $user->nickname) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">联系电话：</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone_number" placeholder="请输入联系电话" value="{{ Input::old('phone_number', $user->phone_number) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">QQ：</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="qq" placeholder="请输入QQ号码" value="{{ Input::old('qq', $user->qq) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">微信：</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="wechat" placeholder="请输入微信号码" value="{{ Input::old('wechat', $user->wechat) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">收货地址：</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="address" placeholder="请输入收货地址" value="{{ Input::old('address', $user->address) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">用户签名：</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" name="signature" placeholder="请输入您的签名信息">{{ Input::old('signature', $user->signature) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <button id="basic-btn" type="button" class="btn btn-success btn-block" data-loading-text="正在提交修改..." autocomplete="off">更 新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('widget.ucenter.side')
    </div>
</div>
@stop

@section('end')
@parent
<script src="/static/js/views/ucenter/basic.js"></script>
@stop

