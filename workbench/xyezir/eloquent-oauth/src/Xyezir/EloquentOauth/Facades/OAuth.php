<?php namespace Xyezir\EloquentOAuth\Facades;

use Illuminate\Support\Facades\Facade;

class OAuth extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'xyezir.oauth';
	}
}