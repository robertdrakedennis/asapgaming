<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@Index')->name('home');


Route::get('/tos', function () {
    return view('main.tos');
})->name('tos');

// Coinflip Routes
Route::get('/coinflips', 'CoinflipController@index')->name('coinflips.index');

//Forum Routes
Route::get('/forums', 'ForumController@index')->name('forums.index');

Route::prefix('forums')->middleware('auth')->group(function () {
    // start categories
    Route::get('/', [
        'as' => 'forums.index',
        'uses' => 'ForumController@Index'
    ]);

    Route::get('/categories', [
        'as' => 'categories.index',
        'uses' => 'CategoryController@Index'
    ]);

    Route::post('/categories', [
        'as' => 'categories.store',
        'uses' => 'CategoryController@Store'
    ]);

    Route::get('/{category}', [
        'as' => 'categories.show',
        'uses' => 'CategoryController@Show'
    ]);

    Route::get('/{category}/edit', [
        'as' => 'categories.edit',
        'uses' => 'CategoryController@Edit'
    ]);

    Route::patch('/{category}/update', [
        'as' => 'categories.update',
        'uses' => 'CategoryController@Update'
    ]);

    Route::post('/{category}/delete', [
        'as' => 'categories.delete',
        'uses' => 'CategoryController@Destroy'
    ]);

    Route::post('/{category}/lock', [
        'as' => 'categories.lock',
        'uses' => 'CategoryController@lockCategory'
    ]);

    Route::post('/{category}/private', [
        'as' => 'categories.private',
        'uses' => 'CategoryController@privateCategory'
    ]);

    // end categories



    //start threads
    Route::get('/{category}/create', [
        'as' => 'threads.create',
        'uses' => 'ThreadController@Create'
    ]);

    Route::post('/{category}/store', [
        'as' => 'threads.store',
        'uses' => 'ThreadController@Store'
    ]);

    Route::get('/{category}/{thread}', [
        'as' => 'threads.show',
        'uses' => 'ThreadController@Show'
    ]);

    Route::get('/{category}/{thread}/edit', [
        'as' => 'threads.edit',
        'uses' => 'ThreadController@Edit'
    ]);

    Route::patch('/{category}/{thread}/update', [
        'as' => 'threads.update',
        'uses' => 'ThreadController@Update'
    ]);

    Route::post('/{category}/{thread}/delete', [
        'as' => 'threads.delete',
        'uses' => 'ThreadController@Destroy'
    ]);

    Route::post('/{category}/{thread}/subscribe', [
        'as' => 'threads.subscribe',
        'uses' => 'Subscriptions\ThreadSubscriptionsController@store'
    ]);

    Route::post('/{category}/{thread}/unsubscribe', [
        'as' => 'threads.unsubscribe',
        'uses' => 'Subscriptions\ThreadSubscriptionsController@destroy'
    ]);


    Route::post('/{category}/{thread}/restore', [
        'as' => 'threads.restore',
        'uses' => 'ThreadController@Restore'
    ]);

    Route::post('/{category}/{thread}/lock', [
        'as' => 'threads.lock',
        'uses' => 'ThreadController@lockThread'
    ]);

    Route::post('/{category}/{thread}/pin', [
        'as' => 'threads.pin',
        'uses' => 'ThreadController@pinThread'
    ]);

    Route::post('/{category}/{thread}/move', [
        'as' => 'threads.move',
        'uses' => 'ThreadController@movethread'
    ]);
    // end threads

    // start replies
    Route::post('/{category}/{thread}', [
        'as' => 'replies.store',
        'uses' => 'ReplyController@Store'
    ]);


    Route::get('/{category}/{thread}/{reply}/edit', [
        'as' => 'replies.edit',
        'uses' => 'ReplyController@Edit'
    ]);

    Route::patch('/{category}/{thread}/{reply}/update', [
        'as' => 'replies.update',
        'uses' => 'ReplyController@Update'
    ]);

    Route::post('/{category}/{thread}/{reply}/delete', [
        'as' => 'replies.delete',
        'uses' => 'ReplyController@Destroy'
    ]);

    Route::post('/{category}/{thread}/{reply}/restore', [
        'as' => 'replies.restore',
        'uses' => 'ReplyController@Restore'
    ]);
    // end replies
});

//Start news
Route::prefix('news')->group(function () {
    Route::get('/', [
        'as' => 'articles.index',
        'uses' => 'ArticleController@Index'
    ]);

    Route::get('/darkrp/rules', function (){
        return view('main.news.static.rules');
    });


    Route::post('/create', [
        'as' => 'articles.store',
        'uses' => 'ArticleController@Store'
    ]);

    Route::patch('/{article}/update', [
        'as' => 'articles.update',
        'uses' => 'ArticleController@Update'
    ]);
    Route::get('/create', [
        'as' => 'articles.create',
        'uses' => 'ArticleController@Create'
    ]);


    Route::get('/{article}', [
        'as' => 'articles.show',
        'uses' => 'ArticleController@Show'
    ]);

    Route::get('/{article}/edit', [
        'as' => 'articles.edit',
        'uses' => 'ArticleController@Edit'
    ]);
});



Route::prefix('users')->group(function () {
    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'UserController@Index',
        'middleware' => 'auth'
    ]);

    Route::get('/staff', [
        'as' => 'users.staff',
        'uses' => 'UserController@Staff',
        'middleware' => 'auth'
    ]);

    Route::get('/leaderboards', [
        'as' => 'users.leaderboards',
        'uses' => 'LeaderboardController@Index',
        'middleware' => 'auth'
    ]);

    Route::get('/leaderboards/time', [
        'as' => 'users.leaderboards.time',
        'uses' => 'LeaderboardController@Time',
        'middleware' => 'auth'
    ]);

    Route::get('/bans', [
        'as' => 'users.bans',
        'uses' => 'BansController@Index',
        'middleware' => 'auth'
    ]);

    Route::get('/{user}', [
        'as' => 'users.show',
        'uses' => 'UserController@Show'
    ]);

    Route::post('/{user}', [
        'as' => 'users.comment.store',
        'uses' => 'CommentsController@Store',
        'middleware' => 'auth'
    ]);

    Route::post('/{user}/{comment}/delete', [
        'as' => 'users.comment.delete',
        'uses' => 'CommentsController@Delete',
        'middleware' => 'auth'
    ]);

    Route::get('/{user}/{comment}/edit', [
        'as' => 'users.comment.edit',
        'uses' => 'CommentsController@Edit',
        'middleware' => 'auth'
    ]);

    Route::patch('/{user}/{comment}/update', [
        'as' => 'users.comment.update',
        'uses' => 'CommentsController@Update',
        'middleware' => 'auth'
    ]);

    Route::get('/{user}/notifications', [
        'as' => 'users.notifs',
        'uses' => 'Notifications\UserNotificationController@Index',
        'middleware' => 'auth'
    ]);

    Route::get('/{user}/notifications/{notification}', [
        'as' => 'users.notif.view',
        'uses' => 'NotificationController@Read',
        'middleware' => 'auth'
    ]);

    Route::post('/{user}/notifications/markAllAsRead', [
        'as' => 'users.markAllAsRead',
        'uses' => 'Notifications\UserNotificationController@markAllAsRead',
        'middleware' => 'auth'
    ]);


    Route::patch('/{user}/update', [
        'as' => 'users.update',
        'uses' => 'UserController@Update',
        'middleware' => 'auth'
    ]);

    Route::post('/{user}/syncWithSteam', [
        'as' => 'users.syncWithSteam',
        'uses' => 'UserController@syncWithSteam',
        'middleware' => 'auth'
    ]);

    Route::post('/{user}/setRank', [
        'as' => 'users.setrank',
        'uses' => 'UserController@setRank',
        'middleware' => 'auth'
    ]);

    Route::post('/{user}/ban', [
        'as' => 'users.ban',
        'uses' => 'UserController@Ban',
        'middleware' => 'auth'
    ]);

    Route::post('/{user}/setCredits', [
        'as' => 'users.set.credits',
        'uses' => 'UserController@setCredits',
        'middleware' => 'auth'
    ]);
});

//store routes
Route::prefix('store')->middleware('auth')->group(function () {
    Route::any('/', function () {
        return view('main.store.index');
    })->name('store');

    Route::get('/purchase', function(){
        alert()->warning('Wait right there!', 'You need to click purchase or if you\'re purchasing for someone else you need to entire their id!');
        return redirect()->route('store');
    });

    Route::post('/purchase', [
        'as' => 'purchase.index',
        'uses' => 'PurchaseController@Purchase'
    ]);
});

Route::post('paypal/notify', 'PayPalController@notify');

//redirect links
Route::get('discord', function () {
    return redirect()->away('https://discordapp.com/invite/2WNqVCs');
})->name('discord');

Route::get('rules', function () {
    return redirect()->route('articles.show', 'dark-rp-rules');
})->name('rules');

Route::get('steam', function () {
    return redirect()->away('https://steamcommunity.com/groups/ASAP-RP');
})->name('steam');

Route::get('mail', function () {
    return redirect()->away('mailto:candyapple420@gmail.com');
})->name('mail');

Route::get('server/1', function () {
    return redirect()->away('steam://connect/208.103.169.207:27015');
})->name('server');

Route::any('loading', function () {
    return view('main.loading.index');
})->name('loading');


// Auth routes
Route::post('logout', 'Auth\LoginController@logout')->name('logout'); // or use the default post method if you prefer

Route::post('login/steam', 'Auth\SteamLoginController@login')->name('login.steam');
Route::get('auth/steam', 'Auth\SteamLoginController@auth')->name('auth.steam');

Route::prefix('oauth')->group(function () {
    Route::get('login', 'Oauth\DiscordController@index')->name('oauth.index');
    Route::post('login', 'Oauth\DiscordController@login')->name('oauth.login');
});


Route::any('login/steam', 'Auth\SteamLoginController@login')->name('login');


Route::post('/webhook/createuser', 'CreateUserController@createUser');


Route::prefix('admin')->middleware(['auth', 'CheckIfStaff'])->group(function () {
    Route::any('/', function () {
        return view('admin.index');
    })->name('admin.index');

//    Route::prefix('stats')->group(function () {
//
//    });

    Route::resource('transactions', 'Admin\Purchases\PurchasesController');

    Route::any('transactions/search', 'Admin\Purchases\PurchasesController@search');

//    Route::prefix('users')->group(function () {
//
//    });

});
