<?php namespace Xyezir\EloquentOAuth;

class IdentityStore
{
    public function getByProvider($provider, $providerUserDetails)
    {
        return OAuthIdentity::where('provider', $provider)
            ->where('provider_user_id', $providerUserDetails->userId)
            ->first();
    }

    public function flush($user, $provider)
    {
        OAuthIdentity::where('user_id', $user->getKey())
            ->where('provider', $provider)
            ->delete();
    }

    public function store(OAuthIdentity $identity)
    {
        $identity->save();
    }

    public function userExists($provider, ProviderUserDetails $details)
    {
        return (bool) $this->getByProvider($provider, $details);
    }
}
