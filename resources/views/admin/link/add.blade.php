@extends('admin.index')
@section('content')
	<div class="container-fluid">
        
        <div class="row">
        	<div class="col-sm-12">
				    <h1 style="width: 100%">THÊM MỚI <small>LIÊN KẾT</small> </h1>
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
                <form action="" method="POST" enctype="multipart/form-data">
                	{{ csrf_field() }}
		            <div class="form-group">
		                <label>Tiêu đề</label>
		                <input type="text" name="title" value="" class="form-control" placeholder="Tiêu đề" required>
		            </div>
                <div class="form-group">
                    <label>Liên kết</label>
                    <input type="url" name="link" value="" class="form-control" placeholder="Liên kết" required>
                </div>
		            
		            <input type="submit" name="submit" class="btn btn-primary" value="THÊM MỚI">
		            </form>

            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection