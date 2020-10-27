@extends('frontend.layout.app')
@section('seo_title', $article->seo_title)
@section('seo_desc', $article->seo_desc)
@section('seo_keywords', $article->seo_keywords)
@section('main_content')
<div class="wrapper inner">
  @include('frontend.common.bread',$breads)
    <h1 id="articleTitle">{{$article->title}}</h1>
    <p id="ex_msg">
      created at:<span>{{$article->create_date}}</span>
    </p>
    <div id="desc" class="description">
      {!! $article->desc !!}
    </div>
</div>
@endsection
