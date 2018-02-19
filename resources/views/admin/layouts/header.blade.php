<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ecommerce</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{$authUser->first_name}}<img src="{{asset('img/avatar3.png')}}"
                                                                              class="user-image"
                                                                              alt="User Image"></span>


                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('img/avatar3.png')}}" class="img-circle" alt="User Image">

                            <p>
                                {{$authUser->first_name}}  {{$authUser->last_name}}<span class=""></span>
                                <small>Member since {{$authUser->created_at->format('d M,Y')}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <!-- Authentication Links -->
                                @guest
                                    @else

                                       {{-- <a href="{{ route('login') }}" role="button" aria-expanded="false"
                                           aria-haspopup="true">
                                            <span class=""></span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        >
                                            {{ csrf_field() }}
                                            <a class="btn btn-default btn-flat">
                                                Logout
                                            </a>
                                        </form>
                                        @endguest--}}

                                       {{-- <a class="btn btn-default btn-flat" href="{{ route('login') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
--}}
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        @endguest

                                        <a class="btn btn-default btn-flat" href=""
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>