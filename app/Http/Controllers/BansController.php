<?php

namespace App\Http\Controllers;

use App\User;
use App\SamBanned;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class BansController extends Controller
{
    public function index(){
        $totalBans = SamBanned::all()->count();

        if (\request('query') != null){
            $bannedUsers = SamBanned::where('steamid', 'LIKE', '%' . \request('query') . '%')->where('unban_date', '<', Carbon::today()->addYear(2)->timestamp)->paginate(15);
        } else {
            $bannedUsers = SamBanned::where('unban_date', '<', Carbon::now()->addYear(2)->timestamp)->paginate(15);
        }




//        dd($bannedUsers);
//
          $user = SamBanned::first();
          $now = Carbon::today();

          //dd($now);
          //dd(\Carbon\Carbon::createFromTimestamp($user->unban_date)->timestamp > $now);
//
//
//        dd($now);

//        if ($banDate->gt($now)){
//            dd('in the future');
//        };
//
        return view('main.users.bans.index', compact('bannedUsers', 'totalBans', 'now'));
    }
}
