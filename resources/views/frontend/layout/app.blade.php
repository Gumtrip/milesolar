<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('seo_title','China robust power inverter - OEM inverters manufacturer')</title>
  <meta name="description" content="@yield('seo_desc','manufacture power inverter, produce robust power inverters')"/>
  <meta name="keywords" content="@yield('seo_keywords','MILESOLAR produce robust & rugged power inverters approved by CE standard,which provide reliable power supply to backup power system & off-grid solar power system')" />
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
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
<!-- import Vue before Element -->
@stack('after_styles')
<script src="https://unpkg.com/vue/dist/vue.js"></script>

<!-- import JavaScript -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script>
@stack('before_vue_scripts')

<script>
    new Vue({
        el: '#app',
        data: function() {
            return { visible: false }
        }
    })
</script>
@stack('after_vue_scripts')

</html>
