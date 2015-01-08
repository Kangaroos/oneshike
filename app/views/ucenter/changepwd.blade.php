@extends('layouts.default')

@section('head')
@parent
@section('title')资料修改 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div id="user-profile" class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                @include('widget.ucenter.nav',array('navMenu' => 'changePwd'))
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="change-pass-box">
                            <form id="change-pass-form" action="/ucenter/changePwd" method="post" class="form-horizontal" role="form">
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
                                        <button id="change-pass-btn" type="button" class="btn btn-success btn-block" data-loading-text="正在提交修改..." autocomplete="off">修改密码</button>
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
<script src="/static/js/views/ucenter/changePwd.js"></script>
@stop

