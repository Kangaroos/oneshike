@extends('layouts.default')

@section('head')
@parent
<link rel="stylesheet" href="/static/css/image-file-upload.css">
@section('title')发布菜谱 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="cookbook-creale">
        <div class="row">
            <div class="col-xs-7 col-md-7">
                <form class="cookbook-form">
                    <input type="hidden" id="cookbook_id" value="{{ $cookbook->id }}">
                    <div class="form-group">
                        <input type="text" class="form-control" id="cookbook-title" name="title" placeholder="请输入菜谱名称" value="{{ $cookbook->title }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <div class="image-upload-wrapper">
                            <input type="file" name="file" id="file" title="请选择一张图片作为菜谱封面" />
                            <img src="/static/img/cover.png" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">简介</label>
                        <textarea class="form-control" rows="5" placeholder="请输入菜谱简介"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-4">
                                <select class="form-control">
                                    <option>难度</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <select class="form-control">
                                    <option>口味</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <select class="form-control">
                                    <option>用时</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">用料</label>
                        <div class="row margin10">
                            <div class="col-xs-7">
                                <input type="text" class="form-control" placeholder="用料名称" autocomplete="off">
                            </div>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder="用量" autocomplete="off">
                            </div>
                        </div>
                        <div class="row margin10">
                            <div class=" col-xs-7">
                                <input type="text" class="form-control" placeholder="用料名称" autocomplete="off">
                            </div>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder="用量" autocomplete="off">
                            </div>
                        </div>
                        <div class="row margin10">
                            <div class=" col-xs-7">
                                <input type="text" class="form-control" placeholder="用料名称" autocomplete="off">
                            </div>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" placeholder="用量" autocomplete="off">
                            </div>
                        </div>
                        <div class="btn-group-xs">
                            <button type="button" class="btn btn-default" autocomplete="off">增加一种用料</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">做法</label>
                        <div class="row margin10">
                            <div class="col-xs-7">
                                <label class="control-label">1.</label>
                                <textarea class="form-control" rows="5" placeholder="请填写步骤描述"></textarea>
                            </div>
                            <div class="image-upload-wrapper small col-xs-5">
                                <input type="file" name="file" id="file" title="请选择一张图片作为步骤图" />
                                <img src="/static/img/step-cover.png" />
                            </div>
                        </div>
                        <div class="row margin10">
                            <div class="col-xs-7">
                                <label class="control-label">2.</label>
                                <textarea class="form-control" rows="5" placeholder="请填写步骤描述"></textarea>
                            </div>
                            <div class="image-upload-wrapper small col-xs-5">
                                <input type="file" name="file" id="file" title="请选择一张图片作为步骤图" />
                                <img src="/static/img/step-cover.png" />
                            </div>
                        </div>
                        <div class="row margin10">
                            <div class="col-xs-7">
                                <label class="control-label">3.</label>
                                <textarea class="form-control" rows="5" placeholder="请填写步骤描述"></textarea>
                            </div>
                            <div class="image-upload-wrapper small col-xs-5">
                                <input type="file" name="file" id="file" title="请选择一张图片作为步骤图" />
                                <img src="/static/img/step-cover.png" />
                            </div>
                        </div>
                        <div class="btn-group-xs">
                            <button type="button" class="btn btn-default" autocomplete="off">增加一个步骤</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">小贴士</label>
                        <textarea class="form-control" rows="5" placeholder="请输入小贴士"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="normal-label">
                            <input type="radio" value="">
                            设置为独家菜谱，仅在食客网发布，拥有特殊标识（水印）
                        </label>
                    </div>
                    <div class="form-group">
                        <button id="save-cookbook" type="button" data-loading-text="保存中..." class="btn btn-primary" autocomplete="off">保 存</button>
                        <button id="cancle-cookbook" type="button" class="btn btn-default">取消</button>
                        <button id="publish-cookbook" type="button" data-loading-text="发布中..." class="btn btn-success pull-right" autocomplete="off">发布菜谱</button>
                    </div>
                </form>
            </div>
            <div class="col-xs-5 col-md-5">
                <div class="infomation">
                    展示自己的厨艺，与上千万网友共同分享，还能拿积分哦！所有步骤图齐全会有更好的推荐机会！<br>（转载、翻译的内容请在简介里表明出处。）
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('end')
@parent
<script src="/static/js/views/cookbook/create.js"></script>
@stop

