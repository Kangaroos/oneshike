@extends('layouts.default')

@section('head')
@parent
@section('title')找回密码 @parent @stop
@stop

@section('container')
<div class="osk-page">
    <div class="sign-in-up">
        @if( !Session::get('status') )
        <h4>请输入您注册时所使用的邮箱</h4>
        <span class="separated"></span>
        @endif
        <div class="form-box">
            @if( Session::get('error') )
            <div class="error-box">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p>{{ Session::get('error') }}</p>
                </div>
            </div>
            @elseif( Session::get('status') )
            <div class="error-box">
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <p>{{ Session::get('status') }}</p>
                </div>
            </div>
            <script>
                setTimeout(function(){
                    location.href = '/auth/signin';
                }, 3000)
            </script>
            @endif
            @if( !Session::get('status') )
            <form action="{{ action('RemindersController@postRemind') }}" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><span class="icons"><i class="fa fa-envelope"></i></span></span>
                            <input type="email" class="form-control" name="email" placeholder="请输入邮箱账号" value="{{Input::old('email');}}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">找回密码</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@stop
