<?php

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class MigratePrometheusUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        $groups = DB::table('transactions')->select('uid', DB::raw('sum(price) as total_spent'))->groupBy('uid')->get();
//
//        $admins = [
//            76561198068281815, // atlas
//        ];
//
//        foreach ($groups as $group){
//            $steam = new SteamUser($group->uid);
//
//            $steam->getUserInfo();
//
//            // avatar url
//            $url = $steam->avatar;
//            // get image
//            $contents = file_get_contents($url);
//            // hash url
//            $name = md5($url).'.jpg';
//            // public path for avi's
//            $path = 'public/avatars/' . $name;
//            // save image
//            Storage::put('/'. $path, $contents);
//
//            if ($group->total_spent > 2921.74){
//                $group->total_spent = 2921.74;
//            }
//
//            $creditPerEuro = 100;
//
//            $total = $group->total_spent * $creditPerEuro;
//
//            $user = User::where('steam_account_id', '=',  $steam->accountId)->firstOrCreate(
//                ['steam_account_id' => $steam->accountId,],[
//                'name' => $steam->name,
//                'steam_account_id' => $steam->accountId,
//                'slug' => $steam->steamId,
//                'avatar' => $path,
//                'credits' => $total,
//                'total_credits' => $total
//            ]);
//
//            if(in_array($group->uid, $admins)){
//                $user->assignRole('Owner');
//            } else {
//                $user->assignRole('User');
//            }
//
//            if($user->total_credits >= 85250){
//                $user->donator_tier = 'tier_3';
//            } elseif ($user->total_credits >= 28750){
//                $user->donator_tier = 'tier_2';
//            } elseif ($user->total_credits >= 11000){
//                $user->donator_tier = 'tier_1';
//            }
//
//            $user->save();
//        }

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
