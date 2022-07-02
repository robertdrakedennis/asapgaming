<?php

namespace App\Services;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use kanalumaddela\LaravelSteamLogin\SteamUser;

class SteamService
{
    private $client;
    private $api_key;

    public function __construct($api_key)
    {
        $this->client = new Client([
            'verify' => true,
            'timeout' => 30,
            'headers' => [
                'User-Agent' => md5(config('app.name'))
            ],
            'base_uri' => 'https://api.steampowered.com/'
        ]);

        $this->api_key = $api_key;
    }

    /**
     * Converts the given `id` to Steam64 format.
     *
     * @param  string $id
     * @return string
     */
    public function idToAID(string $id)
    {
        try{
            $steam = new SteamUser($id);

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
                ['steam_account_id' => $steam->accountId],[
                'name' => $steam->name,
                'steam_account_id' => $steam->accountId,
                'slug' => $steam->steamId,
                'avatar' => $path,
            ]);

            $user->assignRole('User');

            return $user->steam_account_id;
        } catch (\Exception $e){
            alert()->warning('Whoops!', 'You either didn\'t enter a steamid, or that steamid was invalid.');
            return back()->withInput();
        }
    }
}
