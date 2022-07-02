<?php

namespace App\Http\Controllers;

use App\Players;
use App\User;
use Illuminate\Support\Facades\Cache;
use xPaw\SourceQuery\SourceQuery;

class IndexController extends Controller
{
    public function index(){
        $cachedDiscord = Cache::remember('cached_discord',  now()->addMinutes(30), function(){
            $discordServer = \file_get_contents('https://discordapp.com/api/servers/311942245899173888/widget.json');
            $discord = \json_decode($discordServer);
            return $discord;
        });

        $servers = Cache::remember('servers', now()->addMinutes(30), function (){
            $servers = [];
            $query = new SourceQuery();
            $gameServers = [
                [
                    'ip' => '208.103.169.207',
                    'port' => '27015',
                    'gametracker' => 'https://www.gametracker.com/server_info/208.103.169.207:27015/'
                ],
                [
                    'ip' => '208.103.169.207',
                    'port' => '27016',
                    'gametracker' => 'https://www.gametracker.com/server_info/208.103.169.207:27016/'
                ]
            ];

            foreach ($gameServers as $gameServer){
                try{
                    $query->Connect($gameServer['ip'], $gameServer['port'], 3, SourceQuery::SOURCE);
                    $servers[] = [
                        'server' => $query->GetInfo(),
                        'info' => $gameServer
                    ];
                } catch (\Exception $e){
                    $servers[] = [
                        'server' =>  null,
                        'info' =>  null
                    ];
                }
                finally {
                    $query->disconnect();
                }
            }
            return $servers;
        });


        $getServers = \array_column($servers, 'server');
        $getPlayers = \array_column($getServers, 'Players');
        $onlinePlayers = \array_sum($getPlayers);


        $players = Cache::remember('cached_players',  now()->addMinutes(200), function (){
            try {
                $dbPlayers = Players::whereRaw('CHAR_LENGTH(uid) = 17')
                        ->orderBy('wallet', 'desc')
                        ->count() + 360000;
                return  $dbPlayers;
            } catch (\Exception $exception)
            {
                $dbPlayers = null;

                return $dbPlayers;
            }
        });

        $signUps = Cache::remember('cached_signed_up_players',  now()->addMinutes(200), function (){
            $users = User::all()->count();
            return $users;
        });

        return view('main.index', compact('cachedDiscord', 'getPlayers', 'getPlayers', 'onlinePlayers', 'players', 'signUps', 'servers' ));
    }
}
