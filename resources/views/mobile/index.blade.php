@extends(cusView('layout.app'))
@section('seo_title', isset($seoData['seo_title'])?$seoData['seo_title']:null)
@section('seo_keywords', isset($seoData['seo_keywords'])?$seoData['seo_keywords']:null)
@section('seo_desc', isset($seoData['seo_desc'])?$seoData['seo_desc']:null)

@section('content')
  <section id="banner">
    @foreach($banners as $banner)
      <div class="item">
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
  <section class="card" id="aboutUs">
    <div class="card-body">
      <div class="rightBox mb-2">
        <div id="imgBox">
          <div id="imgZoom" class="flexPic">
            <img src="{{asset($indexArticle['img'])}}" alt="About Us">
          </div>
        </div>
      </div>
      <div class="leftBox">
        <h3 id="mainTitle" class="text-center mainColor font-weight-bold">About MILESOLAR</h3>
        <div class="txtBox">{!! $indexArticle['desc'] !!}</div>
        <h3 class="mainColor more text-center"><i class="fa fa-arrow-circle-right"></i>Learn more</h3>
      </div>
    </div>
  </section>

  <div class="wrapper">
    <section id="indexCategories">
      <h2 class="text-center mainTitle mainColor font-weight-bold">PRODUCT OFFERED</h2>
      <h3 class="text-center subTitle">Quality hybrid solar inverter, MPPT solar controller, solar flood light, solar
        street light</h3>

      @foreach($indexCategories as $category)
        <a href="{{route('productCategories',[$category,$category->slug])}}" class="cateBox row">
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
            <div class="more mainColor">
              <i class="fa fa-arrow-circle-right"></i>Learn more
            </div>
          </div>
        </a>
      @endforeach
    </section>

    <!--      首页案例-->
    <section id="indexCasesContainer">
      <div id="indexCase">
        <h3 class="text_center mainTitle mainColor mb-1">PROJECT CASES</h3>
        <h4 class="text-center subTitle mb-2">Quality hybrid solar inverter, MPPT solar controller, solar flood light,
          solar street light</h4>
        <div class="card">
          @foreach($indexSamples as $sample)
            <div class="card-body item">
              <a href="{{route('samples.show',[$sample,$sample->slug])}}">
                <div class="flexPic">
                  <img src="{{$sample->mid_img}}" alt="{{$sample->title}}">
                </div>
                <h5 class="desc">{{$sample->title}}</h5>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    {{--联系我们--}}
    <section id="contactUsInfo" class="mt30">
      @include(cusView('common.message'))
      @include(cusView('common.error'))
      <div class="card">
        <div class="card-body">
          <h3 class="card-title mainColor text-center">Contact Us</h3>
          <h3 class="text-center mainColor mt10">SOLAR KNOWELEDGE</h3>
          <p>MILESOLAR, located in Fosha, China, mainly manufacture and provide solar inverter, solar controller,
            solar generator and solar lights. With 10 years of solar industry experience, MILE SOLAR is a
            trustworthy solar company which helps get your right solar products and boost solartogether</p>
          @include(cusView('contact._form'),['redirect'=>route('index').'#contactUsInfo','action'=>route('index.msgHandle')])
        </div>
      </div>
    </section>
  </div>
@endsection
@push('after_styles')@endpush


@push('before_scripts')@endpush


@push('after_scripts')
  <script>
    $('#banner').slick({
      dots: true,
      autoplay:true,
      speed: 500
    });
  </script>
@endpush
