<!DOCTYPE html>
<html lang="vi">
<head>
<title> 
  @if (!isset($title))
    QUẬN ĐOÀN NGŨ HÀNH SƠN
  @else
    {{ mb_strtoupper($title) }} - QUẬN ĐOÀN NGŨ HÀNH SƠN
  @endif
 </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="language" content="vi">
<meta http-equiv="Refresh" content="1800">

@yield('meta')

<meta name="google-site-verification" content="CgiQXrwf95dT6T9f91G3J4310ZHo0nRQ3kEQ3w1tyPY" />

<meta name="resource-type" content="document">
<meta name="distribution" content="global">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="msnbot" content="all, index, follow">
<meta name="revisit-after" content="1 days">
<meta name="rating" content="general">
@foreach ($informationHeader as $element)
  <link rel="shortcut icon" href="{{ asset('uploads/images/system') }}/{{ $element->icon }}" />
@endforeach

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/font.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/li-scroller.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/jquery.fancybox.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/css/style.css') }}">


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KMV9PTL');</script>
<!-- End Google Tag Manager -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148877286-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148877286-1');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148952743-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148952743-1');
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
  .view-more a {
    color: #00bfff; 
    float: right;
  }
  .f-space10 {
    font-style: italic;
    border-left: 3px solid #00bfff;
    padding-left: 10px;
    margin-left: 5px;
  }
  .f-space10 h4 {
    color: black;
  }
  .fa {
  }
  .single_page_content img{
    width: 100%!important;
    height: auto!important;
  }
  body{
    @foreach ($informationHeader as $element)
      background-image: url({{ asset('uploads/images/system') }}/{{ $element->image_background }});
    @endforeach
    background-repeat: repeat-y;
    background-position: center bottom;
    background-attachment: fixed;
    text-align: all;
  }
</style>



<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>

  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KMV9PTL"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    

      
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

@yield('summary')


<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
 
  <!-- Header -->
  @include('client.pages.header')

	<section id="sliderSection">
	    <div class="row">
	     
	    </div>

	</section>

  
  <section id="contentSection">
    <div class="row">
      @yield('left_content')
      @yield('slide')
      @include('client.pages.top_right_content')
     	@yield('content')
      @include('client.pages.right_content')
    </div>
  </section>
  
  @include('client.pages.footer')
  
</div>

<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
        <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '1270250983147293',
            xfbml      : true,
            version    : 'v4.0'
          });
          FB.AppEvents.logPageView();
        };

        (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "https://connect.facebook.net/vi_VN/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>

        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="521020351749033"
    theme_color="#13cf13"
{{--   them_color = "#00bfff"
 --}}    logged_in_greeting="Xin chào, chúng tôi hỗ trợ được gì cho bạn?"
    logged_out_greeting="Xin chào, chúng tôi hỗ trợ được gì cho bạn?">
      </div>
<!-- End Chat Facebook -->


{{-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="{{ asset('assets/js/wow.min.js') }}"></script> 
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('assets/js/slick.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.li-scroller.1.0.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.newsTicker.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.fancybox.pack.js') }}"></script> 
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>