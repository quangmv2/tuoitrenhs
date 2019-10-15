@extends('admin.index')
@section('content')
	<div class="container-fluid">
        
        <div class="row">
        	<div class="col-sm-12">
				<h1 style="width: 100%">THÔNG TIN <small>WEBSITE</small> </h1>
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
            	
            	@if (count($information) < 1)
            		<form action="" method="POST" enctype="multipart/form-data">
                		{{ csrf_field() }}
                		<div class="form-group">
					         <label>Giới thiệu</label>
					         <textarea name="about" class="form-control" id="editor1" placeholder="Nội dung..."></textarea>
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
						<div class="form-group">
					         <label>Cơ cấu tổ chức</label>
					         <textarea name="organization" class="form-control" id="editor2" placeholder="Nội dung..."></textarea>
					         <script>
								CKEDITOR.replace( 'editor2',{
								        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
								        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
								        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
								        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
								        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
								        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
								    } );
		            		</script>
						</div>
                		<div class="form-group">
			                <label>Biểu tượng</label>
			                <input type="file" name="image" id="imgInp">
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
			                <label>Ảnh nền</label>
			                <input type="file" name="image" id="imgInp1">
			            </div>
			            <img id="blah1" src="" style="display: none;" width="25%" />
						<script type="text/javascript">
							function readURL1(input) {
							  if (input.files && input.files[0]) {
							    var reader = new FileReader();
							    
							    reader.onload = function(e) {
							      $('#blah1').attr('src', e.target.result);
							    }
							    
							    reader.readAsDataURL(input.files[0]);
							  }
							}
							$("#imgInp1").change(function() {
							  readURL1(this);
							 $('#blah1').show();
							});
						</script>
			            <div class="form-group">
			                <label>Facebook</label>
			                <input type="text" name="fb" value="" class="form-control" placeholder="Liên kết đến trang Facebook của bạn" required>
			            </div>
			            <div class="form-group">
			                <label>Youtube</label>
			                <input type="text" name="yt" value="" class="form-control" placeholder="Liên kết đến trang Youtube của bạn" required>
			            </div>
			            <div class="form-group">
			                <label>Bản đồ</label>
			                <input type="text" name="map" value="" class="form-control" placeholder="Liên kết đến Bản đồ địa chỉ của bạn" required>
			            </div>
			            <div class="form-group">
			                <label>Email</label>
			                <input type="text" name="email" value="" class="form-control" placeholder="Email" required>
			            </div>
			            <div class="form-group">
			                <label>Địa chỉ</label>
			                <input type="text" name="address" value="" class="form-control" placeholder="Địa chỉ" required>
			            </div>
			            <div class="form-group">
			                <label>Số điện thoại</label>
			                <input type="text" name="phone_number" value="" class="form-control" placeholder="Số điện thoại" required>
			            </div>
			            <div class="form-group">
			                <label>Phụ trách</label>
			                <input type="text" name="admin" value="" class="form-control" placeholder="Phụ trách" required>
			            </div>
			            <input type="submit" name="submit" class="btn btn-primary" value="Thêm mới">
			        </form>
            	@else
                @foreach ($information as $element)
                	<form action="" method="POST" enctype="multipart/form-data">
                		{{ csrf_field() }}
                		<div class="form-group">
					         <label>Giới thiệu</label>
					         <textarea name="about" class="form-control" id="editor1" placeholder="Nội dung...">{{ $element->about }}</textarea>
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
						<div class="form-group">
					         <label>Cơ cấu tổ chức</label>
					         <textarea name="organization" class="form-control" id="editor2" placeholder="Nội dung...">{{ $element->organization }}</textarea>
					         <script>
								CKEDITOR.replace( 'editor2',{
								        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
								        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
								        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
								        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
								        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
								        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
								    } );
		            		</script>
						</div> 
                		<div class="form-group">
			                <label>Biểu tượng</label>
			                <input type="file" name="image" id="imgInp">
			            </div>
			            <img id="blah" src="{{ asset('uploads/images/system') }}/{{ $element->icon }}" alt="{{ $element->icon }}" width="25%" />
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
			                <label>Ảnh nền</label>
			                <input type="file" name="image_background" id="imgInp1">
			            </div>
			            <img id="blah1" src="{{ asset('uploads/images/system') }}/{{ $element->image_background }}" alt="{{ $element->image_background }}" width="25%" />
						<script type="text/javascript">
							function readURL1(input) {
							  if (input.files && input.files[0]) {
							    var reader = new FileReader();
							    
							    reader.onload = function(e) {
							      $('#blah1').attr('src', e.target.result);
							    }
							    
							    reader.readAsDataURL(input.files[0]);
							  }
							}
							$("#imgInp1").change(function() {
							  readURL1(this);
							 $('#blah1').show();
							});
						</script>
			            <div class="form-group">
			                <label>Facebook</label>
			                <input type="text" name="fb" value="{{ $element->link_fb }}" class="form-control" placeholder="Slogan" required>
			            </div>
			            <div class="form-group">
			                <label>Youtube</label>
			                <input type="text" name="yt" value="{{ $element->link_youtube }}" class="form-control" placeholder="Slogan" required>
			            </div>
			            <div class="form-group">
			                <label>Bản đồ</label>
			                <input type="text" name="map" value="{{ $element->link_map }}" class="form-control" placeholder="Bản đồ" required>
			            </div>
			            <div class="form-group">
			                <label>Email</label>
			                <input type="text" name="email" value="{{ $element->email }}" class="form-control" placeholder="Email" required>
			            </div>
			            <div class="form-group">
			                <label>Địa chỉ</label>
			                <input type="text" name="address" value="{{ $element->address }}" class="form-control" placeholder="Slogan" required>
			            </div>
			            <div class="form-group">
			                <label>Số điện thoại</label>
			                <input type="text" name="phone_number" value="{{ $element->phone_number }}" class="form-control" placeholder="Slogan" required>
			            </div>
			            <div class="form-group">
			                <label>Phụ trách</label>
			                <input type="text" name="admin" value="{{ $element->admin }}" class="form-control" placeholder="Phụ trách" required>
			            </div>
			            <input type="submit" name="submit" class="btn btn-primary" value="CẬP NHẬT">
			        </form>
                @endforeach
				@endif
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection