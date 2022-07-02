<?php

namespace App\Subscription;

use App\Notifications\RepliedToThread;
use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ThreadSubscription extends Model
{
    // the attributes that are not mass assignable
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function reply()
    {
        return $this->belongsTo(Reply::class);
    }

    // send notification to user
    public function notify($reply)
    {
        $this->user->notify(new RepliedToThread($this->thread, $reply));
    }
}
