

<header id="header">

  <div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

      <div class="header_top" style="background-color: #00bfff;">

        

        <script type="text/javascript">

          

          var myVar=setInterval(function(){Clock()},1000);

          function Clock() {

          a=new Date();

          w=Array("Chủ Nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy");

          var a=w[a.getDay()],

          w=new Date,

          d=w.getDate();

          m=w.getMonth()+1;

          y=w.getFullYear();

          h=w.getHours();

          mi=w.getMinutes();

          se=w.getSeconds();

          if(10>d){d="0"+d}

          if(10>m){m="0"+m}

          if(10>h){h="0"+h}

          if(10>mi){mi="0"+mi}

          if(10>se){se="0"+se}

          document.getElementById("clockDiv").innerHTML="Hôm nay: "+a+", "+d+" / "+m+" / "+y+" - "+h+":"+mi+":"+se+"";

          }

                                

        </script>

        <div class="header_top_right">

          <p id="clockDiv"></p>

        </div>

      </div>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12">

      <div class="header_bottom">

        @if (!empty($bannerHeader->link))

          <div class="logo m-auto"><a href="{{ $bannerHeader->link }}" class="logo"><img src="{{ asset('/uploads/images/banners') }}/{{ $bannerHeader->image }}" alt=""></a></div>

        @endif

      </div>

    </div>

  </div>

</header>



<section id="navArea">

  <nav class="navbar navbar-inverse" role="navigation">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

    </div>

    <div id="navbar" class="navbar-collapse collapse">

      <ul class="nav navbar-nav main_nav">

        <li class="active"><a href="{{ route('home') }}"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Trang chủ</span></a></li>

        <li class="dropdown">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Giới thiệu</a>

            <ul class="dropdown-menu" role="menu" style="display: none;">

                <li><a href="{{ route('about') }}">GIỚI THIỆU CHUNG</a></li>

                <li><a href="{{ route('organization') }}">CƠ CẤU TỔ CHỨC</a></li>

            </ul>

        </li>

        @foreach ($categoryHeader as $element)

          <li class="dropdown"><a href="{{ route('categoryDetail', ['unsigned_title'=>$element->unsigned_name]) }}">{{ $element->name }}</a>

            @php

              $categoryParent = checkCategory($element);

              // function Try($cate)

              // {

              //   if (checkCategory($cate) < 1) {

              //     echo ""

              //   } else {

              //     foreach (checkCategory($cate) as $value) {

              //       Try($value);  

              //     }



              //   }

              // }







            @endphp

            @if (count($categoryParent)>0)

              <ul class="dropdown-menu" role="menu" style="display: none;">

                @foreach ($categoryParent as $value)

                  <li><a href="{{ route('postDetail', ['unsigned_title'=>$value->unsigned_title, 'id'=>$value->id]) }}">{{ $value->title }}</a></li>

                @endforeach

              </ul>

            @endif

          </li>

        @endforeach

        <li><a href="{{ route('contact') }}">Liên hệ</a></li>

        

      </ul>

      <div class="search">

        <form class="frmsearch" action="{{ route('search') }}" method="get" name="frmsearch">        

          <input class="form-control" type="text" name="q" placeholder="Tìm kiếm... " style="height: 90%"> 

          <input type="hidden" name="cx" value="014018370203224425759:-99wwf4bubc">

          <input type="hidden" name="cof" value="FORID:11">

          <input type="hidden" name="ie" value="UTF-8">

        </form>

      </div>

      <style type="text/css">

        .search{



            margin: 10px 0 0 0;

            float: right;



          }

      </style>

    </div>

  </nav>

</section>

<section id="newsSection">

    <div class="row">

        <div class="col-lg-12 col-md-12 title">

            <marquee class="slogan title" behavior="scroll" direction="left"><h3>{{ $slogan }}</h3></marquee>

        </div>

    </div>

</section>

<section id="newsSection">

  <div class="row">

    <div class="col-lg-12 col-md-12">

      <div class="latest_newsarea"> <span>TIN NỔI BẬT</span>

        <ul id="ticker01" class="news_sticker">

          

          @foreach ($postHiglight as $element)

            <li><a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" style="text-transform: uppercase;"><img src="{{ asset('uploads/images/posts') }}/{{ $element->image }}" alt="">{{ $element->title }}</a></li>

          @endforeach



        </ul>

        <div class="social_area">

          <ul class="social_nav">

            @if (count($informationHeader) > 0)

              @foreach ($informationHeader as $element)

                <li class="facebook"><a href="{{ $element->link_fb }}" target="_blank"></a></li>

                <li class="youtube"><a href="{{ $element->link_youtube }}" target="_blank"></a></li>

                <li class="mail"><a href="{{ route('contact') }}"></a></li>

              @endforeach

            @else

              <li class="facebook"><a href="" target="_blank"></a></li>

              <li class="youtube"><a href="" target="_blank"></a></li>

              <li class="mail"><a href="#"></a></li>

            @endif

              



          </ul>

        </div>

      </div>

    </div>

  </div>

</section>