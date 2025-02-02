<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'quantity',
        'status',
        'total_amount',
        'session_id',
        'order_identification'
    ];

    //remember to define relationship
}
