@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">

    

    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1>DANH SÁCH <small>BÀI VIẾT DANH MỤC "{{ $title }}"</small> </h1>

        </div>


    </div>
    <!-- /.row -->
</div>
<style type="text/css">
    h3{
        display: inline;
    }
    a{
        color: black;
    }
</style>

<!-- /.container-fluid -->
<div class="container-fluid" style="margin-top: 10px;">
    <div class="row">
        <div class="col-sm-12">

            <h3><a href="{{ route('categoryList') }}">Danh mục</a></h3>
            @foreach ($stack as $element)
                <h3>/ <a href="{{ route('postOfCate', ['unsigned_title'=>changeUrl($element)]) }}">{{ $element->name }}</a></h3>
            @endforeach
        </div>
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

        @if (count($categorys) > 0)
            <div class="col-sm-12">
                <h4>Danh mục con</h4>
                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th style="width: 3%">TT</th>
                        <th style="width: 34%">TÊN DANH MỤC</th>
                        <th style="width: 20%">THUỘC DANH MỤC</th>
                        <th style="width: 5%">MENU</th>
                        <th style="width: 5%">GIỮA</th>
                        <th style="width: 5%">PHẢI</th>                                
                        <th style="width: 7%">THỨ TỰ</th>
                        <th style="width: 7%">HIỂN THỊ</th>
                        <th style="width: 7%">XÓA</th>
                        <th style="width: 7%">SỬA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorys as $index => $element)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $index }}</td>
                            <td align="justify"><a href="{{ route('postOfCate', ['unsigned_title'=>changeUrl($element)]) }}">{{ $element->name }}</a>
                            </td>
                            <td>
                                @if ($element->parent_id == 0)
                                    Gốc
                                @else
                                    {{ $element->muccon->name }}
                                @endif
                            </td>
                            <td>
                                @if ($element->menu == 1)
                                    Có
                                @else
                                    Không
                                @endif
                            </td>
                            <td>
                                @if ($element->home == 1)
                                    Có
                                @else
                                    Không
                                @endif
                            </td>
                            <td>
                                @if ($element->right_home == 1)
                                    Có
                                @else
                                    Không
                                @endif
                            </td>
                            <td>{{ $element->order_num }}</td>
                            <td>@if ($element->status == 1)
                                    Có
                                @else
                                    Không
                                @endif</td>
                            
                            <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                            <td class="center" ><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="{{ route('getEditCategory', ['id'=>$element->id]) }}">SỬA</a></td>
                        </tr>
                    @endforeach

                    
                   
                </tbody>
            </table>
            </div>
        @endif

        <div class="col-sm-12">
            <h4>Bài viết</h4>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                            <form action="{{ route('postEditPost', ['id'=>$element->id]) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="title" value="{{ $element->title }}" class="form-control" placeholder="Tiêu đề">
                                <input type="hidden" name="category" value="{{ $element->category }}">
                                <input type="hidden" name="order_num" value="{{ $element->order_num }}">
                                <textarea name="summary" type="hidden" style="display: none;" class="form-control" style="Width:100%;height:150px;" placeholder="Tóm tắt...">{{ $element->summary }}</textarea>
                                <textarea name="content" class="form-control"placeholder="Nội dung..." style="display: none;">{{ $element->content }}</textarea>
                                <td>{{ ($page*50 + $index+1) }}</td>
                                <td align="justify">{{ cutTitle($element->loaitin->name,5) }}</td>
                                <td align="justify"><a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" target="_blank">{{ cutTitle($element->title,10) }}</a></td>
                                <td align="justify" width="20%">{{ cutTitle($element->summary, 10) }}</td>
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
                                <td align="justify">{{ $element->loaitin->name }}</td>
                                <td align="justify"><a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" target="_blank">{{ cutTitle($element->title,10) }}</a></td>
                                <td align="justify" width="20%">{{ cutTitle($element->summary, 10) }}</td>
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


@endsection