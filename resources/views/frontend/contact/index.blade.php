@extends('frontend.layout.app')
@section('title', 'Page Title')
@section('seo_desc', 'Page Title')
@section('seo_keywords', 'Page Title')
@section('main_content')
  <div id="MsgBox" class="wrapper">
    @include('frontend.common.bread',$breads)
    <div id="contactInfo" class="card">
      <div class="card-body" >
        <div class="card-header">
          <span class="contactInfoTitle">Contact Info</span>
        </div>
        <div class="card-body">
          @include('frontend.contact._info')
        </div>
      </div>
    </div>
    <el-card id="inquiryBox">
      <div slot="header">
        <h2 class="text_center boxTitle">Message</h2>
      </div>
      <h3 class="text_center boxSubTitle">If You Have Any Suggestions or Question For Us.Please Contact Us.</h3>
      @include('frontend.common.error')
      @include('frontend.common.message')
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
        @include('frontend.contact._form',['more'=>1,'product_id'=>$product->id,'redirect'=>route('contact',[$product,$product->slug])])
      </div>
    </el-card>

  </div>
@endsection
