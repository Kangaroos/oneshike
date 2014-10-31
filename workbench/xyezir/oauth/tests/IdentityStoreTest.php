<?php

use Xyezir\Oauth\OauthIdentity;
use Xyezir\Oauth\IdentityStore;
use Xyezir\Oauth\ProviderUserDetails;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Mockery as M;

class IdentityStoreTest extends FunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();
        Eloquent::unguard();
    }

    public function test_getByProvider()
    {
        OauthIdentity::create(array(
            'user_id' => 1,
            'provider' => 'facebook',
            'provider_user_id' => 'foobar',
            'access_token' => 'abc123',
            ));
        OauthIdentity::create(array(
            'user_id' => 2,
            'provider' => 'facebook',
            'provider_user_id' => 'bazfoo',
            'access_token' => 'def456',
            ));
        $details = new ProviderUserDetails(array(
            'accessToken' => 'new-token',
            'userId' => 'bazfoo',
            'nickname' => 'john.doe',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'imageUrl' => 'http://example.com/photos/john_doe.jpg',
        ));
        $identities = new IdentityStore;
        $identity = $identities->getByProvider('facebook', $details);
        $this->assertEquals(2, $identity->user_id);
        $this->assertEquals('facebook', $identity->provider);
        $this->assertEquals('bazfoo', $identity->provider_user_id);
        $this->assertEquals('def456', $identity->access_token);
    }

    public function test_getByProvider_when_no_match()
    {
        OauthIdentity::create(array(
            'user_id' => 1,
            'provider' => 'facebook',
            'provider_user_id' => 'foobar',
            'access_token' => 'abc123',
            ));
        OauthIdentity::create(array(
            'user_id' => 2,
            'provider' => 'facebook',
            'provider_user_id' => 'bazfoo',
            'access_token' => 'def456',
            ));
        $details = new ProviderUserDetails(array(
            'accessToken' => 'new-token',
            'userId' => 'missing-id',
            'nickname' => 'john.doe',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john.doe@example.com',
            'imageUrl' => 'http://example.com/photos/john_doe.jpg',
        ));
        $identities = new IdentityStore;
        $identity = $identities->getByProvider('facebook', $details);
        $this->assertNull($identity);
    }

    public function test_flush()
    {
        OauthIdentity::create(array(
            'user_id' => 1,
            'provider' => 'facebook',
            'provider_user_id' => 'foobar',
            'access_token' => 'abc123',
            ));
        OauthIdentity::create(array(
            'user_id' => 2,
            'provider' => 'facebook',
            'provider_user_id' => 'bazfoo',
            'access_token' => 'def456',
            ));

        $this->assertEquals(1, OauthIdentity::where('provider', 'facebook')->where('user_id', 2)->count());

        $identities = new IdentityStore;
        $user = M::mock();
        $user->shouldReceive('getKey')->andReturn(2);
        $identities->flush($user, 'facebook');

        $this->assertEquals(0, OauthIdentity::where('provider', 'facebook')->where('user_id', 2)->count());
    }

    public function test_store()
    {
        $identity = new OauthIdentity(array(
            'user_id' => 1,
            'provider' => 'facebook',
            'provider_user_id' => 'foobar',
            'access_token' => 'abc123',
            ));

        $this->assertEquals(0, OauthIdentity::count());

        $identities = new IdentityStore;
        $identities->store($identity);

        $this->assertEquals(1, OauthIdentity::count());
    }
}
