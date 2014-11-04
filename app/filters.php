<?php

use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| 注册应用程序事件，执行顺序如下：
|--------------------------------------------------------------------------
|
| 1.执行 应用程序事件   App::before   参数 $request
| 2.执行 前置过滤器   Route::filter   参数 $route, $request
|
| 3.执行（之前注册进路由的）匿名回调函数或相应的控制器方法，并取得响应实例 $response
|
| 4.执行 后置过滤器   Route::filter   参数 $route, $request, $response
| 5.执行 应用程序事件   App::after    参数 $request, $response
|
| 6.向客户端返回响应实例 $response
|
| 7.执行 应用程序事件   App::finish   参数 $request, $response
| 8.执行 应用程序事件   App::shutdown 参数 $application
|
*/

/*
|--------------------------------------------------------------------------
| [前置] 过滤器
|--------------------------------------------------------------------------
# Route::filter('beforeFilter', function ($route, $request) {});
|
*/

//App::before(function($request){});

# CSRF保护过滤器，防止跨站点请求伪造攻击
//Route::filter('csrf', function()
//{
//    $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
//    if (Session::token() != $token)
//        throw new Illuminate\Session\TokenMismatchException;
//});

# 必须是管理员
Route::filter('admin', function () {
    //拦截未登录管理员用户并记录当前 URL，跳转到登录页面
    if (!Session::has('admin')) return Redirect::to('/auth/admin');
});

Route::when('admin/*', 'admin');

# 必须是未登录管理员（较少应用）
Route::filter('admin.guest', function () {
    // 拦截已登录用户
    if (Session::has('admin')) return Redirect::to('/admin');;
});


# 必须是登录用户
Route::filter('auth', function () {
    // 拦截未登录用户并记录当前 URL，跳转到登录页面
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::guest('signin');
        }
    }
});

# HTTP 基础身份验证过滤器 - 单次弹窗登录验证
Route::filter('auth.basic', function () {
    return Auth::basic();
});

# 必须是游客（较少应用）
Route::filter('guest', function () {
    // 拦截已登录用户
    if (Auth::check()) return Redirect::to('/');
});

# 禁止对自己的账号进行危险操作
Route::filter('not.self', function ($route) {
    // 拦截自身用户 ID
    if (Auth::user()->id == $route->parameter('id'))
        return Redirect::back();
});

/*
|--------------------------------------------------------------------------
| [后置] 过滤器
|--------------------------------------------------------------------------
# Route::filter('afterFilter', function ($route, $request, $response) {});
|
*/

//App::after(function($request, $response){});

/*
|--------------------------------------------------------------------------
| 事件监控
|--------------------------------------------------------------------------
|
*/
# 用户登录事件
Event::listen('auth.login', function ($user, $remember) {
    // 记录最后登录时间
    $user->signin_at = Carbon::now();
    $user->signin_ip = Request::getClientIp();
    $user->signin_count += 1;
    $user->save();
    // 后期可附加权限相关操作
    // ...
});
# 用户退出事件
// Event::listen('auth.logout', function ($user) {
//     //
// });


