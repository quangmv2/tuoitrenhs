@extends('client.index')
@section('meta')


  <meta name="description" content="{{ cutTitle($category->name, 20) }}">
  <meta name="keywords" content="{{ mb_strtoupper($category->name) }}">

  <meta property="og:title" content="{{ mb_strtoupper($category->name) }}">
  <meta property="og:type" content="webpage">
  <meta property="og:description" content="{{ cutTitle($category->name, 20) }}">
  <meta property="og:site_name" content="">
  <meta property="og:image" itemprop="thumbnailUrl" content="{{ asset('images/logo.png') }}">
  <meta property="og:url" content="{{ url()->full() }}">

  <meta name="copyright" content="">
  <meta name="author" itemprop="author" content="QUẬN ĐOÀN NGŨ HÀNH SƠN">

@endsection
@section('left_content')
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div class="left_content">
			<div class="single_page">
				<ol class="breadcrumb">
					<li><a href="{{ route('home') }}">TRANG CHỦ</a></li>
					<li><a href="">{{ $category->name }}</a></li>
				</ol>
			</div>
			
			<h2></h2>
			<div class="content_detail">
        <table class="table table-bordered table-striped mb-0">
            <thead style="background: #00bfff">
              <tr>
                <th scope="col" style="text-align: center;">TT</th>
                <th scope="col" style="text-align: center;">TÊN VĂN BẢN</th>
                <th scope="col" style="text-align: center;">SỐ/KÝ HIỆU</th>
                <th scope="col" style="text-align: center;">NGÀY BAN HÀNH</th>
                <th scope="col" style="text-align: center;">TẢI VỀ</th>
              </tr>
            </thead>
            <tbody>
                @php
                  $page = 1;
                  if (isset($_GET['page'])){
                    $page = $_GET['page'];
                  }
                @endphp  
                @foreach ($files as $index => $element)
                  <tr>
                    <!--<th scope="row" style="text-align: center;">{{ $index + 1 }}</th>-->
                    <td style="text-align: center;width: 5%">{{ ($page-1)*25 + $index + 1 }}</td>
                    <td style="text-align: justify; width: 50%">{{ $element->title }}</td>
                    <td style="text-align: center;width: 15%">{{ $element->number }}</td>
                    <td style="text-align: center;width: 20%">{{ $element->created_at->format('d/m/Y') }}</td>
                    <td style="text-align: center;width: 10%">
                      <a href="{{ asset('uploads/files/post') }}/{{ $element->file }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
                    </td>
                  </tr>
                @endforeach
                
              
            </tbody>
          </table>
        <div style="float: right;">
          {{ $files->links() }}
        </div>   
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
              $('.content_detail').html(data)
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
@endsection