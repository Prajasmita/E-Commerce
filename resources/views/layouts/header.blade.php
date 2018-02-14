<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a ><i class="fa fa-phone"></i> (+91) 989 858 4545 </a></li>
                            <li><a ><i class="fa fa-envelope"></i> prajakta.sisale@neosofttech.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        {{-- <ul class="nav navbar-nav">
                             <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                             <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                             <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                             <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                             <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                         </ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{asset('img/images/home/logo.png')}}" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            @if( Auth::user())
                                <li class="dropdown user user-menu">
                                    <a href="" class="dropdown-toggle {{ ((url()->current()) == (route('address.book') || route('change.password') || route('my.orders') || route('track.order')) )? 'active' : '' }} " data-toggle="dropdown">
                                        <span class="hidden-xs"><img id="user_id" data-user_id="{{Auth::user()->id}}"><i
                                                    class="fa fa-user"></i>{{Auth::user()->first_name}}  {{Auth::user()->last_name}}
                                            <i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <ul class="sub-menu dropdown-menu" >
                                        <li><a class="{{ ((url()->current()) == route('address.book')) ? 'active' : '' }}" href="{{route('address.book')}}">Address Book</a></li>
                                        <li><a class="{{ ((url()->current()) == route('change.password')) ? 'active' : '' }}" href="{{route('change.password')}}">Change Password</a></li>
                                        <li><a class="{{ ((url()->current()) == route('my.orders')) ? 'active' : '' }}" href="{{route('my.orders')}}">My Orders</a></li>
                                        <br/>
                                        <li><a class="{{ ((url()->current()) == route('track.order')) ? 'active' : '' }}" href="{{route('track.order')}}">Track Order</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li><a class="{{ ((url()->current()) == route('my.wishlist')) ? 'active' : '' }}" href="{{route('my.wishlist')}}"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li>
                                <a class="{{ ((url()->current()) == route('checkout')) ? 'active' : '' }}" href="{{ Auth::user() ? route('checkout'): route('register') }}"><i
                                            class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a class="cart-count {{ ((url()->current()) == route('cart')) ? 'active' : '' }} " data-count="{{Cart::count()}}" href="{{route('cart')}}"><i
                                            class="fa fa-shopping-cart "></i> Cart({{Cart::count()}})</a></li>
                            @if( Auth::user())
                                <li><a class="{{ ((url()->current()) == route('user_logout')) ? 'active' : '' }}" href="{{route('user_logout')}}"><i class="fa fa-unlock"></i> Logout</a></li>
                            @else
                                <li><a class="{{ ((url()->current()) == url('register')) ? 'active' : '' }}" href="{{url('register')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a class="{{ ((url()->current()) == url('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a></li>
                            <li><a class="{{ ((url()->current()) == config('constants.base_url').'cms/about_us') ? 'active' : '' }}" href="{{config('constants.base_url')}}cms/about_us">About Us</a></li>
                            <li><a class="{{ ((url()->current()) == config('constants.base_url').'cms/help') ? 'active' : '' }}" href="{{config('constants.base_url')}}cms/help">Help</a></li>
                            <li><a class="{{ ((url()->current()) == route('contact_us') ? 'active' : '' )}}" href="{{route('contact_us')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                {{-- <div class="col-sm-3">
                     <div class="search_box pull-right">
                         <input type="text" placeholder="Search"/>
                     </div>
                 </div>--}}
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->