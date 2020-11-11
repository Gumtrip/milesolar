@extends(cusView('layout.app'))
@section('main_content')
<div class="wrapper">
  @include(cusView('common.bread'),$breads)
    <section id="sampleBox">
      <ul class="list-unstyled">
        @foreach($samples as $sample)
        <li class="sample">
          <a href="{{route('samples.show',[$sample,$sample->slug])}}">
            <div class="img flexPic">
              <img src="{{$sample->sm_img}}" alt="{{$sample->title}}">
            </div>
            <div class="info">
              <h3 class="title">{{$sample->tilte}}</h3>
              <p class="time">{{$sample->create_date}}</p>
              <p class="desc">{{$sample->intro}}</p>
            </div>
          </a>
        </li>
          @endforeach
      </ul>
      {{$samples->links()}}
    </section>
</div>
@endsection
