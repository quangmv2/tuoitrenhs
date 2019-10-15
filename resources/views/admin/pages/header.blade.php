<header id="header" class="header">



    <div class="header-menu">



        <div class="col-sm-7">

            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>

            <div class="header-left">

                <div class="dropdown for-notification">

                    <button class="btn btn-secondary dropdown-toggle" onclick="window.location = '{{ route('adminUser') }}';">

                        <i class="fa fa-user"></i>

                        <span class="count bg-danger">

                            @php

                                use App\User;

                                $us = User::where('status', 0)->get();

                                echo count($us);

                            @endphp

                        </span>

                    </button>

                    

                </div>



                <div class="dropdown for-message">

                    <button class="btn btn-secondary dropdown-toggle" onclick="window.location = '{{ route('contactList') }}';">

                        <i class="ti-email"></i>

                        <span class="count bg-primary">

                            @php

                                use App\Contact;

                                $contt = Contact::where('status', 0)->get();

                                echo count($contt);

                            @endphp

                        </span>

                    </button>

                </div>



                <div class="dropdown for-notification">

                    <button class="btn btn-secondary dropdown-toggle" onclick="window.location = '{{ route('getPassPost') }}';">

                        <i class="fa fa-bell"></i>

                        <span class="count bg-danger">

                            @php

                                use App\Post;

                                $postt = Post::where('active', 0)->get();

                                echo count($postt);

                            @endphp

                        </span>

                    </button>

                </div>



                

            </div>

        </div>



        <div class="col-sm-5">

            <div class="user-area dropdown float-right">

                @php

                    use App\Profile;

                    if (session('account')->username != "admin") {

                         $profiless = Profile::where('username_profile', session('account')->username)->get();

                        if (count($profiless) < 1) return redirect()->route('adminHome');

                        $profiless = $profiless[0];

                    }

                @endphp

                <div class="float-right dropdown-toggle" style="margin-top: 5px; padding: 5; margin-left: 5px; cursor: pointer;" class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    @if (session('account')->username == 'admin')

                        admin

                    @else

                        {{ $profiless->name }} ({{ session('account')->username }})

                    @endif

                </div>

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    

                    @if (session('account')->username == 'admin')

                        <img class="user-avatar rounded-circle" src="{{ asset('uploads/images/profiles/avt.png') }}" alt="User Avatar">

                    @else

                        <img class="user-avatar rounded-circle" src="{{ asset('uploads/images/profiles') }}/{{ $profiless->image }}" alt="User Avatar">

                    @endif

                    

                    

                </a>



                

                <div class="user-menu dropdown-menu">

                    <a class="nav-link" href="{{ route('changeInfomation') }}"><i class="fa fa-user"></i> Thông tin</a>



                    <a class="nav-link" href="{{ route('getChangePass') }}"><i class="fa fa-user"></i> Đổi mật khẩu</a>



                    <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Đăng xuất</a>

                </div>

            </div>

            

        </div>

    </div>



</header>