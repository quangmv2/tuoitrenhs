@extends('admin.index')
@section('content')
	<div class="container-fluid">
        
        <div class="row">
        	<div class="col-sm-12">
				<h1 style="width: 100%">THÊM MỚI <small>KHẨU HIỆU CHÀO MỪNG</small> </h1>
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
                <form action="{{ route('postAddSlogan') }}" method="POST" enctype="multipart/form-data">
                	{{ csrf_field() }}
		            <div class="form-group">
		                <label>Slogan</label>
		                <input type="text" name="title" value="" class="form-control" placeholder="Slogan" required>
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