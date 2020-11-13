@extends(cusView('layout.app'))
@section('seo_title', $product->seo_title)
@section('seo_desc', $product->seo_desc)
@section('seo_keywords', $product->seo_keywords)
@section('main_content')
  <div class="wrapper inner">
    @include(cusView('common.bread'),$breads)
    <div id="productDetail">
      <section id="picGallery">
        <div class="slick-for gallery-top">
          @foreach($product->mid_image_group as $img)
            <div class="picBox text-center">
              <img src="{{$img}}" alt="{{$product->title}}">
            </div>
          @endforeach
        </div>
        <div class="slick-nav gallery-thumbs">
          @foreach($product->mid_image_group as $img)
            <div class="thumbImg">
              <img src="{{$img}}" alt="{{$product->title}}">
            </div>
          @endforeach
        </div>
      </section>
      <section id="proInfo">
        <h1 class="proTitle">{{$product->title}}</h1>
        <p class="desc">{{$product->brief}}</p>
        <div class="BtnContainer">
          <a href="{{route('contact',[$product,$product->slug])}}">
            <button class="btn btn-primary" id="inquiryBtn">Inquiry</button>
          </a>
        </div>
      </section>
    </div>
    <section id="productInfo">
      <ul class="nav nav-tabs titles">
        <li class="nav-item">
          <a class="nav-link active" href="#Feature" data-toggle="list">Feature</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Specification" data-toggle="list">Specification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#Application" data-toggle="list">Application</a>
        </li>
      </ul>
      <div class="contentContainer tab-content">
        <div class="tab-pane fade show active" id="Feature">
          {!! optional($product->info_group)['info_0_m'] !!}
        </div>
        <div class="tab-pane fade" id="Specification">
          {!! optional($product->info_group)['info_1_m']  !!}
        </div>
        <div class="tab-pane fade" id="Application">
          {!! optional($product->info_group)['info_2_m']  !!}
        </div>
      </div>
    </section>
  </div>
@endsection
@push('after_styles')
@endpush

@push('after_scripts')
  <script>
    $('.slick-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slick-nav'
    });
    $('.slick-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.slick-for',
      centerMode: true,
      focusOnSelect: true
    });
  </script>
@endpush
