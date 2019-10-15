@extends('client.index')
@section('meta')

	<meta name="description" content="{{ cutTitle($post->summary, 20) }}">
	<meta name="keywords" content="{{ mb_strtoupper($post->title) }}">

	<meta property="og:title" content="{{ mb_strtoupper($post->title) }}">
	<meta property="og:type" content="website">
	<meta property="og:description" content="{{ cutTitle($post->summary, 20) }}">
	<meta property="og:site_name" content="">
	<meta property="og:image" itemprop="thumbnailUrl" content="{{ asset('uploads/images/posts') }}/{{ $post->image }}">
	<meta property="og:url" content="{{ route('postDetail',['unsigned_title'=>$post->unsigned_title, 'id'=>$post->id]) }}">

	<meta name="copyright" content="">
	<meta name="author" itemprop="author" content="QUẬN ĐOÀN NGŨ HÀNH SƠN">



@endsection
@section('left_content')
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=341716349608277&autoLogAppEvents=1"></script>
	<script src="https://sp.zalo.me/plugins/sdk.js"></script>
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div class="left_content">
			<div class="single_page">
				<ol class="breadcrumb">
					<li><a href="{{ route('home') }}">TRANG CHỦ</a></li>
					@foreach ($stack as $element)
						<li><a href="{{ route('categoryDetail', ['unsigned_title'=>changeUrl($element)]) }}">{{ $element->name }}</a></li>
					@endforeach
				</ol>
				@php
					$url = route('postDetail',['unsigned_title'=>$post->unsigned_title, 'id'=>$post->id]) ;
				@endphp
				<h3 style="text-transform: uppercase;" ><strong>{{ $post->title }}</strong></h3>
				<div class="post_commentbox"> <a href="{{ route('search') }}?author={{ $post->name_author }}"><i class="fa fa-user"></i>{{ $post->name_author }}</a> <span><i class="fa fa-calendar"></i>{{ $post->created_at->format('d-m-Y H:m:s') }}</span> <a href="{{ route('categoryDetail', ['unsigned_title'=>changeUrl($stack[count($stack)-1])]) }}" title="{{ $stack[count($stack)-1]->name }}"><i class="fa fa-tags"></i>{{ cutTitle($stack[count($stack)-1]->name, 7) }}</a> <span><i class="fa fa-eye" aria-hidden="true"> </i>{{ $post->view }}+</span>
					<div style="display: inline; float: right;">
						<div class="zalo-share-button" data-href="{{ $url }}" data-oaid="579745863508352884" data-layout="2" data-color="blue" data-customize=false style="float: right;"></div>
						<div style="float: right;" class="fb-share-button" data-href="{{ $url }}" data-layout="button" data-size="small"><a target="_blank" href="{{ $url }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
						<div 
							class="fb-like" 
							data-href="{{ $url }}" 
							data-width="" 
							data-layout="button_count" 
							data-action="like" 
							data-size="small" 
							data-show-faces="true" 
							data-share="false"
							style="float: right;">
						</div>
					</div>

					
				</div>
				
				<div class="single_page_content"> 
					<div class="f-space10">
						<h4 style="font-weight:bold;">{{ $post->summary }}</h4>
					</div>
					<img class="img-center" src="{{ asset('uploads/images/posts') }}/{{ $post->image }}" alt="{{ $post->image }}" style="width: 100%; height: 100%">
					
					@php
						echo $post->content;
						
					@endphp

					<div class="fb-comments" data-href="{{ $url }}" data-numposts="5" data-width="100%"></div>
					<hr>
					<div class="others">
						<ul class="list-other">
							@foreach ($postss as $value)
								<li>
									<a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}">{{ $value->title }}&nbsp;-&nbsp; <span class="time" style="color: #00bfff;">({{ $value->created_at->format('d-m-Y') }})</span></a>
								</li>
							@endforeach
						</ul>
						<div class="view-more">
							<a href="{{ route('categoryDetail', ['unsigned_title'=>changeUrl($post->loaitin)]) }}">Xem thêm...</a>
						</div>	
					</div>
					<hr>
			</div>
				
			</div>
		</div>
	</div>
@endsection