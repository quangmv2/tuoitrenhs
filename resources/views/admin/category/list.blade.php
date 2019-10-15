@extends('admin.index')
@section('content')
<div class="container" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-lg-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>DANH MỤC</small> </h1>

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
                @php
                    $i=0;
                @endphp
                @foreach ($list as $element)
                    @php
                        $i++;
                    @endphp
                    <tr class="odd gradeX" align="center">
                        <td>{{ $i }}</td>
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
            {{ $list->links() }}
        </div>
        
    </div>
</div>


@endsection