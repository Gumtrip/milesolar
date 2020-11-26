<?php


namespace App\Http\Controllers\Frontend;
use App\Events\ReceiveMsg;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Message\MessageRequest;
use App\Models\Message\Message;
use App\Models\Setting\Setting;
use App\Models\Product\ProductCategory;
use App\Models\Product\Product;
use App\Models\Sample\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index(Request $request){
        //banners
        $banners = Setting::where('category_id',1)->get();
        $indexCategories = ProductCategory::cusOrder('order')->take(8)->get();
        $indexProducts = Product::where('is_index',1)->orderBy('order')->take(8)->get();
        $indexSamples = Sample::where('is_index',1)->orderBy('order')->take(3)->get();
        //首页公司介绍
        $article = Setting::where('category_id',3)->get();
        $indexArticle = [
            'img'=>$article[0]->value,
            'desc'=>$article[1]->value
        ];
        $indexSeo = Setting::where('category_id',5)->get();
        $seoData = [
            'seo_title'=>$indexSeo->where('title','seo标题')->first()->value,
            'seo_keywords'=>$indexSeo->where('title','主页keywords')->first()->value,
            'seo_desc'=>$indexSeo->where('title','主页description')->first()->value,
        ];
        $socialContacts  = Setting::where('category_id',4)->get();
        $redirect = route('index').'#contactUsInfo';
        return view(cusView('index'),compact('banners','indexCategories','indexProducts','indexSamples','indexArticle','socialContacts','seoData','redirect'));
    }

    /** 询盘处理
     * @param MessageRequest $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function msgHandle(MessageRequest $request,Message $message){
        $ip = $request->getClientIp();
        $message->fill(array_merge(['ip'=>$ip,],$request->all()))->save();
        $redirect = route('index').'#contactUsInfo';
        event(new ReceiveMsg($message));
        return redirect($redirect)->with('success','Thanks for your inquiry, we will reply you within 24 hours.');
    }
}
