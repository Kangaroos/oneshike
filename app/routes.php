<?php

/*
|--------------------------------------------------------------------------
| 基础权限
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'auth'), function () {
    $Admin = 'AdminController@';

    Route::group(array('before' => 'admin.guest'), function () use ($Admin) {
        # 登录
        Route::get('admin', array('as' => 'admin', 'uses' => $Admin.'getSignin'));
        Route::post('admin', $Admin.'postSignin');
    });
});

/*
|--------------------------------------------------------------------------
| 管理员后台
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin', 'before' => 'admin'), function () {
    $resource   = 'admin';
    $controller = 'AdminController@';
    Route::get('logout', array('as' => 'logout', 'uses' => $controller.'getLogout'));
    # 后台首页
    Route::get('/', array('as' => $resource, 'uses' => $controller.'getConsoleIndex'));
    Route::get('/changePassword', array('as' => $resource.'.getChangePassword', 'uses' => $controller.'getChangePassword'));
    Route::put('/changePassword', array('as' => $resource.'.putChangePassword' , 'uses' => $controller.'putChangePassword' ));
});
