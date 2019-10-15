<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }} - Hệ thống quản lý website Quận đoàn NHS</title>
 
    <meta name="description" content="Hệ thống quản lý website">
    
    <meta name="viewport" content="width=device-width, initial-scale=0">

    @php
        use App\Information;
        $info = Information::all();
    @endphp

    @if (count($info) > 0)
        <link rel="shortcut icon" href="{{ asset('uploads/images/system') }}/{{ $info[0]->icon }}" />
    @endif
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/jqvmap/dist/jqvmap.min.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style type="text/css">
           .navbar .navbar-nav li > a {
                font-family: inherit;
           }

           .pagination {
                float: right;
           }

    </style>
    

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148877286-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-148877286-1');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148952743-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-148952743-1');
    </script>


    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    

    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <script src="{{ asset('vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/widgets.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
   

</head>

<body>


    <!-- Left Panel -->

    @include('admin.pages.menu')
    
   <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

 

    <div id="right-panel" class="right-panel">

    <!-- Header-->
    @include('admin.pages.header')
    <!-- /header -->
    <!-- Header-->
    @yield('content')
    </div><!-- /#right-panel -->

    <div id="DeleteModal" class="modal fade text-danger" role="dialog">
       <div class="modal-dialog ">
         <!-- Modal content-->
             <div class="modal-content">
                 <div class="modal-header bg-danger">
                     <h4 class="modal-title text-center" style="color: white; float: left; float: left;
                                            margin-top: auto;
                                            margin-bottom: auto;
                                            margin-left: 10px;
                                            margin-right: 10px;">XÁC NHẬN XÓA</h4>
                     <button type="button" class="close" data-dismiss="modal" style="margin: auto; margin-left: 0; margin-right: 0">&times;</button>
                    
                 </div>
                 <div class="modal-body">
                     <p class="text-center">Bạn có chắc chắn muốn xóa không?</p>
                     <a href="" id="delete-a"></a>
                 </div>
                 <div class="modal-footer">
                     <center>
                         <button type="button" class="btn btn-success"data-dismiss="modal" >Hủy</button>
                         <button type="button" class="btn btn-danger"  onclick="formSubmit()">Đồng ý, Xóa</button>
                     </center>
                 </div>
             </div>
       </div>
      </div>

      {{-- <a href="javascript:;" data-toggle="modal" onclick="deleteData('delete')" 
        data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a> --}}
    
    <script type="text/javascript">
         function deleteData(url)
         {
            
            document.getElementById("delete-a").href=url;
         }

         function formSubmit()
         {
             url = document.getElementById("delete-a").getAttribute("href");
             window.location = url
         }
      </script>


    
  {{-- Script --}}
  <script type="text/javascript">
          
    function active(id) {
      let button = document.getElementById(id);
      button.disabled = false;
    }

  </script>
</body>
</html>