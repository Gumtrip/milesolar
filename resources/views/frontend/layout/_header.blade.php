<header id="header">
  <div class="container">
    <div class="row" id="headerRow">
      <div class="col-2">
        <div id="logo" class="flexPic">
          <a href="/">
            <img src="{{asset('/static/logo.png')}}" alt="">
          </a>
        </div>
      </div>
      <div class="col-4">
        <el-form id="searchForm" name="title" action="{{route('products')}}" :inline="true">
          <el-form-item>
            <input class="el-input" type="text" name="title" placeholder="SEARCH WHAT YOU WANT!"/>
          </el-form-item>
          <el-form-item>
            <button class="el-button--primary el-button" type="submit">SEARCH</button>
          </el-form-item>
        </el-form>
      </div>
      <el-col class="col-3 contactItem">
        <a href="mailto:milly@milesolar.com"><i class="fa fa-envelope-o"></i><span>milly@milesolar.com</span></a>
      </el-col>
      <el-col class=" col-3 contactItem">
        <a href="tel:008613889943867"><i class="fa fa-phone"></i><span>0086 13889943867</span></a>
      </el-col>
    </div>
  </div>

    <nav class="container" id="nav">
      <div class="row">
        @foreach($navList as $nav)
        <div class="col-2 list">
          <a href="{{$nav['url']}}">{{$nav['title']}}</a>
        </div>
        @endforeach
      </div>
    </nav>
</header>
