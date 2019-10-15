@extends('admin.index')
@section('content')
<div class="container-fluid" style="margin-left: 0px;">
    <div class="row">
    

        <div class="col-sm-12" >
            
             <h1 style="width: 100%">PHẢN HỒI <small>LIÊN HỆ</small> </h1>

        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div class="container" style="margin-top: 10px;">
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
          <div>
            <form action="" name="frmadd_video" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Họ và tên người liên hệ</label>
                    <input type="text" name="name" value="{{ $contact->name }}" class="form-control" placeholder="Tên người liên hệ" required disabled>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" value="{{ $contact->phone_number }}" name="phone_number" class="form-control" placeholder="Số điện thoại người liên hệ" required disabled>
                </div>
                <div class="form-group">
                    <label>Thư điện tử</label>
                    <input type="text" value="{{ $contact->email }}" name="email" class="form-control" placeholder="Nhập email người liên hệ" required disabled>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea type="text" name="content" class="form-control" placeholder="Nhập nội dung cần trao đổi" required disabled>{{ $contact->content }}</textarea>
                </div>
                <div class="form-group">
                       <label>Nội dung phản hồi</label>
                       <textarea name="contentfb" class="form-control" id="editor1" placeholder="Nội dung...">{{ $contact->contentfb }}</textarea>
                       <script>
                    CKEDITOR.replace( 'editor1',{
                            filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
                            filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
                            filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
                            filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                            filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                            filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
                        } );
                        </script>
                </div> 
                <button class="btn btn-success" type="submit">GỬI</button>
            </form>
          </div>
            
        </div>

    </div>
</div>


@endsection