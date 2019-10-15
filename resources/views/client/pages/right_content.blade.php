<div class="col-lg-4 col-md-4 col-sm-4" style="float: right;">
  <aside class="right_content">
    @foreach ($bannerRightContent as $element)
      <div class="single_sidebar wow fadeInDown">
        <h2><span>{{ $element->title }}</span></h2>
        <a class="sideAdd" href="{{ $element->link }}" target="_blank"><img src="{{ asset('uploads/images/banners') }}/{{ $element->image }}" alt="{{ $element->image }}" width="100%"></a> 
      </div>
    @endforeach
     @foreach ($categoryRight as $element)
      <div class="single_sidebar wow fadeInDown">
        <h2><span>{{ $element->name }}</span></h2>
        <a class="sideAdd" href="{{ route('categoryDetail', ['unsigned_title' =>$element->unsigned_name]) }}" ><img src="{{ asset('uploads/images/categorys') }}/{{ $element->image }}" alt="{{ $element->image }}" width="100%"></a> 
      </div>
    @endforeach


    @if (count($videos)>0)
      <div class="single_sidebar wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
          <h2 class="box_main"><span>Video</span></h2>
          <div id="video">
            <div id="content_video">
             <iframe width="100%" height="162px" class="embed-player" src="http://www.youtube.com/embed/{{ $videos[0]->link }}?rel=0&amp;autoplay=0" frameborder="0" allowfullscreen=""></iframe>
             <br>
             <ul class="list-video">
              @foreach ($videos as $index =>$element)
                @if ($index == 0)
                  @php
                    continue;
                  @endphp
                @endif
                <li><a style="cursor:pointer;" title="{{ $element->link }}"><i class="fa fa-caret-right fw"></i>&nbsp;{{ $element->title }}</a></li> 
              @endforeach
                                     

              <script>                        
                $(document).ready(function(){
                  $('.list-video li').click(function(){
                    $(this).parent().siblings('.embed-player').attr('src','http://www.youtube.com/embed/'+$(this).children('a').attr('title'));                                     
                  });
                });
              </script>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    @endif

    
    @foreach ($informationHeader as $element)
      <div class="single_sidebar wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
          <h2><span>Bản đồ</span></h2>
          <iframe src="{{ $element->link_map }}" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen=""></iframe>
      </div>
    @endforeach
    
    
    <div class="single_sidebar wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                <h2><span>Facebook</span></h2>
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ftuoitrenhs%2F&amp;tabs=timeline&amp;width=340&amp;height=500&amp;small_header=true&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                {{-- <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMai-V%C4%83n-Quang-1601748876759387%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=341716349608277" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> --}}
            </div>
    <div class="single_sidebar wow fadeInDown">
      <h2><span>Liên kết</span></h2>
      <ul>
        @foreach ($links as $element)
          <li><a href="{{ $element->link }}" target="_blank">{{ $element->title }}</a></li>
        @endforeach
      </ul>
    </div>
  </aside>
</div>