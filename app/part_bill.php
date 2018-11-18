<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class part_bill extends Model
{
    //
    protected $fillable = [
        'bill_id',
        'product_id',
        'quantity',
        'price',
    ];
}
