<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $primaryKey='id';

    protected $fillable = [
        'total',
        'discount',
        'final',
        'amount_paid',
        'amount_due',
        'cust_id',
        'id',
    ];
}
