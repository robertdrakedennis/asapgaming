<?php

namespace App\Providers;

use App\Services\SteamService;
use Illuminate\Support\ServiceProvider;

class SteamServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SteamService::class, function ($app) {
            return new SteamService($app['config']['steam-login']['api_key']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SteamService::class];
    }
}
