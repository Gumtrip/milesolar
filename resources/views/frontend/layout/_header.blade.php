<header id="header">
  <div class="wrapper">
    <el-row id="headerRow">
      <el-col :span="4">
        <div id="logo" class="flexPic">
          <a href="/">
            <img src="{{asset('/static/logo.png')}}" alt="">
          </a>
        </div>
      </el-col>
      <el-col :span="8">
        <el-form id="searchForm" name="title" action="{{route('products')}}" :inline="true">
          <el-form-item>
            <input class="el-input" type="text" name="title" placeholder="SEARCH WHAT YOU WANT!"/>
          </el-form-item>
          <el-form-item>
            <button class="el-button--primary el-button" type="submit">SEARCH</button>
          </el-form-item>
        </el-form>
      </el-col>
      <el-col class="contactItem" :span="6">
        <a href="mailto:milly@milesolar.com"><i class="fa fa-envelope-o"></i><span>milly@milesolar.com</span></a>
      </el-col>
      <el-col class="contactItem" :span="6">
        <a href="tel:008613889943867"><i class="fa fa-phone"></i><span>0086 13889943867</span></a>
      </el-col>
    </el-row>
  </div>
  <div class="wrapper">
    <nav id="nav">
      <el-row>
        @foreach($navList as $nav)
        <el-col :span="4" class="list">
          <a href="{{$nav['url']}}">{{$nav['title']}}</a>
        </el-col>
        @endforeach
      </el-row>
    </nav>
  </div>
</header>
