<?php

use Mockery as M;
use Xyezir\EloquentOAuth\OAuthManager;

class OAuthManagerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }

    public function test_authorize_returns_correct_redirect_when_provider_is_registered()
    {
        $auth = M::mock('Illuminate\\Auth\\AuthManager')->shouldIgnoreMissing();
        $redirector = M::mock('Illuminate\\Routing\\Redirector')->shouldIgnoreMissing();
        $stateManager  = M::mock('Xyezir\\EloquentOAuth\\StateManager')->shouldIgnoreMissing();
        $users  = M::mock('Xyezir\\EloquentOAuth\\UserStore')->shouldIgnoreMissing();
        $identities  = M::mock('Xyezir\\EloquentOAuth\\IdentityStore')->shouldIgnoreMissing();

        $oauth = new OAuthManager($auth, $redirector, $stateManager, $users, $identities);

        $redirectResponse = M::mock('Illuminate\\Http\\RedirectResponse');
        $redirectUrl = 'http://example.com/authorize';
        $provider = M::mock('Xyezir\\EloquentOAuth\\Providers\\ProviderInterface');
        $provider->shouldReceive('authorizeUrl')->andReturn($redirectUrl);
        $redirector->shouldReceive('to')->with($redirectUrl)->andReturn($redirectResponse);

        $oauth->registerProvider('provider', $provider);

        $result = $oauth->authorize('provider');
        $expected = $redirectResponse;

        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException Xyezir\EloquentOAuth\Exceptions\ProviderNotRegisteredException
     */
    public function test_authorize_throws_exception_when_provider_is_not_registered()
    {
        $auth = M::mock('Illuminate\\Auth\\AuthManager')->shouldIgnoreMissing();
        $redirector = M::mock('Illuminate\\Routing\\Redirector')->shouldIgnoreMissing();
        $stateManager  = M::mock('Xyezir\\EloquentOAuth\\StateManager')->shouldIgnoreMissing();
        $users  = M::mock('Xyezir\\EloquentOAuth\\UserStore')->shouldIgnoreMissing();
        $identities  = M::mock('Xyezir\\EloquentOAuth\\IdentityStore')->shouldIgnoreMissing();

        $oauth = new OAuthManager($auth, $redirector, $stateManager, $users, $identities);

        $result = $oauth->authorize('missingProvider');
    }

    public function test_login_creates_new_user_if_no_matching_user_exists()
    {
        $auth = M::mock('Illuminate\\Auth\\AuthManager');
        $redirector = M::mock('Illuminate\\Routing\\Redirector');
        $stateManager  = M::mock('Xyezir\\EloquentOAuth\\StateManager')->shouldIgnoreMissing();
        $users  = M::mock('Xyezir\\EloquentOAuth\\UserStore');
        $identities  = M::mock('Xyezir\\EloquentOAuth\\IdentityStore')->shouldIgnoreMissing();

        $provider = M::mock('Xyezir\\EloquentOAuth\\Providers\\ProviderInterface');
        $userDetails = M::mock('Xyezir\\EloquentOAuth\\ProviderUserDetails');

        $user = M::mock('stdClass')->shouldIgnoreMissing();

        $oauth = new OAuthManager($auth, $redirector, $stateManager, $users, $identities);
        $oauth->registerProvider('provider', $provider);

        $stateManager->shouldReceive('verifyState')->andReturn(true);
        $provider->shouldReceive('getUserDetails')->andReturn($userDetails);
        $users->shouldReceive('create')->andReturn($user);
        $users->shouldReceive('store')->andReturn(true);

        $auth->shouldReceive('login')->with($user)->once();
        $result = $oauth->login('provider');
    }

    public function test_login_uses_existing_user_if_matching_user_exists()
    {
        $auth = M::mock('Illuminate\\Auth\\AuthManager');
        $redirector = M::mock('Illuminate\\Routing\\Redirector');
        $stateManager  = M::mock('Xyezir\\EloquentOAuth\\StateManager')->shouldIgnoreMissing();
        $users  = M::mock('Xyezir\\EloquentOAuth\\UserStore');
        $identities  = M::mock('Xyezir\\EloquentOAuth\\IdentityStore')->shouldIgnoreMissing();

        $provider = M::mock('Xyezir\\EloquentOAuth\\Providers\\ProviderInterface');
        $freshUserDetails = M::mock('Xyezir\\EloquentOAuth\\ProviderUserDetails');
        $existingUserDetails = M::mock('Xyezir\\EloquentOAuth\\ProviderUserDetails');

        $user = M::mock('stdClass')->shouldIgnoreMissing();

        $oauth = new OAuthManager($auth, $redirector, $stateManager, $users, $identities);
        $oauth->registerProvider('provider', $provider);

        $stateManager->shouldReceive('verifyState')->andReturn(true);
        $provider->shouldReceive('getUserDetails')->andReturn($freshUserDetails);
        $identities->shouldReceive('userExists')->with('provider', $freshUserDetails)->andReturn(true);
        $identities->shouldReceive('getByProvider')->with('provider', $freshUserDetails)->andReturn($existingUserDetails);
        $users->shouldReceive('create')->never();
        $users->shouldReceive('findByIdentity')->once()->andReturn($user);
        $users->shouldReceive('store')->andReturn(true);

        $auth->shouldReceive('login')->with($user)->once();
        $result = $oauth->login('provider');
    }
}
