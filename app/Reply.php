<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Reply extends Model{

    use SoftDeletes;

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

    protected $fillable =[
        'body',
        'plaintext',
        'thread_id',
        'user_id'
    ];

    /**
     * Relationship: Thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Relationship: Parent post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'post_id');
    }

    /**
     * Relationship: Child posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(){
        return $this->hasMany(Reply::class, 'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }
}
