<?php

namespace App\Http\Controllers;

use App\Players;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index(){
        $totalAmount = Cache::remember('total_amount',  now()->addMinutes(10), function(){
            $amount = Players::whereRaw('CHAR_LENGTH(uid) = 17')
                ->orderBy('wallet', 'desc')
                ->sum('wallet');
            return $amount;
        });

        $totalPlayers = Cache::remember('cached_players',  now()->addMinutes(10), function (){
            $dbPlayers = Players::whereRaw('CHAR_LENGTH(uid) = 17')
                    ->orderBy('wallet', 'desc')
                    ->count() + 360000;
            return  $dbPlayers;
        });

        $leaderboardsPaginated = Players::whereRaw('CHAR_LENGTH(uid) = 17')
            ->orderBy('wallet', 'desc')
            ->simplePaginate(15);

        return view('main.users.leaderboards.index', compact('totalAmount', 'totalPlayers', 'leaderboardsPaginated'));
    }

    public function time(){

        $times = DB::table('tooltimes_playtimes')->orderBy('time', 'DESC')->paginate(15);

        $totalPlayTime = DB::table('tooltimes_playtimes')->sum('time');

        return view('main.users.leaderboards.time', compact('times', 'totalPlayTime'));


    }
}
