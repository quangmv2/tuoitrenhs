@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>LIÊN HỆ</small> </h1>

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
                      <th style="width: 30%">HỌ TÊN</th>
                      <th style="width: 15%">SỐ ĐIỆN THOẠI</th>
                      <th style="width: 27%">EMAIL</th>
                      <th style="width: 10%">PHẢN HỒI</th>
                      <th style="width: 5%">XÓA</th>
                      <th style="width: 10%">TRẢ LỜI</th>
                  </tr>
              </thead>
              <tbody>
                @php
                  $i = 0;
                @endphp
                @foreach ($list as $element)
                  @php
                    $i++;
                  @endphp
                  <tr class="odd gradeX" align="center">
                      <td {{ $i }}</td>
                      <td align="justify">{{ $element->name }}</td>
                      <td>{{ $element->phone_number }}</td>
                      <td align="justify">{{ $element->email }}</td>
                      <td>
                        @if ($element->status < 1)
                          CHƯA
                        @else
                          RỒI
                        @endif
                      </td>
                      <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal"> XÓA</a></td>
                      <td><button class="btn btn-success" onclick="window.location = '{{ route('contactList') }}/phan-hoi/{{ $element->id }}'">XEM</button></td>
                  </tr>
                @endforeach

                  
              </tbody>
          </table>
          {{ $list->links() }}
        </div>

    </div>
</div>


@endsection