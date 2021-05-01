<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderProceed extends Model
{
    protected $fillable = ['currency', 'exchange_rate', 'paid_at', 'total_amount', 'image', 'rmb_total_amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
