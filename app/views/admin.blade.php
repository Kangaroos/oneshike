<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>@lang('admin.name')-@lang('admin.login.title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset('/static/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/static/admin/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/static/admin/css/AdminLTE.css')}}" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="{{ asset('/static/admin/js/html5shiv.min.js')}}"></script>
    <script src="{{ asset('/static/admin/js/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    <div class="header">@lang('admin.login.header-title')</div>
    <form action="{{ url('/auth/admin') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="body bg-gray">
            <div class="form-group">
                <input type="text" name="account" class="form-control" placeholder="@lang('admin.login.username-placeholder')"/>
            </div>
            <div class="form-group">
                <input type="password" name="pwd" class="form-control" placeholder="@lang('admin.login.password-placeholder')"/>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember-me"/> @lang('admin.login.remember-me')
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn bg-olive btn-block">@lang('admin.login.login-btn')</button>
            <p><a href="#">@lang('admin.login.forget-pwd')</a></p>
        </div>
    </form>
</div>
<script src="{{ asset('/static/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('/static/admin/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("form").submit(function(){
            $(":submit").text("登录中...")
            $(":submit").attr('disabled',"disabled");
        })
    });
</script>
</body>
</html>