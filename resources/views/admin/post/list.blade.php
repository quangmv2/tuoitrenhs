@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">

    

    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1>DANH SÁCH <small>BÀI VIẾT</small> </h1>

        </div>


    </div>
    <!-- /.row -->
</div>

<style type="text/css">
    a{
        color: black;
    }
</style>
<!-- /.container-fluid -->
<div class="container-fluid" style="margin-top: 10px;">
    <div id="preloader" style="display: none;">
      <div id="status" style="display: none;">&nbsp;</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
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
        </div>
    
        @php
            $page = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page']-1;
            }
        @endphp
        <div class="col-sm-12">
            {{-- <ul class="nav nav-tabs nav-pills">
              <li class="nav-item active">
                <a class="nav-link active" data-toggle="tab" href="" onclick="changeP('all'); callServer();">Tất cả</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="" onclick="changeP('highlight'); callServer();">Nổi bật</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="" onclick="changeP('show'); callServer();">Hiển thị</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="" onclick="changeP('hidde'); callServer();">Không hiển thị</a>
              </li>
            </ul> --}}

            <select class="" id="sel">
                <option value="all">Tất cả</option>
                <option value="highlight">Nổi bật</option>
                <option value="show">Hiển thị</option>
                <option value="hidde">Không hiển thị</option>
            </select>
              <div id="menu1" style="width: 100%; padding: 0"><br>
                    <table class="table table-striped table-bordered table-hover" id="">
                        <thead>
                            <tr align="center">
                                <th style="width: 3%">TT</th>
                                <th style="width: 14%">DANH MỤC</th>
                                <th style="width: 25%">TIÊU ĐỀ</th>
                                <th style="width: 25%">TÓM TẮT</th>
                                <th style="width: 5%">ẢNH</th>                                
                                <th style="width: 3%">LƯỢT XEM</th>
                                <th style="width: 5%">NGÀY ĐĂNG</th>
                                <th style="width: 5%">GIỜ ĐĂNG </th>
                                <th style="width: 3%">DUYỆT</th>
                                @if ($acc->type == 1 || count($role)>0)
                                    <th style="width: 3%">NỔI BẬT</th>
                                    <th style="width: 3%">HIỂN THỊ</th>
                                @endif
                                
                                <th style="width: 3%">XÓA</th>
                                <th style="width: 3%">SỬA</th>
                                @if ($acc->type == 1 || count($role)>0)
                                    <th style="width: 3%">LƯU</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($acc->type == 1 || count($role) > 0)
                                   
                               @foreach ($list as $index => $element)
                                   
                                   <tr class="odd gradeX" align="center">
                                        <form action="{{ route('postEditPost', ['id'=>$element->id]) }}" method="POST" id="myFrom{{ $element->id }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="title" value="{{ $element->title }}" class="form-control" placeholder="Tiêu đề">
                                            <input type="hidden" name="category" value="{{ $element->category }}">
                                            <input type="hidden" name="order_num" value="{{ $element->order_num }}">
                                            <textarea name="summary" type="hidden" style="display: none;" class="form-control" style="Width:100%;height:150px;" placeholder="Tóm tắt...">{{ $element->summary }}</textarea>
                                            <textarea name="content" class="form-control"placeholder="Nội dung..." style="display: none;">{{ $element->content }}</textarea>
                                            <td>{{ ($page*50 + $index+1) }}</td>
                                            <td align="justify"><a href="{{ route('postOfCate', ['unsigned_title'=>changeUrl($element->loaitin)]) }}" title="{{ $element->loaitin->name }}">{{ cutTitle($element->loaitin->name,5) }}</a></td>
                                            <td align="justify"><a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" target="_blank" title="{{ $element->title }}">{{ cutTitle($element->title,10) }}</a></td>
                                            <td align="justify" width="20%" title="{{ $element->summary }}">{{ cutTitle($element->summary, 10) }}</td>
                                            <td width="5%"><img src="{{ asset('uploads/images/posts') }}/{{ $element->image }}" width="100%"></td>                               
                                            <td>{{ $element->view }}</td>
                                            <td>{{ $element->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $element->created_at->toTimeString() }}</td>
                                            <td>
                                                @if ($element->active)
                                                    Rồi
                                                @else 
                                                    Chưa
                                                @endif
                                            </td>
                                            <td>
                                                <select name="highlight" onchange="active({{ $element->id }})">
                                                    <option value="1" selected>Có</option>
                                                    <option value="0"
                                                        @if ($element->highlight != 1)
                                                            selected 
                                                        @endif
                                                    >Không</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="status" onchange="active({{ $element->id }})">
                                                    <option value="1" selected>Có</option>
                                                    <option value="0"
                                                        @if ($element->status != 1)
                                                            selected 
                                                        @endif
                                                    >Không</option>
                                                </select>
                                            </td>
                                            <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                                            <td class="center"><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="{{ route('getEditPost', ['id'=>$element->id]) }}">SỬA</a></td>
                                            <td><button type="submit" class="btn btn-success" disabled id="{{ $element->id }}">LƯU</button></td>
                                        </form>
                                    </tr>
                               @endforeach

                            @else
                              

                               @foreach ($list as $index => $element)
                                   
                                   <tr class="odd gradeX" align="center">
                                            <td>{{ ($page*50 + $index+1) }}</td>
                                            <td align="justify"><a href="{{ route('postOfCate', ['unsigned_title'=>changeUrl($element->loaitin)]) }}" title="{{ $element->loaitin->name }}">{{ cutTitle($element->loaitin->name,5) }}</a></td>
                                            <td align="justify"><a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" target="_blank" title="{{ $element->title }}">{{ cutTitle($element->title,10) }}</a></td>
                                            <td align="justify" width="20%" title="{{ $element->summary }}">{{ cutTitle($element->summary, 10) }}</td>
                                            <td width="5%"><img src="{{ asset('uploads/images/posts') }}/{{ $element->image }}" width="100%"></td>                               
                                            <td>{{ $element->view }}</td>
                                            <td>{{ $element->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $element->created_at->toTimeString() }}</td>
                                            <td>
                                                @if ($element->active)
                                                    Rồi
                                                @else 
                                                    Chưa
                                                @endif
                                            </td>
                                           
                                            <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                                            <td class="center"><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="{{ route('getEditPost', ['id'=>$element->id]) }}">SỬA</a>
                                            </td>
                                    </tr>
                               @endforeach

                               {{-- endnew --}}
                            @endif                
                           
                        </tbody>
                    </table>
                    {{ $list->links() }}
              </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var post = 'all';

    function sub(form) {
        url = $(form).attr("action")

        var form_data = $(form).serializeArray();
        console.log(form_data)
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token : '{{csrf_token()}}',
                form_data,

            },
            success : function (data) {
                alert('OK')
            }
        })
        .fail(function() {
            alert('Không thể kết nối đến Server')
        })
    }

    function changeP(p) {
        post = p;
    }

    function callServer(page) {
        $('#status').css('display', 'block');
        $('#preloader').css('display', 'block')
        if (page == null) page = 1;
        $.ajax({
            url: '{{ route('post-ajax') }}',
            type: 'GET',
            dataType: 'html',
            data: {
                post    : post,
                page    : page,
            },
            success : function (data) {
                $('#menu1').html('')
                $('#menu1').html(data)
                $('#status').fadeOut(); 
                $('#preloader').delay(100).fadeOut('slow'); 
                $('body').delay(100).css({
                    'overflow': 'visible'
                });
            }
        })
        .fail(function() {
            alert('Không thể kết nối đến Server')
            $('#status').fadeOut(); 
              $('#preloader').delay(100).fadeOut('slow'); 
              $('body').delay(100).css({
                  'overflow': 'visible'
              });
        })
        
    }


    jQuery(document).ready(function($) {

        $('#sel').change(function(event) {
            var op = $(this).children('option:selected').val()
            changeP(op)
            callServer()
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            callServer(page)
            $('html, body').animate({scrollTop : 0}, 'slow')
        });
    });
    jQuery(document).ready(function($) {
          $('#status').fadeOut(); // will first fade out the loading animation
          $('#preloader').delay(100).fadeOut('slow'); // will fade out the white DIV that covers the website.
          $('body').delay(100).css({
              'overflow': 'visible'
          });
    });

</script>

<style type="text/css">

    #preloader{position:fixed; top:0; left:0; right:0; bottom:0; background-color:#fff; z-index:99999; opacity: 0.5}
    #status{width:200px; height:200px; position:absolute; left:50%; top:50%; background-image:url(../images/35.gif); background-repeat:no-repeat; background-position:center; margin:-100px 0 0 -100px}
</style>


@endsection


