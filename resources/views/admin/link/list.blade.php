@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>LIÊN KẾT</small> </h1>

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
                    <th style="width: 5%">TT</th>
                    <th style="width: 43%">TIÊU ĐỀ</th>
                    <th style="width: 40%">ĐƯỜNG DẪN</th>
                    <th style="width: 7%">XÓA</th>
                    <th style="width: 5%">LƯU</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach ($links as $element)
                    @php
                        $i++;
                    @endphp
                    <tr class="odd gradeX" align="center">
                        <form action="{{ route('editLink', ['id'=>$element->id]) }}" method="POST">
                            {{ csrf_field() }}
                            
                            <td>{{ $i }}</td>
                            <td align="justify"><input type="text" name="title" value="{{ $element->title }}" class="form-control" onchange="active({{ $element->id }})" onchange="active({{ $element->id }})"></td>
                            <td align="justify"><input type="url" name="link" value="{{ $element->link }}" onchange="active({{ $element->id }})" class="form-control"></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                            <td><button class="btn btn-success" id="{{ $element->id }}" disabled>LƯU</button></td>
                        </form>
                    </tr>
                  
                @endforeach
                
            </tbody>
        </table>
        {{ $links->links() }}
        </div>
    </div>
</div>


@endsection