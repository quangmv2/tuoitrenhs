@extends('admin.index')
@section('content')
<div class="container-fluid" style="">
	<div class="row">


	    <div class="col-sm-12" >
	        
	         <h1 style="width: 100%">THÊM MỚI <small>TÀI KHOẢN</small> </h1>

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
			
			
			<form action="{{ route('adminUserpostAdd') }}" method="POST" accept-charset="utf-8"> 
				<input type="hidden" name="_token" value="{{csrf_token()}}">
	            <div class="form-group">
	                <label>Họ và tên</label>
	                <input type="text" name="name" value="" class="form-control" placeholder="Họ và tên">              
	            </div>  
	            <div class="form-group">
	                <label>Điện thoại</label>
	                <input type="text" name="phoneNumber" value="" class="form-control" placeholder="Điện thoại">              
	            </div>  
	            <div class="form-group">
	                <label>Email</label>
	                <input type="email" name="email" value="" class="form-control" placeholder="Email">               
	            </div>  
	            <div class="form-group">
	                <label>Địa chỉ</label>
	                <input type="text" name="address" value="" class="form-control" placeholder="Địa chỉ">              
	            </div>  
	            
	            <div class="form-group">
	                <label>Chọn quyền</label>
	                <div class="row">
	                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                        <input type="checkbox" name="chkfull" onclick="checkAll()">
	                        <label>Full quyền</label>
	                    </div>
	                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                        <input type="checkbox" name="chkfull" onclick="uncheckAll()">
	                        <label>Bỏ chọn</label>
	                    </div>
	                </div>
	                <div class="row">
	                    

                        @foreach ($role as $element)
                        	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	                            <div class="role_item">
	                                <input type="checkbox" name="chrole[]" class="chrole" value='{{ $element->id }}'>
	                                <label>Quản lý {{ $element->nameRole }}</label>
	                            </div>
	                        </div>
                        @endforeach
	                    <script type="text/javascript">
	                    	function checkAll(argument) {
	                    		var checkboxes = document.getElementsByName('chrole[]');
				                for (var i = 0; i < checkboxes.length; i++){
				                    checkboxes[i].checked = true;
				                }
	                    	}
	                    	function uncheckAll(argument) {
	                    		var checkboxes = document.getElementsByName('chrole[]');
				                for (var i = 0; i < checkboxes.length; i++){
				                    checkboxes[i].checked = false;
				                }
	                    	}
	                    </script>                            
	                                                
	                                               
	                 </div>
	            </div>              
	            <div class="form-group">
	                <label style="display:block;">Trạng thái</label>
	                <label class="radio-inline"><input checked="checked" type="radio" name="status" value="1">Hoạt động</label>
	                <label class="radio-inline"><input type="radio" name="status" value="0">Không hoạt động</label>
	            </div>
	            <button class="btn btn-primary" type="submit">THÊM MỚI</button>
	        </form>

		</div>
	</div>
</div>
@endsection