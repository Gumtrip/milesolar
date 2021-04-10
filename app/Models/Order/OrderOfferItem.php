<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderOfferItem extends Model
{
    protected $fillable = ['amount', 'unit', 'currency', 'unit_price', 'title', 'img', 'desc'];

    public function order_offer()
    {
        return $this->belongsTo(OrderOffer::class);
    }
}
