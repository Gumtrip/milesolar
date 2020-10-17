<?php


namespace App\Http\Controllers\Frontend\Contact;

use App\Events\ReceiveMsg;
use App\Http\Controllers\Controller;
use App\Models\Message\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product\Product;
class ContactController extends Controller
{
    public function index(Request $request,Product $product){
        $breads = [['title'=>'contact','url'=>route('contact')]];
        return view('frontend.contact.index')->with(compact('product','breads'));
    }

    public function store(Request $request,Message $message){
        //todo 首页和联系我们页面的提交处理接口不要公用，应该封装成一个service
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'name'=>'required',
            'msg'=>'required'
        ]);
        $redirect = $request->redirect?$request->redirect:route('index');
        $redirect.= '#contact_form';
        if ($validator->fails()) {
            return redirect($redirect)
                ->withErrors($validator)
                ->withInput();
        }
        $product = Product::find($request->product_id);
        $ip = $request->getClientIp();
        $message->fill(array_merge([
            'ip'=>$ip,
            'product_info'=>$product
        ],$request->all()));
        $message->save();
        event(new ReceiveMsg($message));
        return redirect($redirect)->with('success','Thanks For Your Message!');
    }
}
