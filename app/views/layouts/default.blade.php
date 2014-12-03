@extends('layouts.base')
@section('title') 壹食客，做最好的美食网站 @stop
@section('head')
<link href="/static/library/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('/static/library/bootstrap3-dialog/dist/css/bootstrap-dialog.css') }}" rel="stylesheet">
<!--<link href="/static/library/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="/static/library/font-awesome/css/font-awesome.min.css">
<link href="/static/css/animate.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="/static/library/html5shiv/dist/html5shiv.min.js"></script>
<script src="/static/library/respond/dest/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet/less" type="text/css" href="/static/less/default.less" />
<script src="/static/library/less/dist/less-1.7.3.min.js"></script>
@parent @stop
@section('body')
<nav class="navbar navbar-osk navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="logo">
            <a href="/"><img src="/static/img/logo.png" alt="食客网"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/origin">原产地</a></li>
                <li><a href="/baike">百科</a></li>
                <li><a href="/cookbook">食谱</a></li>
                <li><a href="/article">美食</a></li>
                <li><a href="/product">厨具</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-lg"></i>{{ Auth::user()->nickname }}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><i class="fa fa-weibo fa-lg"></i> 绑定微博</a></li>
                        <li><a href="#"><i class="fa fa-qq fa-lg"></i> 绑定QQ</a></li>
                        <li><a href="/ucenter"><i class="fa fa-users fa-lg"></i> 会员中心</a></li>
                        <li class="divider"></li>
                        <li><a href="/auth/logout"><i class="fa fa-sign-out fa-lg"></i> 登出</a></li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-lg"></i>账户<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><i class="fa fa-weibo fa-lg"></i> 微博登录</a></li>
                        <li><a href="#"><i class="fa fa-qq fa-lg"></i> QQ登录</a></li>
                        <li class="divider"></li>
                        <li><a href="/auth/signup"><i class="fa fa-users fa-lg"></i> 注册</a></li>
                        <li><a href="/auth/signin"><i class="fa fa-sign-in fa-lg"></i> 登录</a></li>
                    </ul>
                </li>
                @endif
            </ul>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <div class="osk-search">
                        <input type="search" class="search" placeholder="食材/菜谱/厨具" autocomplete="off">
                        <button type="submit" class="fa fa-search fa-lg"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>
<div class="container osk-box">
    @yield('container')
</div>
<footer class="osk-footer">
    <div class="container-fluid">
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
@section('end')@parent @stop