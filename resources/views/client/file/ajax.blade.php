<table class="table table-bordered table-striped mb-0">
      <thead style="background: #00bfff">
        <tr>
          <th scope="col" style="text-align: center;">TT</th>
          <th scope="col" style="text-align: center;">TÊN VĂN BẢN</th>
          <th scope="col" style="text-align: center;">SỐ/KÝ HIỆU</th>
          <th scope="col" style="text-align: center;">NGÀY BAN HÀNH</th>
          <th scope="col" style="text-align: center;">TẢI VỀ</th>
        </tr>
      </thead>
      <tbody>
          @php
            $page = 1;
            if (isset($_GET['page'])){
              $page = $_GET['page'];
            }
          @endphp  
          @foreach ($files as $index => $element)
            <tr>
              <!--<th scope="row" style="text-align: center;">{{ $index + 1 }}</th>-->
              <td style="text-align: center;width: 5%">{{ ($page-1)*25 + $index + 1 }}</td>
              <td style="text-align: justify; width: 50%">{{ $element->title }}</td>
              <td style="text-align: center;width: 15%">{{ $element->number }}</td>
              <td style="text-align: center;width: 20%">{{ $element->created_at->format('d/m/Y') }}</td>
              <td style="text-align: center;width: 10%">
                <a href="{{ asset('uploads/files/post') }}/{{ $element->file }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
              </td>
            </tr>
          @endforeach
          
        
      </tbody>
    </table>
  <div style="float: right;">
    {{ $files->links() }}
  </div>   