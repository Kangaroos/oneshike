@extends('layouts.default')

@section('head')
@parent
@section('title')壹食客首页 @parent @stop
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/static/admin/css/datatables/css/editor.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('container')
<div class="osk-carousel">
    <div id="carousel-global-ad" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-global-ad" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-global-ad" data-slide-to="1"></li>
            <li data-target="#carousel-global-ad" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="static/img/tmp/slider1.jpg" alt="123">
            </div>
            <div class="item">
                <img src="static/img/tmp/slider2.jpg" alt="456">
            </div>
            <div class="item">
                <img src="static/img/tmp/slider3.jpg" alt="789">
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-global-ad" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-global-ad" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="osk-screening">
    <div class="panel panel-default panel-screening">
        <div class="panel-body">
            <div class="screening">
                <span class="class-tag">菜系: </span>
				<span class="class-link">
					<a href="#" class="active">全部</a>
					<a href="#">闽菜</a>
					<a href="#">粤菜</a>
					<a href="#">湘菜</a>
					<a href="#">川菜</a>
					<a href="#">鲁菜</a>
					<a href="#">豫菜</a>
					<a href="#">西北菜</a>
					<a href="#">东北菜</a>
					<a href="#">香港菜</a>
					<a href="#">台湾菜</a>
					<a href="#">韩国料理</a>
					<a href="#">日本料理</a>
				</span>
            </div>
            <div class="screening">
                <span class="class-tag">人群/场景: </span>
				<span class="class-link">
					<a href="#" class="active">全部</a>
					<a href="#">早餐食谱</a>
					<a href="#">孕妇食谱</a>
					<a href="#">产妇食谱</a>
					<a href="#">婴儿食谱</a>
					<a href="#">幼儿食谱</a>
					<a href="#">懒人食谱</a>
					<a href="#">儿童食谱</a>
				</span>
            </div>
            <div class="screening">
                <span class="class-tag">菜式: </span>
				<span class="class-link">
					<a href="#" class="active">全部</a>
					<a href="#">家常菜</a>
					<a href="#">下饭菜</a>
					<a href="#">甜品</a>
					<a href="#">肉类</a>
					<a href="#">主食</a>
					<a href="#">私家菜</a>
					<a href="#">凉菜</a>
				</span>
            </div>
            <div class="screening">
                <span class="class-tag">烹饪方法: </span>
				<span class="class-link">
					<a href="#" class="active">全部</a>
					<a href="#">煎</a>
					<a href="#">炒</a>
					<a href="#">炸</a>
					<a href="#">红烧</a>
					<a href="#">煮</a>
					<a href="#">蒸</a>
					<a href="#">烧烤</a>
					<a href="#">闷</a>
					<a href="#">炖</a>
					<a href="#">拌</a>
					<a href="#">腌</a>
					<a href="#">焗</a>
					<a href="#">卤</a>
				</span>
            </div>
        </div>
    </div>
    <div id="waterfall" class="osk-waterfall"></div>
</div>
<div id="page-navigation" class="clear">
    <span class="disabled page-navigation-prev" title="上一页">«上一页</span>
    <a href="?&p=1" data-target="page" data-page="1" class="cur">1</a>
    <a href="?&p=2" data-target="page" data-page="2">2</a>
    <a href="?&p=3" data-target="page" data-page="3">3</a>
    <a href="?&p=4" data-target="page" data-page="4">4</a>
    <a href="?&p=5" data-target="page" data-page="5">5</a>
    <a href="?&p=6" data-target="page" data-page="6">6</a>
    <a href="?&p=7" data-target="page" data-page="7">7</a>
    <a href="?&p=8" data-target="page" data-page="8">8</a>
    <a href="?&p=9" data-target="page" data-page="9">9</a>
    <a href="?&p=10" data-target="page" data-page="10">10</a>
    <a href="?&p=2" class="page-navigation-next"  data-page="2" title="下一页">下一页»</a>
</div>

<div id="elevator_item">
    <a id="elevator" href="#" onclick="$(window).scrollTop();" title="回到顶部"></a>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/index/main" src="/static/library/requirejs/require.js"></script>
@stop

