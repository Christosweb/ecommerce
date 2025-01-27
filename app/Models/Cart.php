<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
        'stripe_price_id',
        'quantity',
        'path',
        'stripe_product_id',
        'session_id',
    ];
}
