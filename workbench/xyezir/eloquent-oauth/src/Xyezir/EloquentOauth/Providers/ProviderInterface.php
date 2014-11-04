<?php namespace Xyezir\EloquentOAuth\Providers;

interface ProviderInterface
{
	public function authorizeUrl($state);
	public function getUserDetails();
}
