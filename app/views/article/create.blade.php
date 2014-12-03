@extends('layouts.default')

@section('head')
@parent
<link rel="stylesheet" href="/static/library/summernote/dist/summernote.css">
@section('title')发布图文 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="article-creale">
        <input type="hidden" id="article_id" value="{{ $article->id }}">
        <div class="form-group">
            <input type="text" class="form-control" id="article-title" name="title" placeholder="请输入图文标题" value="{{ $article->title }}" autocomplete="off">
        </div>
        <div class="form-group">
            <div id="article-content">{{ $article->content }}</div>
        </div>
        <div class="pictures">
            <?php $imgindex = 0 ?>
            @foreach ($article->pictures as $picture)
            <?php $imgindex++; ?>
            <div class="picture-group" data-id="{{ $picture->id }}" data-path="{{ $picture->path }}">
                <a class="delete-image" href="javascript:" title="删除该图片">X</a>
                <div class="thumbnail-img">
                    <label class="image-name">&lt;图片{{ $imgindex }}&gt;</label>
                    <div class="image-thumb">
                        <img src="{{ $picture->thumbnail }}" alt="{{ $picture->desc }}">
                    </div>
                </div>
                <div class="image-desc">
                    <label class="field" for="p{{ $imgindex }}_title">图片备注</label>
                    <textarea id="p{{ $imgindex }}_title" class="textarea-image-desc" placeholder="请输入图片备注信息" data-old-value="{{ $picture->desc }}">{{ $picture->desc }}</textarea>
                    <a class="insert-picture-editor" href="javascript:">插入图片</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="form-group">
            <button id="save-article" type="button" data-loading-text="保存中..." class="btn btn-primary" autocomplete="off">保 存</button>
            <button id="cancle-article" type="button" class="btn btn-default">取消</button>
            <button id="publish-article" type="button" data-loading-text="发布中..." class="btn btn-success pull-right" autocomplete="off">发布图文</button>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script data-main="/static/js/views/article/create/main" src="/static/library/requirejs/require.js"></script>
@stop

