@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>TÀI KHOẢN</small> </h1>

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
                    <th style="width: 20%">TÊN ĐĂNG NHẬP</th>
                    <th style="width: 25%">HỌ VÀ TÊN</th>
                    <th style="width: 10%">ĐIỆN THOẠI</th>
                    <th style="width: 20%">EMAIL</th>
                    <th style="width: 10%">ĐỊA CHỈ</th>                                
                    <th style="width: 3%">HOẠT ĐỘNG</th>
                    <th style="width: 3%">MẬT KHẨU</th>
                    <th style="width: 3%">XÓA</th>
                    <th style="width: 3%">SỬA</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @foreach ($listUser as $value)
                    @php
                        $i++;
                    @endphp
                    @if ($value->username == 'admin')
                        @php
                            continue;
                        @endphp
                    @endif
                    <tr class="odd gradeX" align="center">
                        <td>{{ $i }}</td>
                        <td align="justify">{{ $value->username }}</td>
                        <td align="justify">{{ $value->profile->name }}</td>
                        <td>{{ $value->profile->phone_number }}</td>
                        <td align="justify">{{ $value->profile->email }}</td>
                        <td align="justify">{{ cutTitle($value->profile->address,9) }}</td>
                        <td>
                            @if ($value->status == 0)
                                Không
                            @else
                                Có
                            @endif
                        </td>
                        <td class="center"><i style="color: green" class="fa fa-repeat fa-fw"></i> <a style="color: green" href="user/reset-pass/{{ $value->username }}">ĐẶT LẠI</a></td>
                        
                        <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ route('deleteUser', ['username'=>$value->username]) }}')" data-target="#DeleteModal"> XÓA</a></td>
                        <td class="center"><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="user/chinh-sua/{{ $value->username }}">SỬA</a></td>
                    </tr>
                                    
                @endforeach
               
            </tbody>
        </table>

        {{ $listUser->links() }}

        </div>

    </div>
</div>


@endsection
