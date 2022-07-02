<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property mixed isLocked
 */
class Category extends Model{

    protected $fillable = [
        'title',
        'description',
        'color',
        'fontawesome',
        'background',
        'thread_count',
        'reply_count',
        'weight',
        'isLocked',
        'parent_id',
        'slug',
        'isPrivate'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isLocked' => 'boolean',
        'isPrivate' => 'boolean'
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function scopeRoot($query){
        if (Auth::guest()){
            return $query->whereNull('parent_id')->where('isPrivate', '=', 0);
        }

        if (Auth::user()->hasAnyRole(['Owner', 'Administrator', 'Moderator'])){
            return $query->whereNull('parent_id');
        } else {
            return $query->whereNull('parent_id')->where('isPrivate', '=', 0);
        }
    }

    /**
     * Relationship: Parent category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id')->orderBy('weight');
    }

    /**
     * Relationship: Child categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(){
        return $this->hasMany(Category::class, 'parent_id')->orderBy('weight');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads(){
        return $this->hasMany(Thread::class);
    }

    public function latestThread(){
        return $this->hasOne(Thread::class)->latest();
    }

}
