<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = [
        'body',
        'user_id',
        'author_id'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
