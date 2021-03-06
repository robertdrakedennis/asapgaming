<?php

namespace App\Providers;


use App\Article;
use App\Thread;
use App\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(){
        parent::boot();

        Route::bind('thread', function ($value) {
            return Thread::withTrashed()->Where('slug', $value)->firstOrFail();
        });

        Route::bind('article', function ($value) {
            return Article::where('id', $value)->orWhere('slug', $value)->firstOrFail();
        });

        Route::bind('user', function ($value) {
            return User::where('slug', $value)->orWhere('steam_account_id', $value)->firstOrFail();
        });

        Route::bind('notification', function ($value) {
            return DatabaseNotification::where('id', $value)->firstOrFail();
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
