<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable=['title','seo_title','seo_keywords','seo_desc','order'];
}
