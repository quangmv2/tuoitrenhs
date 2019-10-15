@extends('admin.index')
@section('content')
	<div class="container-fluid">
        
        <div class="row">
        	<div class="col-sm-12">
				<h1 style="width: 100%">THÊM MỚI <small>SLIDER</small> </h1>
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
            <div class="col-lg-12">
                <form action="{{ route('postAddSlide') }}" method="POST" enctype="multipart/form-data">
                	{{ csrf_field() }}
                    
		            <div class="form-group">
		                <label>Tiêu đề</label>
		                <input type="text" name="title" value="" class="form-control" placeholder="Title" required>
		            </div>
		            <div class="form-group">
		                <label>Tóm tắt</label>
		                <input type="text" name="summary" value="" class="form-control" placeholder="Title" required>
		            </div>
		            <div class="form-group">
		                <label>Ảnh đại diện</label>
		                <input type="file" name="image" id="imgInp" required>
		            </div>
		            <img id="blah" src="#" alt="your image" style="display: none;" width="25%" />
					<script type="text/javascript">
						function readURL(input) {
						  if (input.files && input.files[0]) {
						    var reader = new FileReader();
						    
						    reader.onload = function(e) {
						      $('#blah').attr('src', e.target.result);
						    }
						    
						    reader.readAsDataURL(input.files[0]);
						  }
						}
						$("#imgInp").change(function() {
						  readURL(this);
						 $('#blah').show();
						});
					</script>
		            <div class="form-group">
		                <label>Liên kết</label>
		                <input type="text" value="" name="link" class="form-control" placeholder="Link slide" required>
		                            </div>
		            <div class="form-group">
		                <label>Thứ tự</label>
		                <input type="number" value="" name="order_num" class="form-control" placeholder="Thứ tự" required>
		            </div>
		            <div class="form-group">
		                <label style="display:block;">Trạng thái</label>
		                <label class="radio-inline"><input checked="checked" type="radio" name="status" value="1">Hiển thị</label>
		                <label class="radio-inline"><input type="radio" name="status" value="0">Không hiển thị</label>
		            </div>
		            <input type="submit" name="submit" class="btn btn-primary" value="THÊM MỚI">
		        </form>

            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection