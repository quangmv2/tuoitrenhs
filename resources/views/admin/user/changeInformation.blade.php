@extends('admin.index')
@section('content')
<div class="container-fluid" style="">
	<div class="row">


	    <div class="col-sm-12" >
	        
	         <h1 style="width: 100%">THÔNG TIN <small>TÀI KHOẢN</small> </h1>

	    </div>


	</div>
	<!-- /.row -->
</div>
<div class="container-fluid">
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
			
			
			<form action="" method="POST" accept-charset="utf-8" enctype="multipart/form-data"> 
				<input type="hidden" name="_token" value="{{csrf_token()}}">
	            <div class="form-group">
	                <label>Họ và tên</label>
	                <input type="text" name="name" value="{{ $profile->name }}" class="form-control" placeholder="Họ và tên">              
	            </div>  
	            <div class="form-group">
	                <label>Điện thoại</label>
	                <input type="text" name="phoneNumber" value="{{ $profile->phone_number }}" class="form-control" placeholder="Điện thoại">              
	            </div>  
	            <div class="form-group">
	                <label>Email</label>
	                <input type="email" name="email" value="{{ $profile->email }}" class="form-control" placeholder="Email">               
	            </div>  
	            <div class="form-group">
	                <label>Địa chỉ</label>
	                <input type="text" name="address" value="{{ $profile->address }}" class="form-control" placeholder="Địa chỉ">              
	            </div> 
	            <div class="form-group">
	                <label>Ảnh đại diện</label>
	                <input type="file" name="image" id="imgInp">
		        </div>
	            <img id="blah" src="{{ asset('uploads/images/profiles') }}/{{ $profile->image }}" alt="your image" style="display: block; margin-bottom: 10px" width="25%" />
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
	            <button class="btn btn-primary" type="submit">CÂP NHẬT</button>
	        </form>

		</div>
	</div>
</div>
@endsection