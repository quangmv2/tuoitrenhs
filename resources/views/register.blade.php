<!DOCTYPE html>
<html>
<head>

  @php

    use App\Information;

    $information = Information::all();

    if (count($information)>0) {

      $information = $information[0];

    }

  @endphp

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>ĐĂNG KÝ HỆ THỐNG</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ĐĂNG KÝ HỆ THỐNG" />

  <meta property="og:url" content="{{ url()->full() }}" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="ĐĂNG KÝ HỆ THỐNG" />
  <meta property="og:description" content="QUẬN ĐOÀN NGŨ HÀNH SƠN" />
  <meta property="og:image" content="{{ asset('images/logo.png') }}" />

  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="shortcut icon" href="{{ asset('uploads/images/system') }}/{{ $information->icon }}">





  <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">

  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">

  <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">



  <link rel="stylesheet" href="assets/css/style.css">



  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


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





</head>



<body class="bg-dark">





  <div class="sufee-login d-flex align-content-center flex-wrap">

    <div class="container">

      <div class="login-content">

        <div class="login-logo">

          <a href="{{ route('home') }}">

          

            @if (!empty($information))

            <img class="align-content" src="{{ asset('uploads/images/system') }}/{{ $information->icon }}" alt="" width="20%">

            @endif

          </a>

        </div>

        <div class="login-form">

          <form action="" method="POST">

            @if (count($errors)>0)

                <div class="alert alert-danger">

                    @foreach ($errors->all() as $element)

                        {{ $element }} <br>

                    @endforeach

                </div>

            @endif

            @if (session('notification'))

                <div class="alert alert-danger">

                    {{ session('notification') }}

                </div>

            @endif

            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <div class="form-group">

              <label>Họ và tên</label>

              <input type="text" name="name" class="form-control" placeholder="Họ và tên" required="" />

            </div>

            <div class="form-group">

              <label>Số điện thoại</label>

              <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại" required="" />

            </div>

            <div class="form-group">

              <label>Email</label>

              <input type="text" name="email" class="form-control" placeholder="Email">

            </div>

            <div class="form-group">

              <label>Địa chỉ</label>

              <input type="text" name="address" class="form-control" placeholder="Địa chỉ">

            </div>



            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Đăng Ký</button>

            

            <div class="register-link m-t-15 text-center">

              <p>Bạn đã có tài khoản ? <a href="{{ route('getLogin') }}"> Đăng nhập ngay</a></p>

            </div>

          </form>

        </div>

      </div>

    </div>

  </div>





  <script src="vendors/jquery/dist/jquery.min.js"></script>

  <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

  <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

  <script src="assets/js/main.js"></script>





</body>
</html>