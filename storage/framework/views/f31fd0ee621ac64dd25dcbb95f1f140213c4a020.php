<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="cur nav nav-pills">
                            <li><a><i class="fa fa-phone"></i> (+91) 989 858 4545 </a></li>
                            <li><a><i class="fa fa-envelope"></i> prajakta.sisale@neosofttech.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                         <ul class="nav navbar-nav">
                             <li><a href="https://www.facebook.com/login/"><i class="fa fa-facebook"></i></a></li>
                             <li><a href="https://twitter.com/login"><i class="fa fa-twitter"></i></a></li>
                             <li><a href="https://in.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                             <li><a href="https://plus.google.com/people"><i class="fa fa-google-plus"></i></a></li>
                         </ul>
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
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('img/images/home/logo.png')); ?>" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <?php if( Auth::user()): ?>
                                <li class="dropdown user user-menu">
                                    <a href=""
                                       class="dropdown-toggle <?php echo e((url()->current() == route('address.book')) || (url()->current() == route('change.password')) || (url()->current() == route('my.orders')) || (url()->current() == route('track.order')) ? 'active' : ''); ?>"
                                       data-toggle="dropdown">
                                        <span class="hidden-xs"><img id="user_id" data-user_id="<?php echo e(Auth::user()->id); ?>"><i
                                                    class="fa fa-user"></i><?php echo e(Auth::user()->first_name); ?>  <?php echo e(Auth::user()->last_name); ?>

                                            <i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <ul class="sub-menu dropdown-menu ">
                                        <li>
                                            <a class="<?php echo e(((url()->current()) == route('address.book')) ? 'active' : ''); ?>"
                                               href="<?php echo e(route('address.book')); ?>">Address Book</a></li>
                                        <li>
                                            <a class="<?php echo e(((url()->current()) == route('change.password')) ? 'active' : ''); ?>"
                                               href="<?php echo e(route('change.password')); ?>">Change Password</a></li>
                                        <li><a class="<?php echo e(((url()->current()) == route('my.orders')) ? 'active' : ''); ?>"
                                               href="<?php echo e(route('my.orders')); ?>">My Orders</a></li>
                                        <br/>
                                        <li>
                                            <a class="<?php echo e(((url()->current()) == route('track.order')) ? 'active' : ''); ?>"
                                               href="<?php echo e(route('track.order')); ?>">Track Order</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li><a class="<?php echo e(((url()->current()) == route('my.wishlist')) ? 'active' : ''); ?>"
                                   href="<?php echo e(Auth::user() ? route('my.wishlist') : route('register')); ?>"><i
                                            class="fa fa-star"></i> Wishlist</a></li>
                            <li>
                                <a class="<?php echo e(((url()->current()) == route('checkout')) ? 'active' : ''); ?>"
                                   href="<?php echo e(Auth::user() ? route('checkout'): route('register')); ?>"><i
                                            class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a class="cart-count <?php echo e(((url()->current()) == route('cart')) ? 'active' : ''); ?> "
                                   data-count="<?php echo e(Cart::count()); ?>" href="<?php echo e(route('cart')); ?>"><i
                                            class="fa fa-shopping-cart "></i> Cart(<?php echo e(Cart::count()); ?>)</a></li>
                            <?php if( Auth::user()): ?>
                                <li><a class="<?php echo e(((url()->current()) == route('user_logout')) ? 'active' : ''); ?>"
                                       href="<?php echo e(route('user_logout')); ?>"><i class="fa fa-unlock"></i> Logout</a></li>
                            <?php else: ?>
                                <li><a class="<?php echo e(((url()->current()) == url('register')) ? 'active' : ''); ?>"
                                       href="<?php echo e(url('register')); ?>"><i class="fa fa-lock"></i> Login</a></li>
                            <?php endif; ?>
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
                            <li><a class="<?php echo e(((url()->current()) == url('/')) ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>">Home</a>
                            </li>
                            <li>
                                <a class="<?php echo e(((url()->current()) == url('cms/about_us')) ? 'active' : ''); ?>"
                                   href="<?php echo e(url('cms/about_us')); ?>">About Us</a></li>
                            <li>
                                <a class="<?php echo e(url()->current() == url('cms/help') ? 'active' : ''); ?>"
                                   href="<?php echo e(url('cms/help')); ?>">Help</a></li>
                            <li><a class="<?php echo e(((url()->current()) == route('contact_us') ? 'active' : '' )); ?>"
                                   href="<?php echo e(Auth::User() ? route('contact_us') : route('register')); ?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->