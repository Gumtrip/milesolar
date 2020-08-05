<div>
    <ul id="breadCrumb">
        <li><a href="{{route('index')}}">Home <span>&nbsp; &gt;&nbsp;</span></a></li>
      @foreach($breads as $key=>$bread)
        <li>
            <a href="{{$bread['url']}}">{{$bread['title']}}</a>
          @if(($key+1)<count($breads))
            <span>&nbsp; &gt;&nbsp;</span>
          @endif
        </li>
      @endforeach
    </ul>
</div>
