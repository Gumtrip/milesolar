<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('seo_title','China robust power inverter - OEM inverters manufacturer')</title>
  <meta name="description" content="@yield('seo_desc','manufacture power inverter, produce robust power inverters')"/>
  <meta name="keywords" content="@yield('seo_keywords','MILESOLAR produce robust & rugged power inverters approved by CE standard,which provide reliable power supply to backup power system & off-grid solar power system')" />
  <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
  <div id="app">
    @include('frontend.layout._header')
    <div class="wrapper">
      @yield('content')
    </div>
    <div class="container">
      @yield('main_content')
    </div>
    @include('frontend.layout._footer')
  </div>
</body>
<script src="{{asset('js/vendor/jquery-3.5.1.slim.min.js')}}"></script>
<script src="{{asset('js/vendor/popper.min.js')}}"></script>
<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
@stack('before_vue_scripts')
@stack('after_vue_scripts')
</html>
