<?php


namespace App\Http\Controllers\Frontend\Product;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
class ProductController extends Controller
{
    public function index(Request $request){
        $title = $request->title;
        $products = Product::when($title,function($query) use ($title){
            return $query->where('title','like','%'.$title.'%');
        })->paginate(config('app.page_size'));
        $categories = ProductCategory::get()->toTree();
        $breads = [['title'=>'products','url'=>route('products')]];
        return view('frontend.product.index')->with(compact('products','categories','breads'));
    }
    public function show(Request $request,Product $product){
        $breads = [
            ['title'=>'products','url'=>route('products')],
            ['title'=>$product->title,'url'=>route('products.show',[$product,$product->slug])],
        ];
        return view('frontend.product.show')->with(compact('product','breads'));

    }
}
