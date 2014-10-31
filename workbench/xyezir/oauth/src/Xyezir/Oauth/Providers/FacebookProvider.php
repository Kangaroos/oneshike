<?php namespace Xyezir\Oauth\Providers;

use Xyezir\Oauth\Exceptions\InvalidAuthorizationCodeException;

class FacebookProvider extends Provider
{
	protected $authorizeUrl = "https://www.facebook.com/dialog/oauth";
	protected $accessTokenUrl = "https://graph.facebook.com/oauth/access_token";
	protected $userDataUrl = "https://graph.facebook.com/me";
	protected $scope = array(
        'email',
	);

	protected function getAuthorizeUrl()
	{
		return $this->authorizeUrl;
	}

	protected function getAccessTokenBaseUrl()
	{
		return $this->accessTokenUrl;
	}

	protected function getUserDataUrl()
	{
		return $this->userDataUrl;
	}

	protected function parseTokenResponse($response)
	{
		parse_str($response);
		if (! isset($access_token)) {
			throw new InvalidAuthorizationCodeException;
		}
		return $access_token;
	}

	protected function parseUserDataResponse($response)
	{
		return json_decode($response, true);
	}

	protected function userId()
	{
		return $this->getProviderUserData('id');
	}

	protected function nickname()
	{
		return $this->getProviderUserData('username');
	}

	protected function firstName()
	{
		return $this->getProviderUserData('first_name');
	}

	protected function lastName()
	{
		return $this->getProviderUserData('last_name');
	}

	protected function imageUrl()
	{
		return 'https://graph.facebook.com/'.$this->userId().'/picture';
	}

	protected function email()
	{
		return $this->getProviderUserData('email');
	}
}
