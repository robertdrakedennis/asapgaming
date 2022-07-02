<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class CreateUserController extends Controller
{
    public function createUser(Request $request){

        $steam = new SteamUser("[U:1:{$request->steam_account_id}]");

        $steam->getUserInfo();

        // avatar url
        $url = $steam->avatar;
        // get image
        $contents = file_get_contents($url);
        // hash url
        $name = md5($url).'.jpg';
        // public path for avi's
        $path = 'public/avatars/' . $name;
        // save image
        Storage::put('/'. $path, $contents);

        $user = User::where('steam_account_id', '=',  $steam->accountId)->firstOrCreate(
            ['steam_account_id' => $steam->accountId,],[
            'name' => $steam->name,
            'steam_account_id' => $steam->accountId,
            'slug' => $steam->steamId,
            'avatar' => $path,
        ]);
        app()['cache']->forget('spatie.permission.cache');
        $user->assignRole('User');

        Auth::logout();
    }
}
