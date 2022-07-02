<?php

namespace App;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use App\Comment;


class User extends Authenticatable
{
    use  Authorizable, HasRoles, Notifiable;

    public function getRouteKeyName(){
        return 'slug';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'background',
        'post_background',
        'steam_account_id',
        'post_count',
        'avatar',
        'about',
        'credits',
        'color',
        'donator_rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
