@extends('client.index')
@section('meta')

  <meta name="description" content="Đoàn TNCS Hồ Chí Minh, Hội Liên hiệp thanh niên, Hội đồng Đội quận Ngũ Hành Sơn được thành lập từ năm 1997 cùng với thời điểm thành lập đơn vị hành chính quận Ngũ Hành Sơn. Đến nay đơn vị đã có nhiều bước phát triển mới, từ chỗ cơ sở vật chất phục vụ cho công tác còn gặp nhiều khó khăn đến nay đơn vị đã có phòng làm việc riêng, hệ thống CNTT đã đáp ứng được yêu cầu công việc của từng cán bộ, công chức. Bên cạnh đó, công tác Đoàn – Hội – Đội trên địa bàn quận ngày càng phát triển, những năm gần đây luôn đạt nhiều thành tích trong các phong trào thi đua và được cấp trên công nhận là đơn vị xuất sắc, vững mạnh nhiều năm liền.">
  <meta name="keywords" content="QUẬN ĐOÀN NGŨ HÀNH SƠN, Tuổi trẻ Ngũ Hành Sơn, Thanh niên Ngũ Hành Sơn, quandoannguhanhson">

  <meta property="og:title" content="QUẬN ĐOÀN NGŨ HÀNH SƠN">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Đoàn TNCS Hồ Chí Minh, Hội Liên hiệp thanh niên, Hội đồng Đội quận Ngũ Hành Sơn được thành lập từ năm 1997 cùng với thời điểm thành lập đơn vị hành chính quận Ngũ Hành Sơn. Đến nay đơn vị đã có nhiều bước phát triển mới,...">
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
      <div class="single_post_content">
        @php
          $j=0;
        @endphp
        @foreach ($category as $index => $value)
          @if ($index != 0)
            @php
              break;
            @endphp
          @endif
          
          <h2><span>{{ $value->name }}</span></h2>
          @foreach ($listPosts as $key => $element)
            @if ($value->id == $key)
              
              <div class="single_post_content_left">
                @foreach ($element as $post)
                @if ($j!=0)
                  @php
                    continue;
                  @endphp
                @endif
                @php
                  $j++;
                @endphp
                <ul class="business_catgnav  wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                  <li>
                    <figure class="bsbig_fig">
                      <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" class="featured_img"> <img alt="{{ $post->image }}" src="{{ asset('uploads/images/posts') }}/{{ $post->image }}"> <span class="overlay"></span> </a>
                      <figcaption> <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" style="text-transform: uppercase;">{{ cutTitle($post->title,14) }}</a> </figcaption>
                      <p>{{ cutTitle($post->summary, 20) }}</p>
                    </figure>
                  </li>
                </ul>
                @endforeach
              </div>
              
              <div class="single_post_content_right">
                <ul class="spost_nav">
                  
                  @php
                    $j = -1;
                  @endphp
                  @foreach ($element as $post)
                    @php
                      $j++;
                    @endphp
                    @if ($j == 0)
                      @php
                        continue;
                      @endphp
                    @endif
                    
                    <li>
                      <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                        <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" class="media-left"> <img alt="" src="{{ asset('uploads/images/posts') }}/{{ $post->image }}"> </a>
                        <div class="media-body"> <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" class="catg_title" style="text-transform: uppercase;">{{ cutTitle($post->title,20) }}</a> </div>
                      </div>
                    </li>
                  @endforeach

                </ul>
              </div>
            @endif
          @endforeach
          <div class="view-more">
            <a href="{{ route('categoryDetail', ['unsigned_title'=>changeUrl($value)] ) }}">Xem thêm...</a>
          </div>
        @endforeach
        
      </div>
      {{-- Banner --}}
      <div class="single_post_content">
        @foreach ($banner as $element)
          <h2><span>{{ $element->title }}</span></h2>
          <a href="{{ $element->link }}"><img src="{{ asset('uploads/images/banners') }}/{{ $element->image }}" width="100%" alt="{{ $element->image }}"></a>
        @endforeach
      </div>
      {{-- End Banner --}}
      {{-- File --}}
      <div class="single_post_content">
        <h2><span>VĂN BẢN - TÀI LIỆU</span></h2>
        <ul class="nav nav-tabs">
          <li class="nav-item active">
            <a class="nav-link active" data-toggle="tab" href="#menu1">ĐOÀN TNCS HỒ CHÍ MINH</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">ĐỘI TNTP HỒ CHÍ MINH</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu3">HỘI LHTN VIỆT NAM</a>
          </li>
        </ul>
        <style type="text/css">
          th{
            color: white;
          }
        </style>

        <!-- Tab panes -->
        <div class="tab-content">
          <div id="menu1" class="container-fluid tab-pane active" style="width: 100%; padding: 0"><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="width: 100%">

              <table class="table table-bordered table-striped mb-0">
                <thead style="background: #00bfff">
                  <tr>
                    <th scope="col" style="text-align: center; width: 5%">TT</th>
                    <th scope="col" style="text-align: center; width: 50%">TÊN VĂN BẢN</th>
                    <th scope="col" style="text-align: center; width: 15%">SỐ/KÝ HIỆU</th>
                    <th scope="col" style="text-align: center; width: 20%">NGÀY BAN HÀNH</th>
                    <th scope="col" style="text-align: center; width: 10%">TẢI VỀ</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($file1 as $index => $element)
                    @php
                        $i++;
                    @endphp
                     <tr>
                        <td style="text-align: center;">{{ $i }}</td>
                        <td style="text-align: justify;">{{ $element->title }}</td>
                        <td style="text-align: center;">{{ $element->number }}</td>
                        <td style="text-align: center;">{{ $element->created_at->format('d/m/Y') }}</td>
                        <td style="text-align: center;">
                          <a href="{{ asset('uploads/files/post') }}/{{ $element->file }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    
                  
                </tbody>
              </table>
              <div class="view-more" style="float: right;">
                <a href="{{ route('fileDetail', ['unsigned_title'=>'doan-tncs-hcm']) }}">Xem thêm...</a>
              </div>
            </div>

          </div>
          <div id="menu2" class="container tab-pane fade" style="width: 100%; padding: 0"><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="width: 100%">

              <table class="table table-bordered table-striped mb-0">
                <thead style="background: #00bfff">
                  <tr>
                    <th scope="col" style="text-align: center;width: 5%">TT</th>
                    <th scope="col" style="text-align: center;width: 50%">TÊN VĂN BẢN</th>
                    <th scope="col" style="text-align: center;width: 15%">SỐ/KÝ HIỆU</th>
                    <th scope="col" style="text-align: center;width: 20%">NGÀY BAN HÀNH</th>
                    <th scope="col" style="text-align: center;width: 10%">TẢI VỀ</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $k = 0;
                    @endphp
                    @foreach ($file2 as $index => $element)
                    @php
                        $k++;
                    @endphp
                      <tr>
                        <td style="text-align: center;">{{ $k }}</td>
                        <td style="text-align: justify;">{{ $element->title }}</td>
                        <td style="text-align: center;">{{ $element->number }}</td>
                        <td style="text-align: center;">{{ $element->created_at->format('d/m/Y') }}</td>
                        <td style="text-align: center;">
                          <a href="{{ asset('uploads/files/post') }}/{{ $element->file }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    
                  
                </tbody>
              </table>
              <div class="view-more" style="float: right;">
                <a href="{{ route('fileDetail', ['unsigned_title'=>'doi-tntp-hcm']) }}">Xem thêm...</a>
              </div>
            </div>
          </div>
          <div id="menu3" class="container tab-pane fade" style="width: 100%; padding: 0"><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" style="width: 100%">

              <table class="table table-bordered table-striped mb-0">
                <thead style="background: #00bfff">
                  <tr>
                    <th scope="col" style="text-align: center;width: 5%">TT</th>
                    <th scope="col" style="text-align: center;width: 50%">TÊN VĂN BẢN</th>
                    <th scope="col" style="text-align: center;width: 15%">SỐ/KÝ HIỆU</th>
                    <th scope="col" style="text-align: center;width: 20%">NGÀY BAN HÀNH</th>
                    <th scope="col" style="text-align: center;width: 10%">TẢI VỀ</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $j = 0;
                    @endphp
                    @foreach ($file3 as $index => $element)
                    @php
                        $j++;
                    @endphp
                      <tr>
                        <td style="text-align: center;">{{ $j }}</td>
                        <td style="text-align: justify;">{{ $element->title }}</td>
                        <td style="text-align: center;">{{ $element->number }}</td>
                        <td style="text-align: center;">{{ $element->created_at->format('d/m/Y') }}</td>
                        <td style="text-align: center;">
                          <a href="{{ asset('uploads/files/post') }}/{{ $element->file }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    
                  
                </tbody>
              </table>
              <div class="view-more" style="float: right;">
                <a href="{{ route('fileDetail', ['unsigned_title'=>'hoi-lhtn-vn']) }}">Xem thêm...</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <style type="text/css">
        .my-custom-scrollbar {
          position: relative;
          height: 200px;
          overflow: auto;
          }
          .table-wrapper-scroll-y {
          display: block;
          }
      </style>
      {{-- End File --}}
    @foreach ($category as $index => $cate)
      @if ($index == 0)
        @php
          continue;
        @endphp
      @endif
      <div class="single_post_content">
      <h2><span>{{ $cate->name }}</span></h2>
      @foreach ($listPosts as $key => $posts)
        @if ($key == $cate->id)
          
          @foreach ($posts as $i => $post)
            @if ($i>0)
              @php
                break;
              @endphp
            @endif
            <div class="single_post_content_left">
              <ul class="business_catgnav  wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                <li>
                  <figure class="bsbig_fig">
                    <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" class="featured_img"> <img alt="{{ $post->image }}" src="{{ asset('uploads/images/posts') }}/{{ $post->image }}"> <span class="overlay"></span> </a>
                    <figcaption> <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" style="text-transform: uppercase;">{{ cutTitle($post->title,14) }}</a> </figcaption>
                    <p>{{ cutTitle($post->summary, 20) }}</p>
                  </figure>
                </li>
              </ul>
            </div>
          @endforeach
          @foreach ($posts as $i => $post)
            @if ($i==0)
              @php
                continue;
              @endphp
            @endif
            <div class="single_post_content_right">
              <ul class="spost_nav">
                  <li>
                      <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                        <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" class="media-left"> <img alt="" src="{{ asset('uploads/images/posts') }}/{{ $post->image }}"> </a>
                        <div class="media-body"> <a href="{{ route('postDetail', ['unsigned_title'=>$post->unsigned_title , 'id'=>$post->id]) }}" class="catg_title" style="text-transform: uppercase;">{{ cutTitle($post->title,20) }}</a> </div>
                      </div>
                    </li>
              </ul>
            </div>
          @endforeach

        @endif
      @endforeach
        
      </div>
      <div class="view-more">
            <a href="{{ route('categoryDetail', ['unsigned_title'=>changeUrl($cate)] ) }}">Xem thêm...</a>
        </div>
    @endforeach


  
    </div>
  </div>
@endsection





    


    
    
    


