<div>
  <ul id="listBox">
    @foreach($contactInfo as $info)
    <li class="list">
      @if(isset($info['url'])&&$info['url'])
      <a href="{{$info['url']}}">
        <span class="icon"><i class="fa {{$info->desc}}"></i></span>
        <span class="label">{{$info->title}}:</span>
        <span class="info">{{$info->value}}</span>
      </a>
      @else
      <p >
        <span class="icon"><i class="fa {{$info->desc}}"></i></span>
        <span class="label">{{$info->title}}:</span>
        <span class="info">{{$info->value}}</span>
      </p>
        @endif
    </li>
    @endforeach
  </ul>
</div>
