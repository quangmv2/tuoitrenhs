@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>SLIDER</small> </h1>

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
                    <th style="width: 3%">TT</th>
                    <th style="width: 30%">TIÊU ĐỀ</th>
                    <th style="width: 39%">TÓM TẮT</th>
                    <th style="width: 10%">ẢNH</th>
                    <th style="width: 3%">LIÊN KẾT</th>
                    <th style="width: 3%">THỨ TỰ</th>
                    <th style="width: 3%">HIỂN THỊ</th>
                    <th style="width: 3%">XÓA</th>
                    <th style="width: 3%">SỬA</th>
                    <th style="width: 3%">LƯU</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 0;
                @endphp
                @foreach ($slides as $element)
                @php
                  $i++;
                @endphp
                <form action="{{ route('postEditLiveSlide', ['id'=>$element->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <tr class="odd gradeX" align="center">
                            <input type="hidden" name="title" value="{{ $element->title }}">
                            <input type="hidden" name="summary" value="{{ $element->summary }}">
                            <input type="hidden" name="image" value="{{ $element->image }}">
                            <input type="hidden" name="link" value="{{ $element->link }}">
                            <td>{{ $i }}</td>
                            <td align="justify">{{ cutTitle($element->title,10) }}</td>
                            <td align="justify">{{ cutTitle($element->summary, 10) }}</td>
                            <td width="5%"><img src="{{ asset('uploads/images/slides') }}/{{ $element->image }}"></td>
                            <td align="justify"><a href="{{ $element->link }}" target="_blank">{{ $element->link }}</a></td>                                
                            <td width="5%"><input type="number" name="order_num" value="{{ $element->order_num }}" min="1" max="10000" onchange="active({{ $element->id }})"></td>
                            <td>
                                <select name="status" onchange="active({{ $element->id }})">
                                    <option value="1" selected>Có</option>
                                    <option value="0"
                                        @if ($element->status == 0)
                                            selected 
                                        @endif
                                    >Không</option>
                                </select>
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                            <td class="center"><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="slide/chinh-sua/{{ $element->id }}.html">SỬA</a></td>
                            <td><button class="btn btn-success" type="submit" disabled id="{{ $element->id }}">LƯU</button></td>
                        </tr>
                    </form>
                @endforeach
                
               
            </tbody>
        </table>
        {{ $slides->links() }}
        </div>
    </div>
</div>


@endsection