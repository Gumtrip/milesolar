<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderOffer extends Model
{
    protected $fillable = ['client_phone', 'client_info', 'offer_start', 'offer_end', 'term'];

    public function order_offer_items()
    {
        return $this->hasMany(OrderOfferItem::class);
    }
}
