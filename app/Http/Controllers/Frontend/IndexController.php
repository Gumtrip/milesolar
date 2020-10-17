<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use App\Models\Product\ProductCategory;
use App\Models\Product\Product;
use App\Models\Sample\Sample;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){
        //banners
        $banners = Setting::where('category_id',1)->get();
        $indexCategories = ProductCategory::orderBy('order')->take(4)->get();
        $indexProducts = Product::where('is_index',1)->orderBy('order')->take(8)->get();
        $indexSamples = Sample::where('is_index',1)->orderBy('order')->take(3)->get();
        //首页公司介绍
        $article = Setting::where('category_id',3)->get();
        $indexArticle = [
            'img'=>$article[0]->value,
            'desc'=>$article[1]->value
        ];

        $socialContacts  = Setting::where('category_id',4)->get();

        return view('frontend.index',compact('banners','indexCategories','indexProducts','indexSamples','indexArticle','socialContacts'));
    }
}