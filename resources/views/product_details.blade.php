@extends('home_template')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3 padding-left">
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
                    </div>
                </div>
            </div>
        <!--/category-products-->
            <div class="col-sm-9 padding-right">
                        <div class="product-details"><!--product-details-->
                            <div class="col-sm-5">
                                <div id="photo" class="col-md-12">
                                    <img class="" src="{{asset('img/product/'.$products->image->product_image_name)}}" alt="" >

                                </div>

                                <div class="carousel slide">
                                    <div class="carousel-inner">
                                        <div id="thumbs">
                                            <div id="nav-left-thumbs"><</div>
                                            @if($products->image_products->count() > 1)
                                            <div id="pics-thumbs">
                                                @foreach($products->image_products as $product)
                                                    <img src="{{asset('img/product/'.$product->product_image_name)}}" alt="" />
                                                @endforeach
                                            </div>
                                            @endif
                                            <div id="nav-right-thumbs">></div>
                                        </div>
                                    </div>
                                </div>
                            </div>






                            <div class="col-sm-7">
                                <div class="product-information"><!--/product-information-->
                                    <img src="{{asset('img/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                                    <h2>{{$products->product_name}}</h2>
                                    <p>Web ID: 1089772</p>
                                    <img src="{{asset('img/images/product-details/rating.png')}}" alt="" />
                                    <span>
									<span>${{ $products->price }}</span>
									<label>Quantity:</label>
									<input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                                    <p><b>Availability:</b> In Stock</p>
                                    <p><b>Description</b> {{$products->short_discription}}</p>
                                    <a href=""><img src="{{asset('img/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                                </div><!--/product-information-->
                            </div>
                        </div><!--/product-details-->

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection