<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class OrderOfferItem extends Model
{
    protected $fillable = ['amount', 'unit', 'price', 'title', 'img', 'remark', 'attrs'];

    protected $casts = ['attrs' => 'array'];

    public function order_offer()
    {
        return $this->belongsTo(OrderOffer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
