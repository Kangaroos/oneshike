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
@section('title') 后台管理-{{ $resourceName }} @parent @stop

@section('head')
<link href="{{ asset('/static/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="{{ asset('/static/admin/js/html5shiv.js') }}"></script>
<script src="{{ asset('/static/admin/js/respond.min.js') }}"></script>
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
                <a href="{{ url('/admin/changePassword') }}" class="btn btn-default btn-flat">修改密码</a>
            </div>
            <div class="pull-right">
                <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat">退出系统</a>
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
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>食材百科</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 食材管理</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 产地管理</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>导购商品</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 商品管理</a></li>
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
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>美食图文</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 图文审核</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-th"></i> <span>分类管理</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-th"></i> <span>会员管理</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>系统管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-angle-double-right"></i> 数据字典维护</a></li>
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
@stop


@section('end')
<!-- jQuery 2.0.2 -->
<script src="{{ asset('/static/admin/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/static/admin/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/static/admin/js/AdminLTE/app.js') }}" type="text/javascript"></script>
@parent @stop


