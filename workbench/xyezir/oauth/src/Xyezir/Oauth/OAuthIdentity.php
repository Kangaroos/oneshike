<?php namespace Xyezir\Oauth;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Config;

class OauthIdentity extends Eloquent
{
	protected static $configuredTable = 'oauth_identities';

	public static function configureTable($table)
	{
		static::$configuredTable = $table;
	}

	public function getTable()
	{
		return static::$configuredTable;
	}
}
