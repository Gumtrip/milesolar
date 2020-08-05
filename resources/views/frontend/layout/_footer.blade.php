<footer id="footer">
  <ul class="wrapper">
    <li class="logo navList">
      <a href="{{route('index')}}">
        <img src="{{asset('/static/logo.png')}}" alt="">
      </a>
    </li>
    <li class="navList product">
      <h3>PRODUCTS</h3>
      <ul>
        <li>
          <h4><a href="{{route('products.index')}}">ALL PRODUCTS</a> </h4>
        </li>
        @foreach($footerCategories as $cate)
        <li>
          <h4><a href="{{route('productCategories',[$cate])}}">{{$cate->title}}</a> </h4>
        </li>
        @endforeach
      </ul>
    </li>
    <li class="navList">
      <h3>ABOUT US</h3>
      <ul>
        @foreach($footerArticles as $article)
        <li>
          <h4><a href="{{route('articles.show',[$article,$article->slug])}}">{{$article->title}}</a> </h4>
        </li>
        @endforeach

      </ul>
    </li>
    <li class="navList">
      <h3>CONTACT US</h3>
      <ul>
        <li>
          <h4><a href="{{route('contact')}}">CONTACT US</a> </h4>
        </li>
      </ul>
    </li>
    <li id="contactUs">
      @include('frontend.contact._info')
    </li>
  </ul>
</footer>

