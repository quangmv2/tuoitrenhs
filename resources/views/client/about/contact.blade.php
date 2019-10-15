@extends('client.index')
@section('meta')

  <meta name="description" content="LIÊN HỆ - QUẬN ĐOÀN NGŨ HÀNH SƠN">
  <meta name="keywords" content="LIÊN HỆ,QUẬN ĐOÀN NGŨ HÀNH SƠN">

  <meta property="og:title" content="LIÊN HỆ - QUẬN ĐOÀN NGŨ HÀNH SƠN">
  <meta property="og:type" content="webpage">
  <meta property="og:description" content="LIÊN HỆ - QUẬN ĐOÀN NGŨ HÀNH SƠN">
  <meta property="og:site_name" content="">
  <meta property="og:image" itemprop="thumbnailUrl" content="{{ asset('images/logo.png') }}">
  <meta property="og:url" content="{{ url()->full() }}">

  <meta name="copyright" content="">
  <meta name="author" itemprop="author" content="QUẬN ĐOÀN NGŨ HÀNH SƠN">



@endsection
@section('slide')
@include('client.home.slide')
@endsection
@section('content')
    <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
            <h3>LIÊN HỆ</h3>
            @if (count($errors)>0)
                  <div class="alert alert-danger">
                      @foreach ($errors->all() as $element)
                          {{ $element }} <br>
                      @endforeach
                  </div>
            @endif
            @if (session('notification'))
                  <div class="alert alert-success">
                      {{ session('notification') }}
                  </div>
             @endif
            <form name="frmadd_video" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Họ và tên người liên hệ</label>
                    <input type="text" name="name" value="" class="form-control" placeholder="Tên người liên hệ" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" value="" name="phone_number" class="form-control" placeholder="Số điện thoại người liên hệ" required>
                </div>
                <div class="form-group">
                    <label>Thư điện tử</label>
                    <input type="text" value="" name="email" class="form-control" placeholder="Nhập email người liên hệ" required>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea type="text" value="" name="content" class="form-control" placeholder="Nhập nội dung cần trao đổi" required></textarea>
                </div>
                <button class="btn btn-success" type="submit">Gửi</button>
            </form>

        </div>
    </div>
@endsection