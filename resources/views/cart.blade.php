@extends('home_template')
@section('content')
    <section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">

            @if(count($cart))
            <table class="table table-condensed no-item">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($cart as $cartItem)
                <tr id="cart_product_{{$cartItem->id}}"  >
                    <td class="cart_product">
                        <a href="#"><img class="index_img" src="{{asset('img/product/'.$cartItem->options->image)}}" alt=""></a>
                    </td>
                    <td class="cart_description hidden">
                        <h4><a href=""  >{{$cartItem->rowId}}</a></h4>
                    </td>
                    <td class="cart_description">
                        <h4><a href="">{{$cartItem->name}}</a></h4>
                    </td>
                    <td class="cart_price">
                        <p>${{$cartItem->price}}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button" id="{{"qty_".$cartItem->id}}" data-quantity="{{$cartItem->qty}}" data-id="{{$cartItem->id}}" data-rowid="{{$cartItem->rowId}}" data-price={{$cartItem->price}}>
                            <a class="minus cart_quantity_down qty" > - </a>
                            <input type="text" class="qty cart_quantity_input"  name="quantity" value="{{$cartItem->qty}}" min="1"  size="2" id="number" />
                            <a class="plus cart_quantity_up qty"> + </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p id={{"subtotal_".$cartItem->id}} class="cart_total_price">${{$cartItem->subtotal}}</p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="Javascript:void(0)" id="delete_{{$cartItem->id}}" data-id="{{$cartItem->id}}" data-count="{{count($cart)}}" data-rowid="{{$cartItem->rowId}}" ><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
                @else
                    <div>
                    <br/>
                        <p class="text-center"><strong>You have no items in the shopping cart</strong></p>
                    <br/>
                    </div>
                @endif
                </tbody>
            </table>
        </div>
        <div class="no-item-checkbox">
            <div class="pull-right col-md-4">
                <a class="{{(count($cart)) ? "btn btn-default check_out" : "hidden_field" }}" href="{{Auth::user() ? route('checkout') : url('register')}}" >Check Out</a>
            </div>
        </div>
    </div>
        <br/>


</section> <!--/#cart_items-->
    @endsection