@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>TẬP TIN</small> </h1>

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
                    <th style="width: 45%">TIÊU ĐỀ</th>
                    <th style="width: 15%">LOẠI</th>
                    <th style="width: 13%">SỐ/KÝ HIỆU</th>
                    <th style="width: 7%">HIỂN THỊ</th>
                    <th style="width: 7%">XÓA</th>
                    <th style="width: 7%">SỬA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $page = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    }
                @endphp
                @foreach ($files as $index => $element)
                    <tr class="odd gradeX" align="center">
                        <form>
                            <td>{{ ($page-1)*30 + $index+1 }}</td>
                            <td align="justify">{{ cutTitle($element->title,15) }}</td>
                            <td>{{ $element->loaifile->name }}</td>
                            <td>{{ $element->number }}</td>
                            <td>
                                @if ($element->status ==1)
                                    Có
                                @else
                                    Không
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                            <td class="center" ><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="tep-tin/chinh-sua/{{ $element->id }}.html">Sửa</a></td>
                        </form>
                    </tr>
                  
                @endforeach
                
            </tbody>
        </table>
        {{ $files->links() }}
        </div>
    </div>
</div>


@endsection