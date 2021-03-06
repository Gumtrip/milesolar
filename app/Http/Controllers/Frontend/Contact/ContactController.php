<?php


namespace App\Http\Controllers\Frontend\Contact;

use App\Events\ReceiveMsg;
use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product\Product;
use App\Http\Requests\Frontend\Message\MessageRequest;
class ContactController extends Controller
{
    public function index(Request $request,Product $product){
        $breads = [['title'=>'contact','url'=>route('contact')]];
        $redirect = $product?route('contact',[$product,$product->slug]):route('contact');
        $redirect.='#inquiryBox';
        return view(cusView('contact.index'),compact('product','breads','redirect'));
    }

    /** 询盘存储
     * @param MessageRequest $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(MessageRequest $request,Message $message){
        $product = Product::find($request->product_id);
        $ip = $request->getClientIp();
        $message->fill(array_merge([
            'ip'=>$ip,
            'product_info'=>$product
        ],$request->all()));
        $message->save();
        $redirect = $product?route('contact',[$product,$product->slug]):route('contact');
        $redirect.='#inquiryBox';
        event(new ReceiveMsg($message));
        return redirect($redirect)->with('success','Thanks for your inquiry, we will reply you within 24 hours.');
    }
}
