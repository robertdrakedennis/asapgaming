<?php

namespace App;

use App\Notifications\RepliedToThread;
use App\Subscription\ThreadSubscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model{

    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isLocked' => 'boolean',
        'isPinned' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'body',
        'plaintext',
        'category_id',
        'user_id',
        'color',
        'reply_count',
        'image',
        'isPinned',
        'isLocked',
        'slug'
    ];

    public function getRouteKeyName(){
        return 'slug';
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function latestReply(){
        return $this->hasOne(Reply::class)->latest();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return "{$this->category->slug}/{$this->slug}";
    }


    public function addReply($reply)
    {
        // create and save the reply
        $reply = $this->replies()->create($reply);

        $this->subscriptions->where('user_id', '!=', $reply->user_id)->each->notify($reply);

        return $reply;
    }



    // a thread can have many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    // Determine if current user is subscribed to a thread
    // 'custom eloquent accessor'
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
        return $this;
    }
}
