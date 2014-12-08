<?php

/*
|--------------------------------------------------------------------------
| 网站前台基础权限
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'auth'), function () {
    $Authority = 'AuthorityController@';
    # 退出
    Route::get('logout', array('as' => 'logout', 'uses' => $Authority.'getLogout'));
    Route::group(array('before' => 'guest'), function () use ($Authority) {
        # 登录
        Route::get(                   'signin', array('as' => 'signin'        , 'uses' => $Authority.'getSignin'));
        Route::post(                  'signin', $Authority.'postSignin');
        # 注册
        Route::get(                   'signup', array('as' => 'signup'        , 'uses' => $Authority.'getSignup'));
        Route::post(                  'signup', $Authority.'postSignup');
        # 注册成功提示用户激活
        Route::get(          'success/{email}', array('as' => 'signupSuccess' , 'uses' => $Authority.'getSignupSuccess'));
        # 激活账号
        Route::get('activate/{activationCode}', array('as' => 'activate'      , 'uses' => $Authority.'getActivate'));
        # 忘记密码
        Route::get(          'forgot-password', array('as' => 'forgotPassword', 'uses' => $Authority.'getForgotPassword'));
        Route::post(         'forgot-password', $Authority.'postForgotPassword');
        # 密码重置
        Route::get(  'forgot-password/{token}', array('as' => 'reset'         , 'uses' => $Authority.'getReset'));
        Route::post( 'forgot-password/{token}', $Authority.'postReset');
    });

    $Admin = 'AdminController@';

    Route::group(array('before' => 'admin.guest'), function () use ($Admin) {
        # 登录
        Route::get('admin', array('as' => 'admin', 'uses' => $Admin.'getSignin'));
        Route::post('admin', $Admin.'postSignin');
    });
});

/*
|--------------------------------------------------------------------------
| 用户中心
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'ucenter', 'before' => 'auth'), function(){
    Route::get('/', array('as' => 'ucenter', 'uses' => 'UCenterController@getIndex'));
    Route::get('/article', array('as' => 'ucenter.article', 'uses' => 'UCenterController@getUCenterArticle'));
    Route::get('/cookbook', array('as' => 'ucenter.cookbook', 'uses' => 'UCenterController@getUCenterCookbook'));
    Route::get('/like', array('as' => 'ucenter.like', 'uses' => 'UCenterController@getUCenterLike'));
    Route::get('/favorite', array('as' => 'ucenter.favorite', 'uses' => 'UCenterController@getUCenterFavorite'));
    Route::get('/buy', array('as' => 'ucenter.buy', 'uses' => 'UCenterController@getUCenterBuy'));
});

/*
|--------------------------------------------------------------------------
| 美食图文
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'article', 'before' => 'auth'), function(){
    Route::get('/create', array('as' => 'article.draft.create', 'uses' => 'ArticleController@getDraftCreate'));
    Route::get('/edit/{article_id}', array('as' => 'article.draft.create', 'uses' => 'ArticleController@getArticleEdit'));
    Route::post('/save/{article_id}', array('as' => 'article.draft.save', 'uses' => 'ArticleController@saveDraftCreate'));
    Route::post('/publish/{article_id}', array('as' => 'article.draft.publish', 'uses' => 'ArticleController@publishDraftCreate'));
    Route::delete('/draft/delete/{article_id}', array('as' => 'article.draft.delete', 'uses' => 'ArticleController@deleteDraftCreate'));
    Route::post('/images/{article_id}', array('as' => 'article.upload', 'uses' => 'ArticleController@postImage'));
    Route::delete('/images/delete/{id}', array('as' => 'article.delete', 'uses' => 'ArticleController@deleteImage'));
    Route::post('/images/desc/{id}', array('as' => 'article.desc', 'uses' => 'ArticleController@postDesc'));
});

/*
|--------------------------------------------------------------------------
| 网站前台
|--------------------------------------------------------------------------
*/
Route::group(array(), function () {
    Route::get('/', array('as' => 'index', 'uses' => 'HomeController@getIndex'));

    Route::group(array('prefix' => 'article'), function(){
        Route::get('/', array('as' => 'article.index', 'uses' => 'ArticleController@getIndex'));
    });

    Route::group(array('prefix' => 'cookbook'), function(){
        Route::get('/', array('as' => 'cookbook.index', 'uses' => 'CookbookController@getIndex'));
    });

    Route::group(array('prefix' => 'product'), function(){
        Route::get('/', array('as' => 'product.index', 'uses' => 'ProductController@getIndex'));
    });
});

Route::controller('password', 'RemindersController');

