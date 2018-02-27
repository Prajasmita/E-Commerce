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
                                            <a href="{{route('category_product',$category->id)}}">{{$category->name}}</a>

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
                    </div>
                </div>
            </div>
            <!--/category-products-->
            <div class="col-sm-9 padding-right">
                <div class="product-details col-sm-5">
                    <img class="xzoom show_img"
                         src="{{asset('img/product/'.$products['image']['product_image_name'])}}"
                         xoriginal="{{asset('img/product/'.$products['image']['product_image_name'])}}"/>
                    <div class="xzoom-thumbs">
                        @foreach($products['image_products'] as $product)
                            <a href="{{--{{asset('img/product/'.$product['product_image_name'])}}--}}">
                                <img class="xzoom-gallery" width="80"
                                     src="{{asset('img/product/'.$product['product_image_name'])}}"
                                     xpreview="{{asset('img/product/'.$product['product_image_name'])}}">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-7">

                    <div class="product-information"><!--/product-information-->

                        @if($products['is_feature'] == 1)
                            <img src="{{asset('img/images/product-details/featured_tag.png')}}" class="newarrival"
                                 alt=""/>
                        @endif
                        <h1>{{$products['product_name']}}</h1>
                        <span >
                            <span>${{ $products['price'] }}</span>
                            <div class="quantity">
                                <label><b>Qty:</b></label>
                                <input type="button" class="qty_minus" value="-"/>
                                <input type="text" class="qty" id="quantity" name="quantity"
                                       data-value="{{Cart::count()}}" value="1" min="1"
                                       max="{{$products['quantity']}}" size="1" id="number"
                                       readonly/>
                                <input type="button" class="qty_plus" value="+"/>
                            </div>
                            <br/>
                        <span>
                            @if($products['quantity'] > 0)
                                @if(in_array($products['id'],$cart_product))
                                    <a href="javascript:void(0)" class=" btn btn-default link_text_color detail-added-to-cart"><i
                                                class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                @else
                                    <a href="javascript:void(0)" data-id="{{$products['id']}}"
                                       data-price="{{$products['price']}}" data-count="{{Cart::count()}}"
                                       class="cart-data btn btn-default detail-add-to-cart" name="notify" onclick="$.notify('Product Added To Your Cart.','success');"><i
                                                class="fa fa-shopping-cart" ></i>Add to cart</a>
                                @endif
                            @else
                                <a href="javascript:void(0)"
                                         class="btn btn-default link_text_color added-to-cart " style="margin-top: 25px;" disabled="disabled">Out Of Stock</a>
                            @endif
                                @if(in_array($products['id'],$my_wishlist))
                                    <button type="button" class="btn btn-lg wishlist_color added ">
                                                      <a class=" added "  disabled="disabled"><i class="fa fa-heart"></i></a>
                                        </button>
                                @else
                                    <button type="button" class="btn btn-lg wishlist_color">
                                                    <a href="javascript:void(0)"
                                                       class="{{"product_id_".$products['id']}} wishlist pd_wishlist_added "
                                                       data-id="{{$products['id']}}"  name="notify" onclick="$.notify('Product Added To Your Wish List.','success');"><i
                                                                class="fa fa-heart"></i></a></li>
                                        </button>
                                @endif
                            </span>
                                        <p><b>Availability:</b> {{($products['quantity'])? "In Stock" : "Not In Stock" }}</p>
                                        <p><b>Description:</b> {{$products['short_discription']}}</p>
                        </span>
                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->
        </div>
    </div>

@endsection