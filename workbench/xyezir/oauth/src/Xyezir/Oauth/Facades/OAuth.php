<?php namespace Xyezir\Oauth\Facades;

use Illuminate\Support\Facades\Facade;

class Oauth extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'xyezir.oauth';
	}
}