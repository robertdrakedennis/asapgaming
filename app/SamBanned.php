<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SamBanned extends Model
{
    protected $connection ='samdatabase';

    protected $table ='banned';
}
