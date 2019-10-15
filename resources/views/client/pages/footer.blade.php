<footer id="footer">

  <div class="footer_top">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="footer_widget">

          <h2 style="font-family: sans-serif;">QUẬN ĐOÀN NGŨ HÀNH SƠN</h2>

          @foreach ($informationHeader as $element)

            <address>

              <span class="glyphicon glyphicon-home"></span> Địa chỉ: {{ $element->address }}</address>

            <address>

              <span class="glyphicon glyphicon-phone-alt"></span> Số điện thoại: {{ $element->phone_number }}</address>

            <address style="text-align: inherit;">

              <span class="glyphicon glyphicon-envelope"></span> Thư điện tử: {{ $element->email }}</address>

              <address><span class="glyphicon glyphicon-user"></span> Phụ trách: {{ $element->admin }}</address>

          @endforeach

            

        </div>

      </div>

    </div>

  </div>

  <div class="footer_bottom">

  <hr>

    

    <p class="copyright">Copyright © 2019 <a href="">Quận Đoàn Ngũ Hành Sơn</a></p>

    <p class="developer" style="color: #00bfff" title="quandoannguhanhson.org.vn@gmail.com">Design by <a href="https://www.facebook.com/vanquang312" target="_blank">Văn Quang - </a><a href="https://www.facebook.com/drphdiquy" target="_blank">Đình Quý</a></p>

    <style type="text/css">

      .developer a:hover{

        color: #00bfff;

      }

    </style>

  </div>

</footer>