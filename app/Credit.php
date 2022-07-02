<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model{
    protected $fillable = [
        'name',
        'amount',
        'bonus_amount',
        'price'
    ];
}
