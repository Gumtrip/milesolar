<?php


namespace App\Http\Controllers\Frontend\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;



class ProductCategoryController extends Controller
{
    public function index(Request $request,ProductCategory $productCategory){
        $products = Product::when($productCategory,function($query) use ($productCategory){
            return $query->categoryId($productCategory->id);
        })->paginate(config('app.page_size'));
        $categories = ProductCategory::get()->toTree();
        $breads = [['title'=>'products','url'=>route('products')],
            ['title'=>$productCategory->title,'url'=>route('productCategories',$productCategory)]
        ];

        return view('frontend.product.index')->with(compact('products','categories','productCategory','breads'));

    }
}
