@extends('admin.index')
@section('content')
<div class="container-fluid" style="">
	<div class="row">


	    <div class="col-sm-12" >
	        
{{-- 	         <h1 style="width: 100%">Tài khoản <small>{{ $user->username }}</small> </h1>
 --}}
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
			<form action="{{ route('postChangePass') }}" class="form-group" method="post">
				{{ csrf_field() }}
				<fieldset>
					<div class="form-group">
		                <label>Mật khẩu cũ</label>
		                <input type="password" name="oldPass" class="form-control" placeholder="Mật khẩu cũ" required>              
		            </div>  
		            <div class="form-group">
		                <label>Mật khẩu mới</label>
		                <input type="password" name="newPass" class="form-control" placeholder="Mật khẩu mới" id="password" required>              
		            </div>
		            <div class="form-group">
		                <label>Xác nhận mật khẩu</label>
		                <input type="password" placeholder="Xác nhận mật khẩu" id="confirm_password" class="form-control" onchange="validatePassword()" required>
		            </div>
		            <button class="btn btn-primary" type="submit" style="float: right;">Câp nhật</button>
				</fieldset>

			</form>  
		</div>
		
	</div>
</div>
<script type="text/javascript">
	var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

	function validatePassword(){
	  if(password.value != confirm_password.value) {
	    confirm_password.setCustomValidity("Mật khẩu không đúng");
	    console.log('1')
	  } else {
	    confirm_password.setCustomValidity('');
	  }
	}

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
</script>
@endsection