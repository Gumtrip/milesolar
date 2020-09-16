<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('seo_title','China robust power inverter - OEM inverters manufacturer')</title>
  <meta name="description" content="@yield('seo_desc','manufacture power inverter, produce robust power inverters')"/>
  <meta name="keywords" content="@yield('seo_keywords','MILESOLAR produce robust & rugged power inverters approved by CE standard,which provide reliable power supply to backup power system & off-grid solar power system')" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
  <div id="app">
    @include('frontend.layout._header')
    <div class="container">
      @yield('content')
    </div>
    <div class="wrapper">
      @yield('main_content')
    </div>
    @include('frontend.layout._footer')
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
@stack('before_vue_scripts')
@stack('after_vue_scripts')
</html>
