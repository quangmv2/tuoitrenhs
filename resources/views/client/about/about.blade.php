@extends('client.index')
@section('meta')

  <meta name="description" content="GIỚI THIỆU CHUNG - QUẬN ĐOÀN NGŨ HÀNH SƠN">
  <meta name="keywords" content="GIỚI THIỆU CHUNG,QUẬN ĐOÀN NGŨ HÀNH SƠN">

  <meta property="og:title" content="GIỚI THIỆU CHUNG - QUẬN ĐOÀN NGŨ HÀNH SƠN">
  <meta property="og:type" content="webpage">
  <meta property="og:description" content="GIỚI THIỆU CHUNG - QUẬN ĐOÀN NGŨ HÀNH SƠN">
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

			@foreach ($informationHeader as $element)

				@php

					echo $element->about;

				@endphp

			@endforeach

		</div>

	</div>

@endsection