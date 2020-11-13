<div id="headerTop" class="container-fluid">
    <form method="get" action="{{route('products')}}" class="form-inline">
      <div class="form-group mb-0 col-10">
        <input class="form-control" type="search" placeholder="Search" value="{{$title??''}}" name="title"
               aria-label="Search">
      </div>
      <button class="border-0 searchBtn" type="submit">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
             xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
          <path fill-rule="evenodd"
                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
        </svg>
      </button>
      <span id="headerCloseBtn" class="headerCloseBtn">
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg>
      </span>
    </form>
</div>
<header id="header" class="pt-0">
  <nav class="navbar  navbar-light bg-light">
    <a id="logo" class="navbar-brand" href="#">
      <img src="{{asset('/static/logo.png')}}" alt="">
    </a>
    <div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <button id="headerSearchBtn" class="searchBtn">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
             xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
          <path fill-rule="evenodd"
                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
        </svg>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @foreach($navList as $nav)
          <li class="nav-item"><a class="nav-link" href="{{$nav['url']}}">{{$nav['title']}}</a></li>
        @endforeach
      </ul>
    </div>
  </nav>
</header>
@push('after_scripts')
  <script>
    $('#headerSearchBtn').click(function(){
      $('#headerTop').addClass('display')
    })
    $('#headerCloseBtn').click(function(){
      $('#headerTop').removeClass('display')
    })
  </script>
@endpush
