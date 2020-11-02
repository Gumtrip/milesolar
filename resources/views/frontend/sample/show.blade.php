@extends('frontend.layout.app')
@section('seo_title', $sample->seo_title)
@section('seo_desc', $sample->seo_desc)
@section('seo_keywords', $sample->seo_keywords)
@section('main_content')
<div class="wrapper inner">
  @include('frontend.common.bread',$breads)
    <h1 id="sampleTitle">{{$sample->title}}</h1>
    <p id="ex_msg">
      created at:<span>{{$sample->create_date}}</span>
    </p>
    <div id="desc" class="description">
      {!! $sample->desc !!}
    </div>
</div>
@endsection
