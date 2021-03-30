<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderProceed extends Model
{
    protected $fillable = ['no', 'currency', 'total_amount', 'rmb_total_amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
