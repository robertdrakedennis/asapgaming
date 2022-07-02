<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class FixAvatarsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $users = \App\User::all();

        try{
            foreach ($users as $user) {
                $steam = new SteamUser("[U:1:$user->steam_account_id]");

                $steam->getUserInfo();

                // avatar url
                $url = $steam->avatar;
                // get image
                $contents = file_get_contents($url);
                // hash url
                $name = md5($url).'.jpg';
                // path to image
                $path = 'public/avatars/' . $name;
                // save image
                Storage::put('/'. $path, $contents);

                $user->name = $steam->name;
                $user->steam_account_id = $steam->accountId;
                $user->avatar = $path;

                $user->save();
            }
        } catch (Exception $exception){

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
