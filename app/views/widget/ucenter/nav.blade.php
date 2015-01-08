<?php
$is_active = function ($name='',$leaf = false) use ($navMenu) {
    if($leaf) {
        if(in_array($navMenu,$name)){
            return ' active';
        }
        else
            return '';
    }
    else
    {
        if($name === $navMenu)
            return ' active';
        else
            return '';

    }

}
?>

<ul class="nav nav-tabs pull-right">
    <li role="presentation" class="{{ $is_active('ucenter') }}"><a href="/ucenter">动态</a></li>
    <li role="presentation" class="{{ $is_active('article') }}"><a href="/ucenter/article">图文</a></li>
    <li role="presentation" class="{{ $is_active('cookbook') }}"><a href="/ucenter/cookbook">菜谱</a></li>
<!--    <li role="presentation" class="{{ $is_active('like') }}"><a href="/ucenter/like">喜欢</a></li>-->
<!--    <li role="presentation" class="{{ $is_active('favorite') }}"><a href="/ucenter/favorite">收藏</a></li>-->
    <li role="presentation" class="{{ $is_active('buy') }}"><a href="/ucenter/buy">商品</a></li>
    <li class="dropdown {{ $is_active(array('basic', 'changePwd', 'bind'),true) }}">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            我的信息 <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation" class="{{ $is_active('basic') }}"><a role="menuitem" tabindex="-1" href="/ucenter/basic">基本资料</a></li>
            <li role="presentation" class="{{ $is_active('changePwd') }}"><a role="menuitem" tabindex="-1" href="/ucenter/changePwd">修改密码</a></li>
            <li role="presentation" class="{{ $is_active('bind') }}"><a role="menuitem" tabindex="-1" href="#">账号绑定</a></li>
        </ul>
    </li>
    <li class="pull-left header text-green"><i class="fa fa-users"></i> 会员中心</li>
</ul>