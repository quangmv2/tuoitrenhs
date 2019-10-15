@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">

    

    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1>DANH SÁCH <small>BÀI VIẾT CẦN DUYỆT</small> </h1>

        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div class="container-fluid" style="margin-top: 10px;">
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
        <div class="col-sm-12">
             <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>TT</th>
                    <th>DANH MỤC</th>
                    <th>TIÊU ĐỀ</th>
                    <th>TÓM TẮT</th>
                    <th>ẢNH</th>                                
                    <th>LƯỢT XEM</th>
                    <th>NGÀY ĐĂNG</th>
                    <th>GIỜ ĐĂNG</th>
                    <th>DUYỆT</th>
                    <th>NỔI BẬT</th>
                    <th>HIỂN THỊ</th>
                    <th>XÓA</th>
                    <th>SỬA</th>
                    <th>LƯU</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($list as $index => $element)
                   <tr class="odd gradeX" align="center">
                        <form action="{{ route('postEditPost', ['id'=>$element->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="title" value="{{ $element->title }}" class="form-control" placeholder="Tiêu đề">
                            <input type="hidden" name="category" value="{{ $element->category }}">
                           <input type="hidden" name="order_num" value="{{ $element->order_num }}">
                            <textarea name="summary" type="hidden" style="display: none;" class="form-control" style="Width:100%;height:150px;" placeholder="Tóm tắt...">{{ $element->summary }}</textarea>
                            <textarea name="content" class="form-control"placeholder="Nội dung..." style="display: none;">{{ $element->content }}</textarea>
                            <td>{{ $index+1 }}</td>
                            <td align="justify">{{ $element->loaitin->name }}</td>
                            <td align="justify">{{ $element->title }}</td>
                            <td align="justify" width="20%">{{ $element->summary }}</td>
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
                            <td class="center" ><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="{{ route('getEditPost', ['id'=>$element->id]) }}"> SỬA</a></td>
                            <td><button type="submit" class="btn btn-success" disabled id="{{ $element->id }}">LƯU</button></td>
                        </form>
                    </tr>
               @endforeach
            </tbody>
        </table>
        {{ $list->links() }}
        </div>

    </div>
</div>


@endsection