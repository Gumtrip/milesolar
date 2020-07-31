<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;
class OrderItem extends Model
{
    protected $fillable = ['product_id','name','price','amount'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
