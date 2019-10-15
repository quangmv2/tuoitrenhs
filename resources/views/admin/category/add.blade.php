@extends('admin.index')
@section('content')
	<div class="container-fluid">
        <!-- Page Heading -->
        
        <div class="row">
        	<div class="col-lg-12">
        		<h1 style="width: 100%">THÊM MỚI <small>DANH MỤC</small> </h1>
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
               <form method="POST" enctype="multipart/form-data">
               		<input type="hidden" name="_token" value="{{csrf_token()}}">
                   
		            <div class="form-group">
		                <label>Danh mục bài viết</label>
		                <input type="text" name="name" value="" class="form-control" placeholder="Danh mục bài viết">
		            </div>
		            <div class="form-group">
		                <label>Danh mục</label>
		                <select name="category" class="form-control">
		                	<option value="0">GỐC</option>
		                	@foreach ($category as $element)
		                		<option value="{{ $element->id }}">{{ getTitleCategory($element) }}</option>
		                	@endforeach
		                </select>
		            </div>
		            <div class="form-group">
		                <label>Ảnh đại diện</label>
		                <input type="file" name="imagecate" id="imgInp" >
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
		                <label style="display:block;">Hiển thị Menu</label>
		                <label class="radio-inline"><input type="radio" name="menu" value="1">Hiển thị</label>
		                <label class="radio-inline"><input checked="checked" type="radio" name="menu" value="0">Không hiển thị</label>
		            </div>
		            <div class="form-group">
		                <label style="display:block;">Hiển thị Home</label>
		                <label class="radio-inline"><input type="radio" name="home" value="1">Hiển thị</label>
		                <label class="radio-inline"><input checked="checked" type="radio" name="home" value="0">Không hiển thị</label>
		            </div>
		            <div class="form-group">
		                <label style="display:block;">Hiển thị Bên phải trang</label>
		                <label class="radio-inline"><input type="radio" name="right_home" value="1" >Hiển thị</label>
		                <label class="radio-inline"><input type="radio" name="right_home" value="0" checked>Không hiển thị</label>
		            </div>
		            <div class="form-group">
		                <label>Thứ tự</label>
		                <input type="number" value="{{ $max }}" name="order_num" class="form-control" placeholder="Thứ tự">
		            </div>
		            <div class="form-group">
		                <label style="display:block;">Trạng thái</label>
		                <label class="radio-inline"><input checked="checked" type="radio" name="status" value="1">Hiển thị</label>
		                <label class="radio-inline"><input type="radio" name="status" value="0">Không hiển thị</label>
		            </div>
		            <button type="submit" class="btn btn-primary">THÊM MỚI</button>
		        </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection