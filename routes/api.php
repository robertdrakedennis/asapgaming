<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('api', 'throttle:200,1')->group(function () {
    Route::prefix('users')->group(function (){
        Route::get('/', 'Api\UsersController@Index');
        Route::get('{user}', 'Api\UsersController@Show');
    });

    Route::prefix('news')->group(function (){
        Route::get('/', 'Api\ArticleController@Index');
        Route::get('{article}', 'Api\ArticleController@show');
    });

    Route::prefix('coinflips')->group(function (){
        Route::get('/', 'Api\CoinflipController@Index');
        Route::get('/create', 'Api\CoinflipController@Create');
        Route::get('/join/{coinflip}', 'Api\CoinflipController@Join');
        Route::get('/delete/{coinflip}', 'Api\CoinflipController@Destroy');
        Route::get('/active', 'Api\CoinflipController@GetActiveCoinflips');
        Route::get('/active/{user}', 'Api\CoinflipController@GetUserCoinflips');
    });
});


