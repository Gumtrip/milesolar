@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
    <div  class="alert alert-{{$msg}} mt10">{{ session()->get($msg) }}</div>
  @endif
@endforeach
