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
| 网站前台
|--------------------------------------------------------------------------
*/
Route::group(array(), function () {
    $controller = 'HomeController@';
    Route::get('/', array('as' => 'index', 'uses' => $controller.'getIndex'));
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
    Route::get('/tables', array('as' => $resource.'.dataTables' , 'uses' => $controller.'dataTables' ));
    Route::post('/store', array('as' => $resource.'.store' , 'uses' => $controller.'store' ));


    Route::group(array('prefix' => 'foods'), function () {
        $resource   = 'foods';
        $controller = 'FoodController@';
        Route::get('/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => $resource.'.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => $resource.'.store' , 'uses' => $controller.'store' ));

        Route::get('/category', array('as' => $resource.'.category'  , 'uses' => $controller.'getFoodCategory'));
        Route::get('/category/tables', array('as' => $resource.'.category.dataTables' , 'uses' => $controller.'getFoodCategoryDataTables' ));
        Route::post('/category/store', array('as' => $resource.'.category.store' , 'uses' => $controller.'getFoodCategoryStore' ));

        Route::get('/area', array('as' => $resource.'.area'  , 'uses' => $controller.'getFoodArea'));
        Route::get('/area/tables', array('as' => $resource.'.area.dataTables' , 'uses' => $controller.'getFoodAreaDataTables' ));
        Route::post('/area/store', array('as' => $resource.'.area.store' , 'uses' => $controller.'getFoodAreaStore' ));
    });

    # 用户管理
    Route::group(array('prefix' => 'users'), function () {
        $resource   = 'users';
        $controller = 'UserController@';
        Route::get('/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => $resource.'.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => $resource.'.store' , 'uses' => $controller.'store' ));

        Route::get('/level', array('as' => $resource.'.level'  , 'uses' => $controller.'getUserLevel'));
        Route::get('/level/tables', array('as' => $resource.'.level.dataTables'  , 'uses' => $controller.'getUserLevelDataTables'));
        Route::post('/level/store', array('as' => $resource.'.level.store'  , 'uses' => $controller.'getUserLevelStore'));
    });

    Route::group(array('prefix' => 'categorys'), function () {
        $resource   = 'categorys';
        $controller = 'CategoryController@';
        Route::get('/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => $resource.'.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => $resource.'.store' , 'uses' => $controller.'store' ));
    });

    # 系统管理
    Route::group(array('prefix' => 'system'), function () {
        $resource   = 'system';
        $controller = 'SystemController@';
        Route::get('/admin', array('as' => $resource.'.admin'  , 'uses' => $controller.'getAdminIndex'));
    });

    # 字典管理
    Route::group(array('prefix' => 'dicts'), function () {
        $resource   = 'dicts';
        $controller = 'DictController@';
        Route::get('/', array('as' => $resource.'.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => $resource.'.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => $resource.'.store' , 'uses' => $controller.'store' ));
    });
});
