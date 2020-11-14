<div id="headerTop" >
  <div class="container">
    <div class="row align-items-center listBox">
      <div class="col-3 contactItem">
        <a href="mailto:milly@milesolar.com"><i class="fa fa-envelope-o"></i><span>milly@milesolar.com</span></a>
      </div>
      <div class="col-3 contactItem">
        <a href="tel:008613889943867"><i class="fa fa-phone"></i><span>0086 13889943867</span></a>
      </div>
      <div class="col-6">
        <form method="get" action="{{route('products')}}" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" value="{{$title??''}}" name="title" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>
<header id="header">
  <div class="container">
    <nav id="nav" class="row align-items-center">
      <div class="col-2">
        <div id="logo" class="flexPic">
          <a href="{{route('index')}}">
            <img src="{{asset('/static/logo.jpg')}}" alt="">
          </a>
        </div>
      </div>
      <div class="col-10">
        <div class="row">
          @foreach($navList as $nav)
            <div class="col-2 list">
              <a href="{{$nav['url']}}">{{$nav['title']}}</a>
            </div>
          @endforeach
        </div>
      </div>
    </nav>
  </div>
</header>
