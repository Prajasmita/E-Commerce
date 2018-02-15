<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('img/avatar3.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> {{$authUser->first_name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li class="treeview {{--active menu-open--}} ">
                <a href="{{ route('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>Master</span>
                    <span class="pull-right-container"></span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-list"></i> <span>Users</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('configuration.index') }}">
                            <i class="fa fa-list"></i> <span>Configurations</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('banners.index') }}">
                            <i class="fa fa-list"></i> <span>Banners</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}">
                            <i class="fa fa-list"></i> <span>Products</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}">
                            <i class="fa fa-list"></i> <span>Categories</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('coupons.index') }}">
                            <i class="fa fa-list"></i> <span>Coupons</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cms.index') }}">
                            <i class="fa fa-list"></i> <span>CMS</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('contact.admin') }}">
                    <i class="glyphicon glyphicon-phone-alt"></i> <span>Contact Us</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li>
                <a href="{{route('email.template')}}">
                    <i class="glyphicon glyphicon-envelope"></i> <span>Email Template</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
            <li>
                <a href="{{route('user.orders')}}">
                    <i class="glyphicon glyphicon-list"></i> <span>User Orders</span>
                    <span class="pull-right-container"></span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>