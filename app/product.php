<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'company',
        'type',
        'img_url',
        'type'
    ];

}
