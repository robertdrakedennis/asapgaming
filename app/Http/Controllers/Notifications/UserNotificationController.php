<?php

namespace App\Http\Controllers\Notifications;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {

        $notifications = $user->notifications()->paginate(10);

        return view('main.users.notifications', compact('user', 'notifications'));

    }


    public function markAllAsRead(User $user)
    {
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        return redirect()->route('users.notifs');
    }
}
