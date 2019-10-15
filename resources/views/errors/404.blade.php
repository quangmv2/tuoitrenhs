@php
	use App\Banner;
	use App\Post;
	use App\Slogan;
	use App\PostCategory;
	use App\Information;
	use App\Link;
	use App\Slide;
	use App\Video;

	use Illuminate\Support\Facades\View;


	$bannerHeader = Banner::where('status', '=', 1)->where('order_num', 1)->get();
	if (count($bannerHeader)>0) {
		$bannerHeader = $bannerHeader[0];
	}
	$postHiglight = Post::where('active', 1)->where('status', '=', 1)->where('highlight', '=', 1)->orderby('updated_at', 'desc')->take(5)->get();
	$slogans = Slogan::where('status', '>', 0)->get();
	$categoryHeader = PostCategory::where('menu', '>', 0)->where('status', '>', 0)->get();
	$informationHeader = Information::orderby('id', 'desc')->take(1)->get();
	$bannerRightContent = Banner::where('status', 1)->where('order_num', 3)->orderby('updated_at', 'desc')->get();
	$categoryRight = PostCategory::where('status', 1)->where('right_home', 1)->get();
	$postNew = Post::where('active', 1)->where('status', '=', 1)->orderby('created_at', 'desc')->take(5)->get();
	$links = Link::all();
	$videos = Video::orderby('order_num')->take(10)->get();

	if (count($slogans) < 1){
		$slogan = 'Chào mừng bạn đến với trang thông tin điện tử.';
	} else {
		$slogan = $slogans[0]->title;
	}
	$title = "404";
	$slides = Slide::where('status', '=', 1)->orderby('order_num', 'asc')->get();
@endphp
@extends('client.index')
@section('slide')
	@include('client.home.slide')
@endsection
@section('content')
	<div class="col-lg-8 col-md-8 col-sm-8">
        <div class="error_page">
            <h3>CHÚNG TÔI XIN LỖI</h3>
            <h1>404</h1>
            <p>Chức năng đang được tiếp tục phát triển</p>
            <span></span> <a href="{{ route('home') }}" class="wow fadeInLeftBig animated" style="visibility: visible; animation-name: fadeInLeftBig;">Quay về trang chủ</a> 
        </div>
    </div>
@endsection