@extends('home_template')
@section('content')
 <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">WishList</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">

                @if(count($wishlists))
                    <table class="table table-condensed no-item">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td></td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($wishlists as $list)
                            <tr id="delete_wishlist_{{$list['product_id']}}">
                                <td class="cart_product">
                                    <a href="#"><img class="index_img" src="{{asset('img/product/'.$list['product']['image']['product_image_name'])}}" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href=""  >{{$list['product']['product_name']}}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>${{$list['product']['price']}}</p>
                                </td>
                                <td>
                                    @if(in_array($list['product']['id'],$cart_product))
                                        <a href="javascript:void(0)" class=" btn btn-default link_text_color product-added"><i class="glyphicon glyphicon-ok"></i>Added to cart</a>
                                    @else
                                        <a href="javascript:void(0)" data-id="{{$list['product']['id']}}" data-count="{{Cart::count()}}" class="cart-data btn btn-default add-to-cart {{"product_id_cart".$list['product']['id']}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    @endif
                                </td>
                                <td class="cart_delete">
                                    <a class="wishlist_delete" href="Javascript:void(0)" id="delete_wishlist_{{$list['product']['id']}}" data-id="{{$list['product']['id']}}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <div>
                                <br/>
                                <p class="text-center"><strong>You have no items in the Wish List</strong></p>
                                <br/>
                            </div>
                        @endif
                        </tbody>
                    </table>
            </div>
            <div class="no-item-checkbox">
                <div class="pull-right col-md-4">
{{--
                    <a class="{{(count($cart)) ? "btn btn-default check_out" : "hidden_field" }}" href="{{Auth::user() ? route('checkout') : url('register')}}" >Check Out</a>
--}}
                </div>
            </div>
        </div>
        <br/>


    </section> <!--/#cart_items-->
@endsection