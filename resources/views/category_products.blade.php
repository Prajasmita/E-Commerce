
@extends('home_template')
@section('content')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        @foreach($banner_images as $index => $banner)
                            <div class="item {{ $index == 0 ? 'active' : '' }}">
                                <div class="col-sm-6">
                                    <h1>{{$banner->banner_name}}</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('img/banner/'.$banner->banner_image)}}" class="girl img-responsive" alt="" />
                                    <img src="{{asset('img/images/home/pricing.png')}}"  class="pricing" alt="" />
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
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
                                            <a href="http://127.0.0.1:8000/category_products/{{$category->id}}">{{$category->name}}</a>

                                    </a>
                                </h4>
                            </div>
                            <div id="{{$category->name}}" class="panel-collapse collapse">
                                {{--
                                                                    class={{($category->sub_category->count() > 0) ? "panel-collapse collapse" :""  }}
                                --}}
                                <div class={{($category->sub_category->count() > 0) ? "panel-body" :""  }}>
                                    @if($category->sub_category->count() > 0)
                                        <ul>
                                            @foreach($category->sub_category as $sub_category)
                                                @if($sub_category->parent_id == $category->id )
                                                    <li><a href="http://127.0.0.1:8000/category_products/{{$sub_category->id}}">{{$sub_category->name}}</a></li>
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

                <h2 class="title text-center">{{$categoryName->name}} Products</h2>

                @if($products->count() > 0)
                @foreach($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                        <img src="{{asset('/img/product/'.$product->products->image->product_image_name)}}" alt="" />
                                        <h2>${{$product->products->price}}</h2>
                                        <p>{{$product->products->product_name}}</p>
                                    @if(in_array($product->products->id,$cart_product))
                                        <a href="javascript:void(0)" class=" btn btn-default product-added "><i class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                    @else
                                        <a href="javascript:void(0)" data-id="{{$product->products->id}}" class="cart-data btn btn-default add-to-cart {{"product_id_cart".$product->products->id}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    @endif                                  </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>${{$product->products->price}}</h2>
                                        <p><a class=""  href="http://127.0.0.1:8000/product_details/{{$product->products->id}}">{{$product->products->product_name}}</a></p>
                                        @if(in_array($product->products->id,$cart_product))
                                            <a href="javascript:void(0)" class=" btn btn-default product-added  "><i class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                        @else
                                            <a href="javascript:void(0)" data-id="{{$product->products->id}}" class="cart-data btn btn-default add-to-cart {{"product_id_cart".$product->products->id}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        @endif                                    </div>
                                </div>
                            </div>

                            <div  class="choose nav nav-pills nav-justified {{ Auth::user() ?'':'hidden_field' }}">

                                @if(in_array($product->products->id,$my_wishlist))
                                    <li><a class="link_text_color"><i class=" glyphicon glyphicon-ok"  ></i>Added to Wishlist</a></li>
                                @else
                                    <li class="{{"product_id_".$product->products->id}}"><a class="wishlist link_text_color" href="javascript:void(0)" data-id="{{$product->products->id}}"><i class="fa fa-plus-square "  ></i>Add to wishlist</a></li>
                                @endif

                            </div>


                           {{-- <ul class="nav nav-pills nav-justified">
                                @if(in_array($product->products->id,$my_wishlist))
                                    <li><a class="link_text_color"><i class=" glyphicon glyphicon-ok"  ></i>Added to Wishlist</a></li>
                                @else
                                    <li class="{{"product_id_".$product->products->id}}"><a class="wishlist" href="javascript:void(0)" data-id="{{$product->products->id}}"><i class="fa fa-plus-square "  ></i>Add to wishlist</a></li>
                                @endif
                            </ul>--}}
                        </div>
                    </div>
                @endforeach
                    @else
                    <p class="text-center"><b>Sorry,No Product Available</b></p>
                    @endif
            </div>
        </div>
    </div>
</div>
            <!--features_items-->
    @endsection