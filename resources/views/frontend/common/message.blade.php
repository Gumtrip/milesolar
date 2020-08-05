@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
    <el-alert class="mt10" type="{{$msg}}" title="{{ session()->get($msg) }}"></el-alert>
  @endif
@endforeach
