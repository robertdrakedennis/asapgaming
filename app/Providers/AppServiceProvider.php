<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (env('APP_ENV') === 'production') {
            $this->app['url']->forceScheme('https');
        }
//        $collection = collect(GitLab::repositories()->commits(10563654));
//
//        $collection = new Paginator($collection, 1);
//
//        dd($collection);
//        dd($collection->paginate(5));
        // we're done here - how easy was that, it just works!
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
