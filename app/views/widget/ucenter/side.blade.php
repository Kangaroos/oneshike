@section('head')
@parent
<link href="{{ asset('/static/library/cropper/dist/cropper.min.css') }}" rel="stylesheet">
<link href="{{ asset('/static/library/cropper/examples/crop-avatar/css/crop-avatar.css') }}" rel="stylesheet">
@stop

<div class="col-xs-12 col-sm-3 center">
    <div id="crop-avatar">
        <span class="avatar-view" title="修改头像">
            <img id="avatar" alt="{{ Auth::user()->nickname }}" src="{{ Auth::user()->avatar }}"/>
        </span>
        <!-- Cropping modal -->
        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="avatar-form" action="/ucenter/changeAvatar" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal" type="button">&times;</button>
                            <h4 class="modal-title" id="avatar-modal-label">修改头像</h4>
                        </div>
                        <div class="modal-body">
                            <div class="avatar-body">
                                <div class="avatar-upload">
                                    <input class="avatar-src" name="avatar_src" type="hidden">
                                    <input class="avatar-data" name="avatar_data" type="hidden">
                                    <label for="avatarInput">选择图片</label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="avatar-wrapper"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="avatar-preview preview-lg"></div>
                                        <div class="avatar-preview preview-md"></div>
                                        <div class="avatar-preview preview-sm"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button">关闭</button>
                            <button class="btn btn-primary avatar-save" type="submit">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    </div>
    <div class="space-4"></div>
    <div class="signature">
        做个有头有脸的吃货吧
    </div>
    <div class="space-6"></div>
    <div class="profile-contact-info">
        <div class="profile-contact-links">
            <a class="btn btn-link" href="#">
                积分：{{Auth::user()->points}}
            </a>

            <a class="btn btn-link" href="#">
                {{Auth::user()->levelName()}}
            </a>

            <a class="btn btn-link" href="#">
                注册时间：{{Auth::user()->created_at}}
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