/*
|--------------------------------------------------------------------------
| 管理员后台
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin', 'before' => 'admin'), function () {
    $controller = 'AdminController@';
    Route::get('logout', array('as' => 'logout', 'uses' => $controller.'getLogout'));
    # 后台首页
    Route::get('/', array('as' => 'admin', 'uses' => $controller.'getConsoleIndex'));
    Route::put('/changePassword', array('as' => 'admin.putChangePassword' , 'uses' => $controller.'putChangePassword' ));
    Route::get('/tables', array('as' => 'admin.dataTables' , 'uses' => $controller.'dataTables' ));
    Route::post('/store', array('as' => 'admin.store' , 'uses' => $controller.'store' ));

    #食材百科
    Route::group(array('prefix' => 'foods'), function () {
        $controller = 'AdminFoodController@';
        Route::get('/', array('as' => 'foods.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => 'foods.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => 'foods.store' , 'uses' => $controller.'store' ));

        Route::get('/category', array('as' => 'foods.category'  , 'uses' => $controller.'getFoodCategory'));
        Route::get('/category/tables', array('as' => 'foods.category.dataTables' , 'uses' => $controller.'getFoodCategoryDataTables' ));
        Route::post('/category/store', array('as' => 'foods.category.store' , 'uses' => $controller.'postFoodCategoryStore' ));

        Route::get('/area', array('as' => 'foods.area'  , 'uses' => $controller.'getFoodArea'));
        Route::get('/area/tables', array('as' => 'foods.area.dataTables' , 'uses' => $controller.'getFoodAreaDataTables' ));
        Route::post('/area/store', array('as' => 'foods.area.store' , 'uses' => $controller.'postFoodAreaStore' ));
    });

    #导购商品
    Route::group(array('prefix'=>'products'),function(){
        $controller = 'AdminProductController@';
        Route::get('/',array('as'=>'products.index' , 'uses'=>$controller.'index'));
        Route::get('/tables', array('as' => 'products.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store',array('as'=> 'products.store','uses'=>$controller.'store'));

        Route::get('/category',array('as'=> 'products.category' , 'uses'=>$controller.'getProductCategory'));
        Route::get('/category/tables', array('as' => 'products.category.dataTables' , 'uses' => $controller.'getProductCategoryDataTables' ));
        Route::post('/category/store', array('as' => 'products.product.store' , 'uses' => $controller.'getProductCategoryStore' ));

    });

    #美食图文
    Route::group(array('prefix'=>'articles'),function(){
        $controller = 'AdminArticleController@';
        Route::get('/check',array('as'=>'articles.check' , 'uses'=>$controller.'getCheckArticle'));
        Route::post('/check',array('as'=>'articles.postCheck' , 'uses'=>$controller.'postCheckArticle'));
        Route::get('/tables', array('as' => 'products.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store',array('as'=> 'products.store','uses'=>$controller.'store'));

        Route::get('/category',array('as'=> 'products.category' , 'uses'=>$controller.'getProductCategory'));
        Route::get('/category/tables', array('as' => 'products.category.dataTables' , 'uses' => $controller.'getProductCategoryDataTables' ));
        Route::post('/category/store', array('as' => 'products.product.store' , 'uses' => $controller.'getProductCategoryStore' ));

    });

    # 用户管理
    Route::group(array('prefix' => 'users'), function () {
        $controller = 'AdminUserController@';
        Route::get('/', array('as' => 'users.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => 'users.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => 'users.store' , 'uses' => $controller.'store' ));

        Route::get('/level', array('as' => 'users.level'  , 'uses' => $controller.'getUserLevel'));
        Route::get('/level/tables', array('as' => 'users.level.dataTables'  , 'uses' => $controller.'getUserLevelDataTables'));
        Route::post('/level/store', array('as' => 'users.level.store'  , 'uses' => $controller.'postUserLevelStore'));
    });

    Route::group(array('prefix' => 'categorys'), function () {
        $controller = 'AdminCategoryController@';
        Route::get('/', array('as' => 'categorys.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => 'categorys.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => 'categorys.store' , 'uses' => $controller.'store' ));
    });

    # 系统管理
    Route::group(array('prefix' => 'system'), function () {
        $controller = 'AdminSystemController@';
        Route::get('/admin', array('as' => 'system.admin'  , 'uses' => $controller.'getAdminIndex'));
    });

    # 字典管理
    Route::group(array('prefix' => 'dicts'), function () {
        $controller = 'AdminDictController@';
        Route::get('/', array('as' => 'dicts.index'  , 'uses' => $controller.'index'));
        Route::get('/tables', array('as' => 'dicts.dataTables' , 'uses' => $controller.'dataTables' ));
        Route::post('/store', array('as' => 'dicts.store' , 'uses' => $controller.'store' ));
    });
});


/*
|--------------------------------------------------------------------------
| Common
|--------------------------------------------------------------------------
*/
Route::any('/captcha', function()
{

    if (Request::getMethod() == 'POST')
    {
        $rules =  array('captcha' => array('required', 'captcha'));
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }

    $content = Form::open(array(URL::to(Request::segment(1))));
    $content .= '<p>' . HTML::image(Captcha::img(), 'Captcha image') . '</p>';
    $content .= '<p>' . Form::text('captcha') . '</p>';
    $content .= '<p>' . Form::submit('Check') . '</p>';
    $content .= '<p>' . Form::close() . '</p>';
    return $content;

});
