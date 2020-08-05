@extends('frontend.layout.app')
@section('title', $product->seo_title)
@section('seo_desc', $product->seo_desc)
@section('seo_keywords', $product->seo_keywords)
@section('main_content')
<div class="wrapper inner">
  @include('frontend.common.bread',$breads)
  <div id="productDetail">
    <section id="picGallery">
      <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
          @foreach($product->mid_image_group as $img)
            <div class="swiper-slide">
              <div class="picBox">
                <img src="{{$img}}" alt="{{$product->title}}">
              </div>
            </div>
          @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
      <div class="swiper-container gallery-thumbs">
        <div class="swiper-wrapper">
          @foreach($product->mid_image_group as $img)
            <div class="swiper-slide thumbImgContainer">
              <div class="thumbImg">
                <img src="{{$img}}" alt="{{$product->title}}">
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <section id="proInfo">
      <h1 class="proTitle">{{$product->title}}</h1>
      <p class="desc">{{$product->brief}}</p>
      <div class="BtnContainer">
        <a href="{{route('contact',[$product,$product->slug])}}">
          <el-button id="inquiryBtn" size="medium" type="primary">Inquiry</el-button>
        </a>
      </div>
    </section>
  </div>
  <section>
    <el-tabs value="info_0_m" class="contentContainer">
      <el-tab-pane class="tabTitle" label="Feature" name="info_0_m">
        <div class="description">{!! optional($product->info_group)['info_0_m'] !!}</div>
      </el-tab-pane>
      <el-tab-pane class="tabTitle" label="Specification" name="info_1_m">
        <div class="description">{!! optional($product->info_group)['info_1_m']  !!}</div>
      </el-tab-pane>
      <el-tab-pane class="tabTitle" label="Application" name="info_2_m">
        <div class="description">{!! optional($product->info_group)['info_2_m']  !!}</div>
      </el-tab-pane>
    </el-tabs>
  </section>
</div>
@endsection
@push('after_styles')
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endpush
@push('before_vue_scripts')
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush
@push('after_vue_scripts')
  <script>
      var galleryThumbs = new Swiper('.gallery-thumbs', {
          spaceBetween: 10,
          slidesPerView: 4,
          freeMode: true,
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
      });
      var galleryTop = new Swiper('.gallery-top', {
          spaceBetween: 10,
          loop:true,
          autoplay: {
              delay: 2500,
              disableOnInteraction: false,
          },
          navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
          },
          thumbs: {
              swiper: galleryThumbs
          }
      });
  </script>
@endpush
