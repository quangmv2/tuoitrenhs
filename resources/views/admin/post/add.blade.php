@extends('admin.index')

@section('content')

	<div class="container-fluid" >

        <!-- Page Heading -->



		



        <div class="row">

        	<div class="col-sm-12">

        		<h1 style="width: 100%">THÊM MỚI <small>BÀI VIẾT</small> </h1>

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

                <form action="{{ route('postAddPost') }}" method="POST" enctype="multipart/form-data">

                	{{ csrf_field() }}

                    

                    <div class="form-group">

		                <label>Tiêu đề</label>

		                <input type="text" name="title" value="" id="title" class="form-control" placeholder="Tiêu đề">

		            </div>

		            <div class="form-group">

		                <label style="display:block;">Danh mục</label>

		                <select name="category" class="form-control">

		                	@foreach ($category as $element)

		                		@if ($element->menu == 1)

		                			@php

		                				$acc = session('account');

		                				if ($acc->type != 1)

		                					continue;

		                			@endphp

		                		@endif

		                		<option value="{{ $element->id }}">

		                			{{ getTitleCategory($element) }}

		                		</option>

		                	@endforeach

		                </select>

		             </div>

		            <div class="form-group">

		                <label>Ảnh đại diện</label>

		                <input type="file" name="image" class="form-control" id="imgInp">

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

		                <label style="display:block;">Tóm tắt</label>

		                <textarea name="summary" class="form-control" style="Width:100%;height:150px;" placeholder="Tóm tắt..."></textarea>

		            </div>

		            

		            <div class="form-group">

				         <label>Nội dung</label>

				         <textarea name="content" class="form-control" id="editor1" placeholder="Nội dung..." rows="100" ></textarea>

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

		                <label style="display:block;">Ngày đăng</label>

		                <input type="datetime-local" name="date" id="datepicker" placeholder="" class="form-control">

		            </div>

		            <button type="submit" class="btn btn-primary" >THÊM MỚI</button>

        		</form>

            </div>

        </div>

        <!-- /.row -->

    </div>

@endsection