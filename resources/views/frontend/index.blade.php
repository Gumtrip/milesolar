@extends('frontend.layout.app')

@section('content')
  <section id="banner">
    @foreach($banners as $banner)
      <div class="item">
        <div class="desc">
          <h3 class="title">GO SOLAR,GO GREEN</h3>
          <p class="info">Clean Energy for a Pure World</p>
        </div>
        <div>
          <a href="/" class="bannerImg">
            <img src="{{asset($banner['value'])}}"
                 alt="Power inverter, MPPT controller, off-grid solar system, MILESOLAR">
          </a>
        </div>
      </div>
    @endforeach
  </section>
@endsection

@section('main_content')
  <!--關於我們-->
  <section id="aboutUs">
    <div class="rightBox">
      <div id="imgBox">
        <div id="imgZoom" class="flexPic">
          <img src="{{asset($indexArticle['img'])}}" alt="About Us">
        </div>
      </div>
    </div>

    <div class="leftBox">
      <h3 id="mainTitle" class="text-center mainColor font-weight-bold">About MILESOLAR</h3>
      <div class="txtBox">{!! $indexArticle['desc'] !!}</div>
      <h3 class="mainColor more text-center"><i class="fa fa-arrow-circle-right"></i>Learn more about us</h3>
    </div>
  </section>

  <div class="wrapper">

    <section id="indexCategories">
      <h2 class="text-center mainTitle mainColor font-weight-bold">PRODUCT OFFERED</h2>
      <h3 class="text-center subTitle">Quality hybrid solar inverter, MPPT solar controller, solar flood light, solar
        street light</h3>

      <div class="row">
        @foreach($indexCategories as $category)
          <div class="col-6">
            <a href="{{route('productCategories',[$category,$category->slug])}}" class="cateBox">
              <div class="row">
                <div class="cate_pic flexPic col-6">
                  <img src="{{$category->mid_img}}" alt="{{$category->title}}">
                </div>
                <div class="col-6">
                  <h3 class="cate_title mainColor row">{{$category->title}}</h3>
                  @if(isset($category->brief_list)&&$category->brief_list)
                  <ul>
                    @foreach($category->brief_list as $brief)
                      <li>{{$brief}}</li>
                    @endforeach
                  </ul>
                  @endif
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </section>

    <section id="featureProductsContainer">
      <div id="featureProducts">
        <h3 class="text_center title">FEATURED PRODUCTS</h3>
        <el-row id="featureContainer" :gutter="20">
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

    <!--      首页案例-->
    <section id="indexCasesContainer">
      <div id="indexCase">
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
@endsection
@push('after_styles')@endpush


@push('before_scripts')@endpush


@push('after_scripts')
  <script>
    $('#banner').slick({
      dots: true,
      // autoplay:true,
      speed: 500
    });
  </script>
@endpush
