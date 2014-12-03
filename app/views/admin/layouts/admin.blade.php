@extends('admin.layouts.base')
<?php
$is_active = function ($name='',$leaf = false) use ($resource) {
    if($leaf) {
        if(in_array($resource,$name)){
            return ' active';
        }
        else
            return '';
    }
    else
    {
        if($name === $resource)
            return ' active';
        else
            return '';

    }

}
?>
@section('title')后台管理-{{ $resourceName }}@stop
@section('head')
<link href="{{ asset('/static/admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/library/bootstrap3-dialog/dist/css/bootstrap-dialog.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('/static/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/js/plugins/jquery.gritter/css/jquery.gritter.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/system.css') }}" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="{{ asset('/static/admin/js/plugins/misc/html5shiv.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/misc/respond.min.js') }}"></script>
<![endif]-->
@parent @stop

@section('body')
<!-- header logo: style can be found in header.less -->
<header class="header">
<a href="{{ url('/admin') }}" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    壹食客后台管理
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<div class="navbar-right">
<ul class="nav navbar-nav">
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-user"></i>
        <span>{{ Session::get("admin")->name }}<i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-light-blue">
            <img src="{{ asset('/static/admin/img/avatar-none.png')}}" class="img-circle" alt="用户头像" />
            <p>
                {{ Session::get("admin")->name }}
                <small>欢迎您使用后台管理系统</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">

        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#changePwdModal">修改密码</a>
            </div>
            <div class="pull-right">
                <a id="logout-system" href="#" data-url="{{ url('/admin/logout') }}" class="btn btn-default btn-flat">退出系统</a>
            </div>
        </li>
    </ul>
</li>
</ul>
</div>
</nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('/static/admin/img/avatar-none.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>您好, {{ Session::get("admin")->name }}</p>

                    <a href="#"><i class="fa fa-circle text-success"></i> 已登录</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="{{ $is_active('admin') }}">
                    <a href="{{ url('/admin') }}">
                        <i class="fa fa-dashboard"></i> <span> 控制台 </span>
                    </a>
                </li>
                <li class="treeview {{ $is_active(array('foods', 'foods.category', 'foods.area'),true) }}">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>食材百科</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $is_active('foods') }}"><a href="{{ url('/admin/foods') }}"><i class="fa fa-angle-double-right"></i> 食材管理</a></li>
                        <li class="{{ $is_active('foods.area') }}"><a href="{{ url('/admin/foods/area') }}"><i class="fa fa-angle-double-right"></i> 食材产地管理</a></li>
                        <li class="{{ $is_active('foods.category') }}"><a href="{{ url('/admin/foods/category') }}"><i class="fa fa-angle-double-right"></i> 食材分类管理</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>导购商品</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a class="{{ $is_active('products') }}" href="{{ url('/admin/products') }}"><i class="fa fa-angle-double-right"></i> 商品管理</a></li>
                        <li><a class="{{ $is_active('products.category') }}" href="{{ url('/admin/products/category') }}"><i class="fa fa-angle-double-right"></i> 商品分类管理</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>菜谱</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 菜谱审核</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 菜谱分类管理</a></li>
                    </ul>
                </li>
                <li class="treeview {{ $is_active(array('articles.check'),true) }}">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>美食图文</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $is_active('articles.check') }}"><a href="{{ url('/admin/articles/check') }}"><i class="fa fa-angle-double-right"></i> 图文审核</a></li>
                    </ul>
                </li>
                <li class="treeview {{ $is_active(array('users', 'users.level'),true) }}">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>用户管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $is_active('users') }}"><a href="{{ url('/admin/users') }}"><i class="fa fa-angle-double-right"></i> 会员管理</a></li>
                        <li class="{{ $is_active('users.level') }}"><a href="{{ url('/admin/users/level') }}"><i class="fa fa-angle-double-right"></i> 会员等级管理</a></li>
                    </ul>
                </li>
                <li class="treeview {{ $is_active(array('system.admin', 'dicts'),true) }}">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>系统管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $is_active('system.admin') }}"><a href="{{ url('/admin/system/admin') }}"><i class="fa fa-angle-double-right"></i> 管理员管理</a></li>
                        <li class="{{ $is_active('dicts') }}"><a href="{{ url('/admin/dicts') }}"><i class="fa fa-angle-double-right"></i> 数据字典维护</a></li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <small>{{ $resourceDesc }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> 控制台</a></li>
                <li class="active">{{ $resourceName }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('container')
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<div class="modal fade" id="changePwdModal" tabindex="-1" role="dialog" aria-labelledby="changePwdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="changePwdModalLabel">修改密码</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('admin.putChangePassword') }}" autocomplete="off" id="changePwd-form" onsubmit="return false;">
                    <!-- CSRF Token -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="PUT" />

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">原始密码：</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="password" name="password_old" id="changePwd_password_old" class="form-control" placeholder="请输入原始密码"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">新密码：</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="input-group">
                                <input type="password" name="password" id="changePwd_password" class="form-control" placeholder="请输入新密码"/>
                                <span class="input-group-btn">
                                    <span id="pwdPopover" class="help-button"  data-toggle="tooltip" data-placement="top" data-animation="true" title="请使用字母、数字、下划线、中划线。长度在5-15位之间。">?</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">确认密码：</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="password" name="password_confirmation" id="changePwd_password_confirmation" class="form-control" placeholder="请输入确认密码"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关 闭</button>
                <button id="changePwdSubmit" type="button" class="btn btn-primary">保 存</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
@section('end')
<!-- jQuery 2.0.2 -->
<script src="{{ asset('/static/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/static/library/bootstrap3-dialog/dist/js/bootstrap-dialog.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/jquery.gritter/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('/static/admin/js/plugins/jquery.validate.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/static/admin/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/static/admin/js/AdminLTE/app.js') }}"></script>
<script src="{{ asset('/static/admin/js/AdminLTE/system.js') }}"></script>
@parent @stop


