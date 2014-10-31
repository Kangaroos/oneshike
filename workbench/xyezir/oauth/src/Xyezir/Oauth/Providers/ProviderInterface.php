<?php namespace Xyezir\Oauth\Providers;

interface ProviderInterface
{
	public function authorizeUrl($state);
	public function getUserDetails();
}
