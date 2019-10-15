    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('adminHome') }}" style="font-family: sans-serif; text-align: center;">QUẢN TRỊ HỆ THỐNG</a>
                <a class="navbar-brand hidden" href="{{ route('adminHome') }}"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ route('home') }}" target="_blank" style="text-align: center;">
                        @php
                             use App\Information;
                             $information = Information::all();

                         @endphp 
                         @if (count($information)>0)
                             <img src="{{ asset('uploads/images/system') }}/{{ $information[0]->icon }}" width="50%">
                        quandoannguhanhson.org.vn</a>
                         @endif
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Danh mục</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('categoryList') }}">Danh sách danh mục</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddCategory') }}">Thêm danh mục</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Bài viết</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('posts') }}">Danh sách bài viết</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddPost') }}">Thêm bài viết</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getPassPost') }}">Phê duyệt bài viết</a></li>
                            
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Tập tin</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('files') }}">Danh sách tập tin</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddFile') }}">Thêm tập tin</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Banner</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('banner') }}">Danh sách banner</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddBanner') }}">Thêm banner</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Slide</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('slide') }}">Danh sách slide</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddSlide') }}">Thêm Slide</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Slogan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('slogan') }}">Danh sách Slogan</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddSlogan') }}">Thêm Slogan</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Liên kết</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('links') }}">Danh sách liên kết</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddLink') }}">Thêm liên kết</a></li>
                            
                        </ul>
                    </li>
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Video</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('video') }}">Danh sách video</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('getAddVideo') }}">Thêm video</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Tài khoản</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('adminUser') }}">Danh sách tài khoản</a></li>
                            <li><i class="fa fa-file-word-o"></i><a href="{{ route('adminUsergetAdd') }}">Thêm tài khoản</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="{{ route('infomation') }}" class="dropdown-toggle"><i class="menu-icon fa fa-laptop"></i>Thông tin</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="{{ route('contactList') }}" class="dropdown-toggle"><i class="menu-icon fa fa-laptop"></i>Liên hệ</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

