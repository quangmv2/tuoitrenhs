@extends('admin.index')
@section('content')
	<div class="container-fluid">
        
        <div class="row">
        	<div class="col-sm-12">
				<h1 style="width: 100%">CHỈNH SỬA <small>SLIDER</small> </h1>
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
		                <input type="text" name="title" value="{{ $slide->title }}" class="form-control" placeholder="Title" required>
		            </div>
		            <div class="form-group">
		                <label>Tóm tắt</label>
		                <input type="text" name="summary" value="{{ $slide->summary }}" class="form-control" placeholder="Title" required>
		            </div>
		            <div class="form-group">
		                <label>Ảnh đại diện</label>
		                <input type="file" name="image" id="imgInp">
		            </div>
		            <img id="blah" src="{{ asset('uploads/images/slides') }}/{{ $slide->image }}" alt="{{ $slide->image }}" width="25%" />
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
		                <input type="text" value="{{ $slide->link }}" name="link" class="form-control" placeholder="Link slider" required>
		                            </div>
		            <div class="form-group">
		                <label>Thứ tự</label>
		                <input type="number" value="{{ $slide->order_num }}" name="order_num" class="form-control" placeholder="Thứ tự" required>
		            </div>
		            <div class="form-group">
		                <label style="display:block;">Trạng thái</label>
		                <label class="radio-inline"><input checked type="radio" name="status" value="1">Hiện thị</label>
		                <label class="radio-inline"><input type="radio" name="status" value="0"
							@if ($slide->status == 0)
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