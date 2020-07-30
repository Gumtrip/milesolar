<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['product_id','name','price','amount'];
}
