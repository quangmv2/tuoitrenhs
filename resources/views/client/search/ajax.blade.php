
<h2>Kết quả tìm kiếm cho "{{ $result }}"</h2>

<h5>Tìm kiếm được {{ $count }} kết quả trong {{ $time }}s</h5>

<div class="row">

	@foreach ($postss as $index => $value)

		<div class="col-sm-6 col-lg-6 col-md-6 col-xl-6">

			<div class="news clearfix">

			   <a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}"><img src="{{ asset('uploads/images/posts') }}/{{ $value->image }}" alt="{{ $value->title }}">    <div class="time-l">

			    	<p class="time-tab-r"><i style="margin-right:5px;    vertical-align: baseline;" class="fa fa-calendar" aria-hidden="true"></i>{{ $value->created_at->format('d/m/Y') }}<span style="margin:0px 5px"></span><span><i class="fa fa-user"> {{ $value->name_author }}</i></span> <span class="views"><i class="fa fa-eye" aria-hidden="true"></i> {{ $value->view }}</span></p>

			    </div>

			    </a><div class="info-news"><a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}">

			        </a>

			        	<h5>

			        		<a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}" title="{{ $value->title }}">

			        			

			        		</a>

			        		<a href="{{ route('postDetail', ['unsigned_title'=>changeUrl($value->loaitin), 'id'=>$value->id]) }}">{{ $value->title }}

			        		</a>

			        	</h5>

			       	</a>

			        <p style="color:#8e8e8e">

			        	@php

			        		$str = explode(" ", $value->summary);

			        		$i=0;

			        		foreach ($str as $element) {

			        			$i++;

			        			if ($i==20) {

			        				echo $element;

			        				break;

			        			}

			        			echo $element." ";

			        		}

			        	@endphp

			        ... </p>

			    </div>

			</div>

		</div>


	@endforeach

	<div style="float: right;">

		{{ $postss->links() }}

	</div>

</div>

