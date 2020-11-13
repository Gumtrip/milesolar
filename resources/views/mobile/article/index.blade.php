@extends(cusView('layout.app'))
@section('seo_title', $article->seo_title)
@section('seo_desc', $article->seo_desc)
@section('seo_keywords', $article->seo_keywords)

@section('main_content')
<div class="wrapper">
  @include(cusView('common.bread'),$breads)
    <section id="articleBox">
      <ul class="list-unstyled">
        @foreach($articles as $article)
        <li class="article">
          <a href="{{route('articles.show',[$article,$article->slug])}}">
            <div class="img flexPic">
              <img src="{{$article->sm_img}}" alt="{{$article->title}}">
            </div>
            <div class="info">
              <h3 class="title">{{$article->tilte}}</h3>
              <p class="time">{{$article->create_date}}</p>
              <p class="desc">{{$article->intro}}</p>
            </div>
          </a>
        </li>
          @endforeach
      </ul>
      {{$articles->links()}}
    </section>
</div>
@endsection
