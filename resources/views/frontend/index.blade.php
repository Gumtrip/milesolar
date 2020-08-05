@extends('frontend.layout.app')

@section('content')
  <section id="banner">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        @foreach($banners as $banner)
          <div class="swiper-slide">
            <a href="/" class="bannerImg">
              <img src="{{asset($banner['value'])}}" alt="Power inverter, MPPT controller, off-grid solar system, MILESOLAR">
            </a>
          </div>
        @endforeach
      </div>
      <!-- Add Arrows -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </section>
  <div class="wrapper">
    <section id="indexCategories">
      <el-row :gutter="20">
        @foreach($indexCategories as $category)
        <el-col :span="6">
          <el-card>
            <a href="{{route('productCategories',[$category,$category->slug])}}" class="cateBox">
              <h3 class="text_center cate_title">{{$category->title}}</h3>
              <div class="cate_pic flexPic">
                <img src="{{$category->mid_img}}" alt="{{$category->title}}">
              </div>
            </a>
            <p class="cateBrief">{{$category->brief}}</p>
          </el-card>
        </el-col>
          @endforeach
      </el-row>
    </section>

    <section id="featureProductsContainer">
      <div id="featureProducts">
        <h3 class="text_center title">FEATURED PRODUCTS</h3>
        <el-row id="featureContainer"  :gutter="20">
          @foreach($indexProducts as $product)
          <el-col :span="6">
            <div class="border-round itemBox">
              <a href="{{route('products.show',[$product,$product->slug])}}">
                <div class="flexPic">
                  <img src="{{$product->main_image}}" alt="">
                </div>
                <h3>{{Str::limit($product->title,50)}}</h3>
              </a>
            </div>
          </el-col>
          @endforeach
        </el-row>
      </div>
    </section>
    <!--關於我們-->
    <section id="aboutUs">
      <div class="rightBox">
        <div  id="imgBox">
          <div id="imgZoom" class="flexPic">
            <img src="{{asset($indexArticle['img'])}}" alt="About Us">
          </div>
        </div>
      </div>

      <div class="leftBox">
        <h3 id="mainTitle">About MILESOLAR</h3>
        <div class="txtBox">{!! $indexArticle['desc'] !!}</div>
        <el-row id="btnGroup">
          @foreach($socialContacts as $contact)
          <el-col :span="8"><a href="{{$contact->value}}"><el-button type="primary">{{$contact->title}}</el-button></a></el-col>
          @endforeach
        </el-row>
      </div>
    </section>

    <!--      首页案例-->
    <section id="indexCasesContainer">
      <div  id="indexCase">
        <h3 class="text_center title">Customer Cases</h3>
        <el-row :gutter="20">
          @foreach($indexSamples as $sample)
          <el-col :span="8">
            <el-card class="item">
              <a href="">
                <div class="flexPic">
                  <img src="{{$sample->mid_img}}" alt="">
                </div>
              </a>
            </el-card>
          </el-col>
          @endforeach
        </el-row>
      </div>
    </section>

    <section id="contactUsInfo" class="mt30">
      @include('frontend.common.error')
      @include('frontend.common.message')
      <el-card>
        <div slot="header" class="clearfix">
          <span class="font_bold">Contact Us</span>
        </div>
        <el-row :gutter="20">
          <el-col :span="12">@include('frontend.contact._form')</el-col>
          <el-col :span="12">
            @include('frontend.contact._info')
          </el-col>
        </el-row>
      </el-card>
      <!--      首页案例-->
    </section>

  </div>
  </div>

@endsection
@section('main_content')

@endsection
@push('after_styles')
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endpush
@push('before_vue_scripts')
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

@endpush
@push('after_vue_scripts')
  <script>
      var mySwiper = new Swiper('.swiper-container', {
          // Optional parameters
          loop:true,
          autoplay: {
              delay: 2500,
              disableOnInteraction: false,
          },
          // Navigation arrows
          navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
          },
      })
  </script>

@endpush
