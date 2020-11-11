@extends(cusView('layout.app'))
@section('seo_title', 'Page Title')
@section('seo_desc', 'Page Title')
@section('seo_keywords', 'Page Title')
@section('main_content')
  <div id="MsgBox" class="wrapper">
    @include(cusView('common.bread'),$breads)
    <div id="contactInfo" class="card">
      <div class="card-body" >
        <div class="card-header">
          <span class="contactInfoTitle">Contact Info</span>
        </div>
        <div class="card-body">
          @include(cusView('contact._info'))
        </div>
      </div>
    </div>
    <div id="inquiryBox">
      <div slot="header">
        <h2 class="text_center boxTitle">Message</h2>
      </div>
      <h3 class="text_center boxSubTitle">If You Have Any Suggestions or Question For Us.Please Contact Us.</h3>
      @include(cusView('common.error'))
      @include(cusView('common.message'))
      <div id="productBox" class="{{$product->id?'half':''}}">
        @if($product->id)
        <section id="productInfo">
          <div id="product">
            <div class="desc">
              <h3 class="title">{{$product->title}}</h3>
              <p>{{$product->brief}}</p>
            </div>
            <div class="flexPic">
              <img src="{{$product->main_image}}" alt="{{$product->title}}">
            </div>
          </div>
        </section>
        @endif
        @include(cusView('contact._form'),['more'=>1,'product_id'=>$product->id,'redirect'=>route('contact',[$product,$product->slug])])
      </div>
    </div>

  </div>
@endsection
