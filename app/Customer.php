<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'name',
        'mobile_no',
        'due',
        'address'
    ];
}
