<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function read(User $user, DatabaseNotification $notification){

        $notification->markAsRead();

        return redirect($notification->data['path']);
    }
}
