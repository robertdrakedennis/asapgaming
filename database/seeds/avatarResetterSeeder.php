<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class avatarResetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::chunk(1750, function ($users) {
            foreach ($users as $user) {
                try {
                    $steam = new kanalumaddela\LaravelSteamLogin\SteamUser("[U:1:$user->steam_account_id]");

                    $steam->getUserInfo();

                    // avatar url
                    $url = $steam->avatar;
                    // get image
                    $contents = file_get_contents($url);
                    // hash url
                    $name = md5($url) . '.jpg';
                    // path to image
                    $path = 'public/avatars/' . $name;
                    // save image
                    Illuminate\Support\Facades\Storage::put('/' . $path, $contents);

                    $user->name = $steam->name;
                    $user->steam_account_id = $steam->accountId;
                    $user->avatar = $path;

                    $user->save();

                } catch (Exception $e) {

                }
            }
        });

        echo 'done';
    }
}
