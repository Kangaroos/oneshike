<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>@section('title')@show{{-- 页面标题 --}}</title>
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    @section('head')
    @show{{-- 页面head --}}
</head>

<body class="skin-blue">
@yield('body')

@section('end')
@show{{-- 页面主体之后 --}}
</body>
</html>

