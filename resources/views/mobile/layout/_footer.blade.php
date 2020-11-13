<footer id="footer" class="border-top">
  <div class="container">
    <ul class="row list-unstyled">
      <li class="navList col-3 product">
        <h3>PRODUCTS</h3>
        <ul class="list-unstyled">
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
      <li class="navList col-3">
        <h3>ABOUT US</h3>
        <ul class="list-unstyled">
          @foreach($footerArticles as $article)
            <li>
              <h4><a href="{{route('articles.show',[$article,$article->slug])}}">{{$article->title}}</a> </h4>
            </li>
          @endforeach

        </ul>
      </li>
      <li class="navList col-3">
        <h3>CONTACT US</h3>
        <ul class="list-unstyled">
          <li>
            <h4><a href="{{route('contact')}}">CONTACT US</a> </h4>
          </li>
        </ul>
      </li>
      <li id="contactUs" class="col-3">
        @include(cusView('contact._info'))
      </li>
    </ul>
  </div>
</footer>

