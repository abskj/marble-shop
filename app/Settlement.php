<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    //
    protected $fillable = [
        'bill_id',
        'paid',
        'due',
        'settle_mode',
        'status_flag',
        'card_number',
        'bank'
    ];
}
