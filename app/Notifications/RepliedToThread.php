<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RepliedToThread extends Notification
{
    use Queueable;

    protected $thread;
    protected $reply;
    /**
     * Create a new notification instance.
     *
     * @param $thread
     * @param $reply
     */
    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'action' => $this->reply->user->name . ' replied to ' . $this->thread->title,
            'path' => config('app.url') . '/forums/' . $this->reply->path()
        ];
    }
}
