<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model{

    use SoftDeletes;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'user_id',
        'body',
        'plaintext'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
