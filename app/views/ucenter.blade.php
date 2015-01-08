@extends('layouts.default')

@section('head')
@parent
@section('title') 用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                @include('widget.ucenter.nav',array('navMenu' => 'ucenter'))
                <div class="tab-content">
                    <div class="tab-pane active">
                        <ul class="timeline">
                            <li class="timeline-inverted">
                                <div class="timeline-badge success"><i class="glyphicon glyphicon-book"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">演示数据</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>我是测试数据</p>
                                        <p>我是测试数据</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge success"><i class="glyphicon glyphicon-book"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">演示数据</h4>
                                    </div>
                                    <div class="timeline-body">
                                        <p>我是测试数据</p>
                                        <p>我是测试数据</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
<script src="/static/js/views/ucenter/ucenter.js"></script>
@stop

