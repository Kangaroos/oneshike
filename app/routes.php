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
    Route::put('/changePassword', array('as' => $resource.'.putChangePassword' , 'uses' => $controller.'putChangePassword' ));

    # 活动管理
    Route::group(array('prefix' => 'categorys'), function () {
        $resource   = 'categorys';
        $controller = 'CategoryController@';
        Route::get('/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'));
        Route::get('/curd/tables', array('as' => $resource.'.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/curd/store', array('as' => $resource.'.store' , 'uses' => $controller.'store' ));
    });


});
