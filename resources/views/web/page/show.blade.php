@extends(cusView('layout.app'))
@section('seo_title', $page->seo_title)
@section('seo_desc', $page->seo_desc)
@section('seo_keywords', $page->seo_keywords)
@section('main_content')
    <div class="wrapper inner">
        @include(cusView('common.bread'),$breads)
        <div class="flexPic">
            <img src="{{$page->image}}"/>
        </div>
        <h1 id="articleTitle" class="mb-2">{{$page->title}}</h1>
        <div class="row mb-2">
            <div class="col-6">{!! nl2br($page->brief) !!}</div>
            <div class="col-6">
                <section id="picGallery">
                    <div class="slick-for gallery-top">
                        @foreach($page->mid_image_group as $img)
                            <div class="picBox text-center">
                                <img src="{{$img}}" alt="{{$page->title}}">
                            </div>
                        @endforeach
                    </div>
                    <div class="slick-nav gallery-thumbs">
                        @foreach($page->mid_image_group as $img)
                            <div class="thumbImg">
                                <img src="{{$img}}" alt="{{$page->title}}">
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
        <div id="desc" class="description">
            {!! $page->content !!}
        </div>
    </div>
@endsection
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