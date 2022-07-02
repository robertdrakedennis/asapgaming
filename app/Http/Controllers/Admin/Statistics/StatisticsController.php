<?php

namespace App\Http\Controllers\Admin\Statistics;

use App\Http\Resources\User;
use App\Players;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function site(){
        $registeredUsers = User::count();

        $players = Players::whereRaw('CHAR_LENGTH(uid) = 17')
            ->orderBy('wallet', 'desc')
            ->count();
    }

    public function economy(){
        $amount = Players::whereRaw('CHAR_LENGTH(uid) = 17')
            ->orderBy('wallet', 'desc')
            ->sum('wallet');

        $leaderboardsPaginated = Players::whereRaw('CHAR_LENGTH(uid) = 17')
            ->orderBy('wallet', 'desc')
            ->simplePaginate(15);
    }

    public function gangs(){

    }
}
