<?php namespace Xyezir\Oauth;

class IdentityStore
{
    public function getByProvider($provider, $providerUserDetails)
    {
        return OauthIdentity::where('provider', $provider)
            ->where('provider_user_id', $providerUserDetails->userId)
            ->first();
    }

    public function flush($user, $provider)
    {
        OauthIdentity::where('user_id', $user->getKey())
            ->where('provider', $provider)
            ->delete();
    }

    public function store(OauthIdentity $identity)
    {
        $identity->save();
    }

    public function userExists($provider, ProviderUserDetails $details)
    {
        return (bool) $this->getByProvider($provider, $details);
    }
}
