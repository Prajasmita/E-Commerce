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
    </section><!--/slider-->
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
                                            {{$category->name}}

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
                                                    <li><a href="#">{{$sub_category->name}}</a></li>
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
                                        @foreach($featured_product->image_products as $product_image)
                                        <img src="{{asset('/img/product/'.$product_image->product_image_name)}}" alt="" />
                                        <h2>${{$featured_product->price}}</h2>
                                        <p>{{$featured_product->product_name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        @endforeach
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$featured_product->price}}</h2>
                                            <a class=""  href="http://127.0.0.1:8000/product_details/{{$featured_product->id}}">{{$featured_product->product_name}}</a>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
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
                                    <a class="cat_nav" href="#{{$category->id}}" data-id="{{$category->id}}" data-toggle="tab">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="category_product" >
                            @foreach($products as $cat)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img class="show_img" src="{{asset('img/product/'.$cat->products->image->product_image_name)}}" />
                                                <h2>${{ $cat->products->price }}</h2>
                                                <a class="text-black" href="http://127.0.0.1:8000/product_details/{{$cat->products->id}}">{{ $cat->products->product_name }}</a>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
@endsection
