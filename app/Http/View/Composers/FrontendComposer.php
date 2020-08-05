<?php


namespace App\Http\View\Composers;
use Illuminate\View\View;
use App\Models\Setting\Setting;
use App\Models\Product\ProductCategory;
use App\Models\Article\Article;
class FrontendComposer
{
    public function compose(View $view)
    {
        $contactInfo = Setting::where('category_id',2)->get();
        $view->with('contactInfo',$contactInfo);//联系方式
        $view->with('navList', [
            ['title'=>'Home','url'=>route('index')],
            ['title'=>'Product','url'=>route('products')],
            ['title'=>'About Us','url'=>route('articles.show',1)],
            ['title'=>'Cases','url'=>route('samples')],
            ['title'=>'Contact','url'=>route('contact')],
        ]);//导航
        //脚部
        $footerCategories = ProductCategory::withDepth()->having('depth',1)->orderBy('order')->take(4)->get();
        $footerArticles = Article::where('category_id',2)->orderBy('order')->get();
        $view->with('footerCategories',$footerCategories);//联系方式
        $view->with('footerArticles',$footerArticles);//About Us
    }
}
