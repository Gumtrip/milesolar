@extends(cusView('layout.app'))
@section('seo_title', isset($product)?$product->seo_title:null)
@section('seo_desc', isset($product)?$product->seo_desc:null)
@section('seo_keywords', isset($product)?$product->seo_keywords:null)
@section('main_content')
<div class="wrapper inner">
  @include(cusView('common.bread'),$breads)
  <div id="productsBox">
    <section class="right">
      <h3 id="rightBoxTitle">Products</h3>
      <ul id="contentBox" class="list-unstyled">
        @foreach($products as $product)
        <li class="item">
          <a href="{{route('products.show',[$product,$product->slug])}}">
            <div class="flexPic pic">
              <img src="{{$product->main_image}}" alt="{{$product->title}}">
            </div>
            <h5 class="title">{{$product->title}}</h5>
          </a>
        </li>
        @endforeach
      </ul>
      {{$products->links()}}
    </section>
    <section id="filter" class="left">
      <div id="proCate" class="popModal trans">
        <div id="allProducts">
          <a href="{{route('products')}}">
            <div class="btn btn-primary">All PRODUCTS</div>
          </a>
        </div>
        <ul class="list-unstyled">
          @foreach($categories as $cate)
            <li class="firstCate {{isset($productCategory)&&($productCategory->id==$cate->id||$productCategory->parent_id==$cate->id)?'cur':''}}">
              <a href="{{route('productCategories',[$cate,$cate->slug])}}">{{Str::limit($cate->title,30)}}</a>
              @if(isset($cate['children'])&&$cate['children'])
                <i class="fa fa-plus-square"></i>
                <i class="fa fa-minus-square"></i>
                <div class="secCate">
                  @foreach($cate['children'] as $sec)
                    <a href="{{route('productCategories',[$sec,$sec->slug])}}" class="{{isset($productCategory)&&$productCategory->id==$sec->id?'cur':''}}">{{$sec->title}}</a>
                  @endforeach
                </div>
              @endif
            </li>
          @endforeach
        </ul>
      </div>
    </section>
  </div>
</div>
@endsection
@push('after_scripts')
  <script>
    $(document).ready(function(){
      $('.firstCate .fa-plus-square').click(function(){
        const target = $(this).siblings('.secCate')
        const cate = $(this).parent('.firstCate')
        target.slideDown(function(){
          cate.addClass('cur')
        })
      })

      $('.firstCate .fa-minus-square').click(function(){
        const target = $(this).siblings('.secCate')
        const cate = $(this).parent('.firstCate')
        target.slideUp(function(){
          cate.removeClass('cur')
        })
      })
    })
  </script>
@endpush
