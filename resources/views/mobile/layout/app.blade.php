<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('seo_title','China robust power inverter - OEM inverters manufacturer')</title>
  <meta name="description" content="@yield('seo_desc','manufacture power inverter, produce robust power inverters')"/>
  <meta name="keywords" content="@yield('seo_keywords','MILESOLAR produce robust & rugged power inverters approved by CE standard,which provide reliable power supply to backup power system & off-grid solar power system')" />
  <link rel="stylesheet" href="{{asset('css/vendor/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ mix('/css/mobile.css') }}">

{{--  slick 插件--}}
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}"/>
  <!-- Add the slick-theme.css if you want default styling -->
  <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.css')}}"/>
{{--  slick 插件--}}
<!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-167279691-1"></script>
  <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
          dataLayer.push(arguments);
      }

      gtag('js', new Date());

      gtag('config', 'UA-167279691-1');
  </script>
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/7628792.js"></script>
    <!-- End of HubSpot Embed Code -->
</head>
<body>
<div id="app">
    @include(cusView('layout._header'))
    <div class="wrapper">
      @yield('content')
    </div>
    <div class="container">
      @yield('main_content')
    </div>
    @include(cusView('layout._footer'))
  </div>
</body>
@stack('before_scripts')
<script src="{{asset('js/vendor/jquery-3.5.1.min.js')}}"></script>
{{--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}
{{--  slick 插件--}}
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
{{--  slick 插件--}}

<script src="{{asset('js/vendor/popper.min.js')}}"></script>
<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>

@stack('after_scripts')
</html>
