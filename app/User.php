<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class user extends Authenticatable
{
    //
    protected $fillable = [
        'user_name',
        'password',
        'first_name',
        'last_name',
        'type',
        
    ];
}
