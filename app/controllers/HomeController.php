<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		return View::make('index');
	}

    public function getSignup()
    {
        return View::make('signup');
    }

    public function postSignup()
    {

    }

    public function getSignin()
    {
        return View::make('signin');
    }

    public function postSignin()
    {

    }

    public function getUCenter() {
        return View::make('ucenter');
    }
}
