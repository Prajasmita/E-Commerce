<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> (+91) 989 858 4545 </a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> prajakta.sisale@neosofttech.com</a></li>
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
                        <a href="{{url('/')}}"><img src="{{asset('img/images/home/logo.png')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            @if( Auth::user())
                                <li class="dropdown user user-menu">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="hidden-xs"><img id="user_id" data-user_id="{{Auth::user()->id}}" ><i class="fa fa-user"></i>{{Auth::user()->first_name}}  {{Auth::user()->last_name}}<i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <ul class="sub-menu dropdown-menu">
                                        <li><a href="{{route('address.book')}}">Address Book</a></li>
                                        <li><a href="{{route('change.password')}}">Change Password</a></li>
                                        <li><a href="{{route('my.orders')}}">My Orders</a></li>
                                        <li><a href="{{route('track.order')}}">Track Order</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                            <li><a href="{{ Auth::user() ? route('checkout') : route('register') }}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a class="cart-count" data-count="{{Cart::count()}}" href="{{route('cart')}}"><i class="fa fa-shopping-cart "></i> Cart({{Cart::count()}})</a></li>
                                @if( Auth::user())
                                <li><a href="{{route('user_logout')}}"><i class="fa fa-unlock"></i> Logout</a></li>
                                @else
                                <li><a href="{{url('register')}}"><i class="fa fa-lock"></i> Login</a></li>
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
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{url('/')}}" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="login.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="{{route('contact_us')}}">Contact</a></li>
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