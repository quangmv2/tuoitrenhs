<div class="col-lg-4 col-md-4 col-sm-4">
  <div class="latest_post">
    <h2><span>Tin mới nhất</span></h2>
    <div class="latest_post_container">
      <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
      <ul class="latest_postnav">
          @foreach ($postNew as $element)
            <li>
              <div class="media"> <a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" class="media-left"> <img alt="{{ $element->image }}" src="{{ asset('uploads/images/posts') }}/{{ $element->image }}"> </a>
                <div class="media-body"> <a href="{{ route('postDetail', ['unsigned_title'=>$element->unsigned_title, 'id'=>$element->id]) }}" class="catg_title" style="text-transform: uppercase;">{{ cutTitle($element->title, 20) }}</a> </div>
              </div>
            </li>
          @endforeach
      </ul>
      <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
    </div>
  </div>
</div>