@extends('admin.index')
@section('content')
	<div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">

        	<div class="col-lg-12">
        		<h1 style="width: 100%">CHỈNH SỬA <small>BANNER</small> </h1>
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
                <form action="{{ route('postEditBanner', ['unsigned_title'=>$banner->unsigned_title, 'id'=>$banner->id]) }}" method="POST" enctype="multipart/form-data">
                	{{ csrf_field() }}
                	
		            <div class="form-group">
		                <label>Tiêu đề</label>
		                <input type="text" name="title" value="{{ $banner->title }}" class="form-control" placeholder="Tiêu đề">
		            </div>
		            <div class="form-group">
		                <label>Ảnh đại diện</label>
		                <input type="file" name="image" id="imgInp" placeholder="{{ $banner->image }}">
		            </div>
		            <img id="blah" src="{{ asset('uploads/images/banners') }}/{{ $banner->image }}" alt="{{ $banner->image }}" width="40%" />
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
		                <input type="text" value="{{ $banner->link }}" name="link" class="form-control" placeholder="Liên kết banner">
		            </div>
		            <div class="form-group">
		                <label>Vị trí</label>
		                <select name="order_num" class="form-control">
		                	<option value="1" selected>Đầu trang</option>
		                	<option value="2"
								@if ($banner->order_num == 2)
	                            	selected 
	                          	@endif
		                	>Giữa trang</option>
		                	<option value="3"
								@if ($banner->order_num > 2)
		                            selected 
		                         @endif
		                	>Bên phải trang</option>
		                </select>
		            </div>
		            <div class="form-group">
		                <label style="display:block;">Trạng thái</label>
		                <label class="radio-inline"><input checked="checked" type="radio" name="status" value="1">Hiển thị</label>
		                <label class="radio-inline"><input type="radio" name="status" value="0" 
									                	@if ($banner->status < 1)
							                            	checked
							                          	@endif
                          							>Không hiển thị</label>
		            </div>
		            <input type="submit" name="submit" class="btn btn-primary" value="CẬP NHẬT">
		        </form>

            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection