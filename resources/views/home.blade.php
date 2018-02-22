@extends('home_template')

@section('content')

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                        @php $count = count($banner_images) @endphp
                        <ol class="carousel-indicators">
                            @foreach($banner_images as $index => $banner)
                                <li data-target="#slider-carousel" data-slide-to="{{ $index }}"
                                    class="{{ $index == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach($banner_images as $index => $banner)
                                <div class="item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="col-sm-6">
                                        <h1>{{$banner->banner_name}}</h1>
                                        <h2>Free E-Commerce Template</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{asset('img/banner/'.$banner->banner_image)}}"
                                             class="girl img-responsive" alt=""/>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if(count($banner_images) > 1)
                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--/slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                        @foreach($categories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$category->name}}">

                                            @if($category->sub_category->count() > 0)
                                                <span class="badge pull-right">
                                                <i class=" fa fa-plus"></i></span>
                                            @endif
                                            <a href="{{route('category_product',$category->id)}}">{{$category->name}}</a>

                                        </a>
                                    </h4>
                                </div>
                                <div id="{{$category->name}}" class="panel-collapse collapse">
                                    <div class={{($category->sub_category->count() > 0) ? "panel-body" :""  }}>
                                        @if($category->sub_category->count() > 0)
                                            <ul>
                                                @foreach($category->sub_category as $sub_category)
                                                    @if($sub_category->parent_id == $category->id )
                                                        <li>
                                                            <a href="{{route('category_product',$sub_category->id)}}">{{$sub_category->name}}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--/category-products-->


                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>


                    @foreach($featured_products as $featured_product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('/img/product/'.$featured_product['image']['product_image_name'])}}"
                                             alt=""/>
                                        <h2>${{$featured_product['price']}}</h2>
                                        <p>{{$featured_product['product_name']}}</p>
                                    </div>
                                    <div class=" product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$featured_product['price']}}</h2>
                                            <p><a class=""
                                                  href="{{Auth::user() ? route('products.details',$featured_product['id']) : route('register')}}">{{$featured_product['product_name']}}</a>
                                            </p>
                                            @if(in_array($featured_product['id'],$cart_product))
                                                <span><a href="javascript:void(0)"
                                                         class="btn btn-default link_text_color added-to-cart "><i
                                                                class="glyphicon glyphicon-ok"></i>Added to cart</a></span>
                                            @else
                                                <a href="javascript:void(0)" data-id="{{$featured_product['id']}}"
                                                   data-count="{{count($cart_product)}}"
                                                   class="cart-data btn btn-default add-to-cart" name="notify" onclick="$.notify('Product Added To Your Cart.','success');"  ><i
                                                            class="fa fa-shopping-cart"></i>Add to cart</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="choose {{ Auth::user() ?'':'hidden_field' }}">
                                    <ul class="nav nav-pills nav-justified">
                                        @if(in_array($featured_product['id'],$my_wishlist))
                                            <li><a class="link_text_color" disabled="disabled"><i class=" glyphicon glyphicon-ok" ></i>Added to Wishlist</a></li>
                                        @else
                                            <li class="{{"product_id_".$featured_product['id']}}"><a
                                                        class="wishlist link_text_color" href="javascript:void(0)"
                                                        data-id="{{$featured_product['id']}}" name="notify" onclick="$.notify('Product Added To Your Wish List.','success');" ><i
                                                            class="fa fa-plus-square "></i>Add to wishlist</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--features_items-->

                <!--category-tab-->
                <div class="category-tab">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            @foreach($categories as $count => $category)
                                <li class=" @if ($count == 0) active @endif">
                                    <a class="cat_nav " href="#{{$category->id}}" data-id="{{$category->id}}"
                                       data-toggle="tab">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content ">
                        <div class="tab-pane fade active in" id="category_product">
                            @foreach($products as $cat)
                                <div class="col-sm-3 proinfo0">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo  text-center">
                                                <img class="show_img"
                                                     src="{{asset('img/product/'.$cat['products']['image'])}}"/>
                                                <h2>${{ $cat['products']['price'] }}</h2>
                                                <p><a class="text-dark"
                                                      href="{{Auth::user() ? route('products.details',$cat['products']['id']) : route('register')}}">{{ $cat['products']['product_name'] }}</a>
                                                </p>
                                                @if(in_array($cat['products']['id'],$cart_product))
                                                    <span><a href="javascript:void(0)"
                                                             class="link_text_color btn btn-default added-to-cart "><i
                                                                    class="glyphicon glyphicon-ok"></i>Added to cart</a></span>
                                                @else
                                                    <a href="javascript:void(0)" data-id="{{$cat['products']['id']}}"
                                                       data-count="{{Cart::count()}}"
                                                       class="cart-data btn btn-default add-to-cart {{"product_id_cart".$cat['products']['id']}}" name="notify" onclick="$.notify('Product Added To Your Cart.','success');"><i
                                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                                @endif
                                                <div class="choose nav nav-pills nav-justified {{ Auth::user() ?'':'hidden_field' }}">

                                                    @if(in_array($cat['products']['id'],$my_wishlist))
                                                        <li><a class="link_text_color" disabled="disabled" href="javascript:void(0)"
                                                                    data-id="{{$cat['products']['id']}}"><i
                                                                        class="glyphicon glyphicon-ok "></i>Added to Wishlist</a></li>
                                                    @else
                                                        <li class="{{"product_id_".$cat['products']['id']}}"><a
                                                                    class="wishlist link_text_color "
                                                                    href="javascript:void(0)"
                                                                    data-id="{{$cat['products']['id']}}" name="notify" onclick="$.notify('Product Added To Your Wish List.','success');"><i
                                                                        class="fa fa-plus-square"></i> Add to
                                                                Wishlist</a></li>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div><!--/category-tab-->
            </div>
        </div>
    </div>
    <script>
        var authUser = {{ Auth::user() ? 1 : 0 }} ;
    </script>
@endsection


