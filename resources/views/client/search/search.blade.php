@extends('client.index')

@section('left_content')

	<div class="col-lg-8 col-md-8 col-sm-8">

		<div class="left_content">

			<h2>Kết quả tìm kiếm cho "{{ $result }}"</h2>

			<h5>Tìm kiếm được {{ $count }} kết quả trong {{ $time }}s</h5>

			<div class="row">

				@foreach ($postss as $index => $value)

					<div class="col-sm-6 col-lg-6 col-md-6 col-xl-6">

						<div class="news clearfix">

						   <a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}"><img src="{{ asset('uploads/images/posts') }}/{{ $value->image }}" alt="{{ $value->title }}">    <div class="time-l">

						    	<p class="time-tab-r"><i style="margin-right:5px;    vertical-align: baseline;" class="fa fa-calendar" aria-hidden="true"></i>{{ $value->created_at->format('d/m/Y') }}<span style="margin:0px 5px"></span><span><i class="fa fa-user"> {{ $value->name_author }}</i></span> <span class="views"><i class="fa fa-eye" aria-hidden="true"></i> {{ $value->view }}</span></p>

						    </div>

						    </a><div class="info-news"><a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}">

						        </a>

						        	<h5>

						        		<a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}">

						        			

						        		</a>

						        		<a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}">{{ $value->title }}

						        		</a>

						        	</h5>

						       	</a>

						        <p style="color:#8e8e8e">

						        	@php

						        		$str = explode(" ", $value->summary);

						        		$i=0;

						        		foreach ($str as $element) {

						        			$i++;

						        			if ($i==20) {

						        				echo $element;

						        				break;

						        			}

						        			echo $element." ";

						        		}

						        	@endphp

						        ... </p>

						    </div>

						</div>

					</div>


				@endforeach

				<div style="float: right;">

					{{ $postss->links() }}

				</div>

		    </div>

		</div>

		<script type="text/javascript">
			
			jQuery(document).ready(function($) {
				$(document).on('click', '.pagination a', function(event) {
					event.preventDefault();
					page = $(this).attr('href').split('page=')[1];
					console.log(page)
					loadP(page)
					$('html, body').animate({scrollTop : 0}, 'slow')
				});

				function loadP(page) {
					$('#preloader').css({
						opacity: '0.5',
						display: 'block'
					});
					$('#status').css('display', 'block');
					$.ajax({
						url: '{{ url()->full() }}',
						type: 'GET',
						data: {
							page : page,	
						},
						success : function(data) {
							$('.left_content').html(data)
							$('#status').fadeOut(); 
			                $('#preloader').delay(100).fadeOut('slow'); 
			                $('body').delay(100).css({
			                    'overflow': 'visible'
			                });
						}
					})
					.done(function() {
						console.log("success");
					})
					.fail(function() {
						alert('Không thể kết nối đến Server.')
						$('#status').fadeOut(); 
		                $('#preloader').delay(100).fadeOut('slow'); 
		                $('body').delay(100).css({
		                    'overflow': 'visible'
		                });
					})
					.always(function() {
						console.log("complete");
					});
					
				}

			});

		</script>

		<style type="text/css">

			.news{

				float: left;

			    width: 100%;

				height:100%;

				margin-bottom:15px;

			}

			.news > a{

				display:block;

				text-align:center;

			}

			.l-news .news:nth-child(2n){

				float:right;

			}

			.news img{

				width: 340px;

				height: 220px;

			}

			.news img:hover{

				opacity:0.9;

			}

			.time-l{

				background:#f2f2f5;

				padding:5px 10px;

				margin-bottom:7px;

				text-align:left;

			}

			.time-l p.time-tab-r{

				margin:0px;

				color:#a6a6a6;	

			}

			span.views{

				float:right;

			}

			.info-news h5{

				position:relative;

				text-indent:10px;

				margin-bottom:7px;

				border-left: 2px solid #00bfff;

				padding-left: 5px;

			}

			.info-news h5 a{

				color:#00bfff;

			}

			.info-news h5 a:hover{

				color:#bb3500;

			}

			.info-news h5::after{

				color:#00bfff;

				left:0;

				position:absolute;

				z-index:2;

				top:-2px;

				left:-14px;

				font-size:18px;

				font-weight:800;

			}

			.title-detail{

				font-size:15px;

			}

			.f-space10{

				font-style:italic;

				border-left:3px solid #0092df ;

				padding-left:10px;

				margin-left:5px;

			}

			.slideInUp.addthis-animated{

				display:none !important;

			}

			.time{

				font-style: italic;

			}



			.wrap-detail .grid a {

				display: block;

				position: relative;

			}

			.wrap-detail .grid a:hover:after,

			.wrap-detail .grid a:focus:after {

				background: rgba(0, 0, 0, 0.5) url('../images/view.png') center no-repeat;

				content: " ";

				position: absolute;

				top: 0;

				bottom: 0;

				left: 0;

				right: 0;

			}

			.item-7 {

				float: left;

				width: 33.3333336%;

				padding: 5px;

			}

			.item-7 .box-it {

				background-color: #ffffff;

				padding: 8px 8px 20px;

				box-shadow: 0 2px 2px #e9ebec;

			}

			.item-7 .box-it .img {

				border: 1px solid #e8e9e9;

			}

			.item-7 .box-it .comment {

				background: url('../images/picture.png') left center no-repeat;

				padding: 8px 5px 0 45px;

				height: 50px;

				overflow: hidden;

			}

			.item-7 .box-it .comment h4 {

				font-weight: 600;

			}

			.item-7 .box-it .comment a {

				color: #2e2e2e;

			}

			.item-7 .box-it:hover .comment a,

			.item-7 .box-it:focus .comment a,

			.item-7 .box-it .comment a:hover,

			.item-7 .box-it .comment a:focus {

				color: #00579c;

			}

		</style>

	</div>

@endsection