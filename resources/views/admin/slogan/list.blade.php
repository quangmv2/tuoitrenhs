@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>KHẨU HIỆU CHÀO MỪNG</small> </h1>

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
                    <th style="width: 73%">NỘI DUNG</th>
                    <th style="width: 8%">HIỂN THỊ</th>
                    <th style="width: 8%">XÓA</th>
                    <th style="width: 8%">SỬA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach ($slogans as $element)
                    @php
                        $i++;
                    @endphp
                    <tr class="odd gradeX" align="center">
                 
                        <td>{{ $i }}</td>
                        <td align="justify">{{ $element->title }}</td>
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
                        <td class="center"><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="slogan/chinh-sua/{{ $element->id }}.html">SỬA</a></td>
                    </tr>
                  
                @endforeach
                
            </tbody>
        </table>
        {{ $slogans->links() }}
        </div>
    </div>
</div>


@endsection