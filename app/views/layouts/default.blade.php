@extends('layouts.base')
@section('title')@stop
@section('head')
<link href="static/library/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="static/library/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
<link rel="stylesheet" href="static/library/font-awesome/css/font-awesome.min.css">
<link href="static/css/animate.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="static/library/html5shiv/dist/html5shiv.min.js"></script>
<script src="static/library/respond/dest/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet/less" type="text/css" href="static/less/default.less" />
<script src="static/library/less/dist/less-1.7.3.min.js"></script>
@parent @stop
@section('body')
<header class="osk-header">

</header>
@yield('container')
<footer class="osk-footer">
    <div class="container">
        <div class="copyright">
            <div class="copy-main">
                <div class="item">
                    <dl>
                        <dt>简介</dt>
                        <dd><a href="#" target="blank">壹食客简介</a></dd>
                        <dd><a href="#" target="_blank">食客动态</a></dd>
                        <dd><a href="#" target="_blank">食客文化</a></dd>
                        <dd><a href="#" target="_blank">免责声明</a></dd>
                        <dd><a href="#" target="_blank">联系我们</a></dd>
                    </dl>
                </div>
                <div class="item">
                    <dl>
                        <dt>帮助</dt>
                        <dd><a href="#" target="_blank">热门问题</a></dd>
                        <dd><a href="#" target="_blank">登录注册</a></dd>
                        <dd><a href="#" target="_blank">密码问题</a></dd>
                        <dd><a href="#" target="_blank">使用建议</a></dd>
                        <dd><a href="#" target="_blank">其他问题</a></dd>
                    </dl>
                </div>
                <div class="item">
                    <dl>
                        <dt>共赢</dt>
                        <dd><a href="#" target="_blank">网站合作</a></dd>
                        <dd><a href="#" target="_blank">用户协议</a></dd>
                        <dd><a href="#" target="_blank">网站地图</a></dd>
                        <dd><a href="#" target="_blank">意见反馈</a></dd>
                        <dd><a href="#" target="_blank">招贤纳士</a></dd>
                    </dl>
                </div>
                <div class="item">
                    <dl>
                        <dt>导航</dt>
                        <dd><a href="#" target="_blank">地图首页</a></dd>
                        <dd><a href="#" target="_blank">城市分类</a></dd>
                        <dd><a href="#" target="_blank">行业分类</a></dd>
                        <dd><a href="#" target="_blank">职能分类</a></dd>
                        <dd><a href="#" target="_blank">企业名录</a></dd>
                    </dl>
                </div>
                <div class="item item-apps">
                    <i class="android"></i>
                    <p>壹食客 Android</p>
                </div>
                <div class="item item-apps">
                    <i class="ios"></i>
                    <p>壹食客 IOS</p>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-footer">
        <p>沪ICP备86868686号</p>
        <p>Copyright©2000-2014 oneshike.com All Rights Reserved</p>
    </div>
</footer>
@stop
@section('end')
<script src="static/library/jquery-1.11.1/dist/jquery.min.js"></script>
<script src="static/library/bootstrap/dist/js/bootstrap.min.js"></script>
<!--<script src="static/library/stickUp/stickUp.js"></script>-->
@parent @stop


