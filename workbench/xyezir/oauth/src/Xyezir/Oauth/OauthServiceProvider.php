<?php namespace Xyezir\Oauth;

use Illuminate\Support\ServiceProvider;
use Guzzle\Http\Client as HttpClient;

class OauthServiceProvider extends ServiceProvider {

    protected $providerLookup = array(
        'facebook' => 'Xyezir\\Oauth\\Providers\\FacebookProvider',
        'github' => 'Xyezir\\Oauth\\Providers\\GitHubProvider',
        'google' => 'Xyezir\\Oauth\\Providers\\GoogleProvider',
        'linkedin' => 'Xyezir\\Oauth\\Providers\\LinkedInProvider',
        'instagram' => 'Xyezir\\Oauth\\Providers\\InstagramProvider',
    );

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('xyezir/oauth');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerOauthManager();
    }

    protected function registerOauthManager()
    {
        $this->app['xyezir.oauth'] = $this->app->share(function($app)
        {
            $this->configureOauthIdentitiesTable();
            $users = new UserStore($app['config']['auth.model']);
            $stateManager = new StateManager($app['session.store'], $app['request']);
            $oauth = new OauthManager($app['auth'], $app['redirect'], $stateManager, $users, new IdentityStore);
            $this->registerProviders($oauth);
            return $oauth;
        });
    }

    protected function registerProviders($oauth)
    {
        $providerAliases = $this->app['config']['oauth::providers'];
        foreach ($providerAliases as $alias => $config) {
            if(isset($this->providerLookup[$alias])) {
                $providerClass = $this->providerLookup[$alias];
                $provider = new $providerClass($config, new HttpClient, $this->app['request']);
                $oauth->registerProvider($alias, $provider);
            }
        }
    }

    protected function configureOauthIdentitiesTable()
    {
        OauthIdentity::configureTable($this->app['config']['oauth::table']);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('xyezir.oauth');
    }

}
