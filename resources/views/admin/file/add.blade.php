@extends('admin.index')
@section('content')
	<div class="container-fluid">
        
        <div class="row">
        	<div class="col-sm-12">
				<h1 style="width: 100%">THÊM MỚI <small>TẬP TIN</small> </h1>
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
                <form action="" method="POST" enctype="multipart/form-data">
                	{{ csrf_field() }}
		            <div class="form-group">
		                <label>Tiêu đề</label>
		                <input type="text" name="title" value="" class="form-control" placeholder="Tiêu đề" required>
		            </div>
                <div class="form-group">
                    <label>Loại</label>
                    <select name="category" class="form-control">
                        <option value="1">Đoàn TNCS Hồ Chí Minh</option>
                        <option value="2">Đội TNTP Hồ Chí Minh</option>
                        <option value="3">Hội LHTN Việt Nam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Số/Ký hiệu</label>
                    <input type="text" name="number" value="" class="form-control" placeholder="Số/Ký hiệu" >
                </div>
                <div class="form-group">
                    <label>Tệp tin</label>
                    <input type="file" name="file" value="" class="form-control-file" placeholder="" required>
                </div>
		            <div class="form-group">
		                <label style="display:block;">Trạng thái</label>
		                <label class="radio-inline"><input class="form-check-inline" checked="checked" type="radio" name="status" value="1">Hiển thị</label>
		                <label class="radio-inline"><input class="form-check-inline" type="radio" name="status" value="0">Không hiển thị</label>
		            </div>
                <div class="form-group">
                    <label style="display:block;">Ngày đăng</label>
                    <input type="datetime-local" name="date" placeholder="" class="form-control">
                </div>
		            <input type="submit" name="submit" class="btn btn-primary" value="THÊM MỚI">
		        </form>

            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection