@extends('admin.index')
@section('content')
	<div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
        	<div class="col-sm-12">
        		<h1 style="width: 100%">CHỈNH SỬA <small>VIDEO</small> </h1>
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
                <form action="" method="POST">  
                	{{ csrf_field() }}     
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" name="title" value="{{ $video->title }}" class="form-control" placeholder="Tên video">
                                            </div>
                    <div class="form-group">
                        <label>Liên kết</label>
                        <input type="text" value="{{ $video->link }}" name="link" class="form-control" placeholder="Đường dẫn đến video trên youtube">
                                            </div>
                    <div class="form-group">
                        <label>Thứ tự</label>
                        <input type="number" value="{{ $video->order_num }}" name="order_num" class="form-control" placeholder="Thứ tự">
                    </div>
                    <div class="form-group">
                        <label style="display:block;">Trạng thái</label>
                        <label class="radio-inline"><input checked="checked" type="radio" name="status" value="1">Hiện thị</label>
                        <label class="radio-inline"><input type="radio" name="status" value="0"
                          @if ($video->status == 0)
                            checked 
                          @endif
                        >Không hiện thị</label>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="CẬP NHẬT">
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection