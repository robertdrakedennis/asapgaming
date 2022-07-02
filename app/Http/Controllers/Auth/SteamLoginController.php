<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use kanalumaddela\LaravelSteamLogin\Http\Controllers\AbstractSteamLoginController as SteamLoginHandlerController;
use kanalumaddela\LaravelSteamLogin\SteamUser;
use Ramsey\Uuid\Uuid;

class SteamLoginController extends SteamLoginHandlerController
{
    public function authenticated(Request $request, SteamUser $steamUser){
        // retrive user info
        $steamUser->getUserInfo();

        $admins = [
            76561198068281815, // atlas
        ];

        // avatar url
        $url = $steamUser->avatar;
        // get image
        $contents = file_get_contents($url);
        // hash url
        $name = md5($url).'.jpg';
        $path = 'public/avatars/' . $name;
        // save image
        Storage::put('/'. $path, $contents);

        // find user
        $user = User::where('steam_account_id', $steamUser->accountId)->first();

        // check if user exists
        if (!$user) {
            // create user if they dont
            $user = User::create([
                'name' => $steamUser->name,
                'steam_account_id' => $steamUser->accountId,
                'slug' => $steamUser->steamId,
                'avatar' => $path,
                'registered_ip' => $this->request->ip(),
            ]);

            // check if admins, assign proper roles
            if(in_array($steamUser->steamId, $admins)){
                $user->assignRole('Owner');
            } else {
                $user->assignRole('User');
            }
        }

        // I suggest NOT passing the $remember arg and properly setting up a remember token system. Either be lazy and use $remember or be even lazier and make the session length very long.
        Auth::login($user, true);
    }
}
