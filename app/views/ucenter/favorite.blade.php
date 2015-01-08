@extends('layouts.default')

@section('head')
@parent
@section('title')用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                @include('widget.ucenter.nav',array('navMenu' => 'favorite'))
                <div class="tab-content">
                    <div class="tab-pane active">

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
<script data-main="/static/js/views/ucenter/main" src="/static/library/requirejs/require.js"></script>
@stop

