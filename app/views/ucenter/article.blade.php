@extends('layouts.default')

@section('head')
@parent
@section('title')用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div id="user-profile-1" class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li role="presentation"><a href="/ucenter">动态</a></li>
                    <li role="presentation" class="active bs"><a href="/ucenter/article">图文</a></li>
                    <li role="presentation"><a href="/ucenter/cookbook">菜谱</a></li>
                    <li role="presentation"><a href="/ucenter/like">喜欢</a></li>
                    <li role="presentation"><a href="/ucenter/favorite">收藏</a></li>
                    <li role="presentation"><a href="/ucenter/buy">购买记录</a></li>
                    <li class="pull-left header text-green"><i class="fa fa-users"></i> 会员中心</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        @if (count($articles) > 0 )
                        <ul class="timeline">
                            @foreach ($articles as $article)
                            <li class="timeline-inverted">
                                <div class="timeline-badge success"><i class="glyphicon glyphicon-book"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ $article->title }}</h4>
                                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $article->created_at }}</small></p>
                                    </div>
                                    <div class="timeline-body">
                                        {{ $article->content }}
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="self-article-box">
                            <p>你还没有发布任何图文信息，快来创建第一条吧</p>
                            <a class="btn btn-success btn-block" href="/article/create"><i class="fa fa-plus-square-o"></i> 发布图文</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 center">
            <div>
                <span class="profile-picture">
                    <img id="avatar" alt="{{ Auth::user()->nickname }}" src="/static/img/tmp/profile-pic.jpg"/>
                </span>
                <div class="space-4"></div>
                <div class="signature">
                    做个有头有脸的吃货吧
                </div>
            </div>

            <div class="space-6"></div>

            <div class="profile-contact-info">
                <div class="profile-contact-links align-left">
                    <a class="btn btn-link" href="#">
                        <i class="icon-plus-sign bigger-120 green"></i>
                        积分：20
                    </a>

                    <a class="btn btn-link" href="#">
                        <i class="icon-envelope bigger-120 pink"></i>
                        高级食客
                    </a>

                    <a class="btn btn-link" href="#">
                        <i class="icon-globe bigger-125 blue"></i>
                        注册时间：2014-08-12
                    </a>
                </div>

                <div class="space-6"></div>

                <div class="profile-social-links center">
                    <button type="button" class="btn btn-success radius"><i class="fa fa-wechat fa-2x"></i></button>
                    <button type="button" class="btn btn-danger radius"><i class="fa fa-weibo fa-2x"></i></button>
                    <button type="button" class="btn btn-info radius"><i class="fa fa-qq fa-2x"></i></button>
                </div>
            </div>

            <div class="hr hr12 dotted"></div>

            <div class="clearfix">
                <div class="follow">
                    <span class="bigger-175 blue">25</span>
                    <br>
                    <i class="fa fa-star text-yellow"></i> 获得关注
                </div>

                <div class="follow">
                    <span class="bigger-175 blue">12</span>
                    <br>
                    <i class="fa fa-heart text-red"></i> 获得喜欢
                </div>
            </div>

            <div class="hr hr16 dotted"></div>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/ucenter/main" src="/static/library/requirejs/require.js"></script>
@stop

