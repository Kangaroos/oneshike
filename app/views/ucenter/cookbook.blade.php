@extends('layouts.default')

@section('head')
@parent
@section('title')菜谱信息-用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                @include('widget.ucenter.nav',array('navMenu' => 'cookbook'))
                <div class="tab-content">
                    <div class="tab-pane active">
                        @if (count($cookbooks) > 0 )

                        @else
                        <div class="self-article-box">
                            <p>你还没有创建任何菜谱，快和厨友们分享一下自己的拿手好菜吧</p>
                            <a class="btn btn-success btn-block" href="/cookbook/create"><i class="fa fa-plus-square-o"></i> 发布菜谱</a>
                        </div>
                        @endif
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
<script src="/static/js/views/ucenter/cookbook.js"></script>
@stop

