@extends('layouts.default')

@section('head')
@parent
@section('title')美食图文{{ action('RemindersController@postRemind') }} @parent @stop
@stop

@section('container')
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
<div id="elevator_item">
    <a id="elevator" href="#" onclick="$(window).scrollTop();" title="回到顶部"></a>
</div>
@stop

@section('end')
@parent
<script src="/static/js/views/article/index.js"></script>
@stop

