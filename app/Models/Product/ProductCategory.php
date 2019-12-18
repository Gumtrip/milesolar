<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ProductCategory extends Model
{
    use NodeTrait;
    protected $fillable=['title','image','seo_title','seo_keywords','seo_desc','order'];
}
