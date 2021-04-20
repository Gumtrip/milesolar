<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    //这个默认的表名字有个问题
    //如果使用sync ，$product->properties()->sync($propertyIds) 的方法同步 id ，则表名字是不能复数的
    //但是如果将所有逻辑都放在ProductController 里面，这个控制器会很臃肿
    protected $table = 'product_property';

    protected $fillable = ['order'];

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function property()
    {
        return $this->belongsTo(Property::class);
    }
}
