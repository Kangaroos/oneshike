@extends('layouts.default')

@section('head')
@parent
@section('title')图文信息-用户中心 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="user-profile row">
        <div class="col-xs-12 col-sm-9">
            <div class="nav-tabs-custom">
                @include('widget.ucenter.nav',array('navMenu' => 'article'))
                <div class="tab-content">
                    <div class="tab-pane active">
                        @if (count($articles) > 0 )
                        <ul class="timeline">
                            <li class="timeline-inverted">
                                <div style="margin: 0 0 0 32px;"><a class="btn btn-success btn-block" href="/article/create"><i class="fa fa-plus-square-o"></i> 发布图文</a></div>
                            </li>
                            @foreach ($articles as $article)
                            <li class="timeline-inverted">
                                <div class="timeline-badge success"><i class="glyphicon glyphicon-book"></i></div>
                                <div class="timeline-panel">
                                    @if (count($article->pictures) > 0)
                                    <div class="cover">
                                        <img src="{{ $article->pictures[0]->thumbnail }}" alt="{{ $article->pictures[0]->desc }}">
                                        <div class="edit-box">
                                            <button type="button" class="edit-btn" data-url="/article/edit/{{ $article->id }}">编辑</button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="cover">
                                        <img src="{{ asset('/static/img/nopic.png') }}" alt="没有图片">
                                        <div class="edit-box">
                                            <button type="button" class="edit-btn" data-url="/article/edit/{{ $article->id }}">编辑</button>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="status <?php if($article->status == '002')echo "checking";elseif($article->status == '003') echo "checked";else echo "nocheck"; ?>"></div>
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">{{ str_limit(strip_tags($article->title), 30, '...') }}</h4>
                                    </div>
                                    <div class="timeline-body">{{ str_limit(strip_tags($article->content), 30, '...') }}</div>
                                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ $article->created_at }}</small></p>
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
        @include('widget.ucenter.side')
    </div>
</div>
@stop

@section('end')
@parent
<script src="/static/js/views/ucenter/article.js"></script>
@stop

