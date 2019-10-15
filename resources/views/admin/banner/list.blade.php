@extends('admin.index')
@section('content')
<div class="container" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">DANH SÁCH <small>BANNER</small> </h1>

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
                    <th style="width: 35%">TIÊU ĐỀ</th>
                    <th style="width: 10%">ẢNH</th>
                    <th style="width: 35%">LINK</th>
                    <th style="width: 5%">VỊ TRÍ</th>                                
                    <th style="width: 3%">HIỂN THỊ</th>
                    <th style="width: 3%">SỬA</th>
                    <th style="width: 3%">XÓA</th>
                    <th style="width: 3%">LƯU</th>
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
                <tr class="odd gradeX" align="center" id="tr{{ $i }}">
                    <form action="{{ route('postEditLiveBanner', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" >
                      <input type="hidden" name="title" value="{{ $element->title }}">
                      <input type="hidden" name="link" value="{{ $element->link }}">
                      <td>{{ $i }}</td>
                      <td align="justify">{{ cutTitle($element->title,10) }}</td>
                      <td width="5%"><img src="{{ asset('uploads/images/banners') }}/{{ $element->image }}"></td>
                      <td width="10%" align="justify"><a href="{{ $element->link }}" target="_blank">{{ $element->link }}</a></td>
                      <td>
                        
                        <select name="order_num" onchange="active({{ $element->id }})">
                          <option selected value="1">Đầu trang</option>
                          <option value="2"
                            @if ($element->order_num == 2)
                              selected 
                            @endif
                          >Giữa trang</option>
                          <option value="3" 
                            @if ($element->order_num > 2)
                              selected 
                            @endif
                          >Bên phải trang</option>
                        </select>

                      </td>                                
                      <td>
                        <select name="status" onchange="active({{ $element->id }})">
                          <option selected value="1">Có</option>
                          <option value="0"
                            @if ($element->status < 1)
                              selected 
                            @endif
                          >Không</option>
                        </select>
                      </td>
                      <td class="center"><i class="fa fa-trash-o  fa-fw" style="color: red"></i><a style="color: red" href="javascript:;" data-toggle="modal" onclick="deleteData('{{ url()->full() }}/xoa/{{ $element->id }}.html')" data-target="#DeleteModal">XÓA</a></td>
                      <td class="center"><i style="color: blue" class="fa fa-pencil fa-fw"></i> <a style="color: blue" href="banner/chinh-sua/{{ $element->id }}.html">SỬA</a></td>
                      <td><button class="btn btn-success" type="submit" disabled id="{{ $element->id }}">LƯU</button></td>
                    </form>
                </tr>
              @endforeach

                
            </tbody>
        </table>
        {{ $list->links() }}
        </div>

        <script type="text/javascript">
          function saveForm(form) {
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var url = form.attr('action');

            $.ajax({

                   type: "POST",
                   url: url,
                   data: form.serialize(), // serializes the form's elements.
                   success: function(data)
                   {
                       alert(data); // show response from the php script.
                   }
                   
                 });
          }
        </script>
    </div>
</div>


@endsection