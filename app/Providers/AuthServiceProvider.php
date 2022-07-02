<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Credit;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CreditPolicy;
use App\Policies\ReplyPolicy;
use App\Policies\ThreadPolicy;
use App\Policies\UserPolicy;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Thread::class => ThreadPolicy::class,
        Reply::class => ReplyPolicy::class,
        Article::class => ArticlePolicy::class,
        Credit::class => CreditPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Grant "root" users all permissions (assuming they are verified using can() and other gate-related functions):
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Root')) {
                return true;
            }
        });

        Gate::define('viewWebSocketsDashboard', function ($user = null) {
            if ($user->hasAnyRole(['Owner', 'Administrator'])) {
                return true;
            }
        });
    }
}
