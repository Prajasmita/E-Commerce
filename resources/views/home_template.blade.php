<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | Ecommerce</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- CSS STYLE-->
    <link rel="stylesheet" href="{{asset('css/xzoom.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('js/html5shiv.js')}}"></script>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->
    <script>
        var base_url = "http://127.0.0.1:8000/";

        var base_url_cat = "{{route('category_data',['id'])}}";

        var base_url_productDetails = "http://127.0.0.1:8000/product_details/";

        var wishlistUrl = "{{route('products.wishlist',['id'])}}"

    </script>



    {{--style css--}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
    {{--Header--}}
    @include('layouts.header')

    <section>
        <!-- Your Page Content Here -->

        @yield('content')

    </section><!-- /.content -->


    {{--Footer--}}
    @include('layouts.footer')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('js/price-range.js')}}"></script>
    <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>

    {{--<script src="{{asset('js/user_wishlist.js')}}"></script>--}}
    <script src="{{asset('js/category_bar.js')}}"></script>
    <script src="{{asset('js/zoom-slideshow.js')}}"></script>

    <!-- XZOOM JQUERY PLUGIN  -->
    <script src="{{asset('js/xzoom.js')}}"></script>
    <script src="{{asset('js/image_gallery.js')}}"></script>
    <script src="{{asset('js/inc_dec.js')}}"></script>






</body>
</html>