@extends('home_template')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->


       {{--     <div class="step-one">
                <h2 class="heading">Step1</h2>
            </div>
            <div class="checkout-options">
                <h3>New User</h3>
                <p>Checkout options</p>
                <ul class="nav">
                    <li>
                        <label><input type="checkbox"> Register Account</label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Guest Checkout</label>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-times"></i>Cancel</a>
                    </li>
                </ul>
            </div><!--/checkout-options-->

            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->--}}

            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-6 clearfix">
                        <div class="bill-to">
                            <p>Bill To</p>
                            <div class=" col-sm-12">
                                <form class="checkout_form" action="{{--{{route('checkout.store')}}--}}">

                                    <div class="col-sm-6">
                                        <input type="text" value="{{$user->company_name}}" placeholder="Company Name">
                                        <input type="text" value="{{$user->email}}" placeholder="Email*">
                                        <input type="text" value="{{$user->title}}" placeholder="Title">
                                        <input type="text" value="{{$user->first_name}}" placeholder="First Name *">
                                        <input type="text" value="{{$user->middle_name}}" placeholder="Middle Name">
                                        <input type="text" value="{{$user->last_name}}" placeholder="Last Name *">
                                        <input type="text" value="{{$user->address1}}" placeholder="Address 1 *">
                                        <input type="text" value="{{$user->address2}}" placeholder="Address 2">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$user->zip_code}}" placeholder="Zip / Postal Code *">
                                        {{--  <select>
                                              <option>-- Country --</option>
                                              <option>United States</option>
                                              <option>Bangladesh</option>
                                              <option>UK</option>
                                              <option>India</option>
                                              <option>Pakistan</option>
                                              <option>Ucrane</option>
                                              <option>Canada</option>
                                              <option>Dubai</option>
                                          </select>--}}
                                        <input type="text" value="{{$user->state}}" placeholder="State *">
                                        {{-- <select>
                                             <option>-- State / Province / Region --</option>
                                             <option>United States</option>
                                             <option>Bangladesh</option>
                                             <option>UK</option>
                                             <option>India</option>
                                             <option>Pakistan</option>
                                             <option>Ucrane</option>
                                             <option>Canada</option>
                                             <option>Dubai</option>
                                         </select>--}}
                                        <input type="text" value="{{$user->country}}" placeholder="Country *">
                                        {{-- <select>
                                             <option>-- State / Province / Region --</option>
                                             <option>United States</option>
                                             <option>Bangladesh</option>
                                             <option>UK</option>
                                             <option>India</option>
                                             <option>Pakistan</option>
                                             <option>Ucrane</option>
                                             <option>Canada</option>
                                             <option>Dubai</option>
                                         </select>--}}

                                        <input type="text" value="{{$user->contact_no}}" placeholder="Mobile Phone">
                                    </div>
                                </form>
                            </div>
                            <div class="form-two">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="order-message">
                            <p>Shipping Order</p>
                            <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                            <label><input type="checkbox"> Shipping to bill address</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="review-payment">
                <h2>Review & Payment</h2>
            </div>

            <div class="table-responsive cart_info">

                <?php $total = 0 ?>
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

                            <?php $total += $cartItem->subtotal ?>
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
                                        <input type="text" class="qty cart_quantity_input"  name="quantity" value="{{$cartItem->qty}}" min="1"  size="2" id="number" readonly/>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p id={{"subtotal_".$cartItem->id}} class="cart_total_price">${{$cartItem->subtotal}}</p>
                                </td>

                            </tr>
                        @endforeach
                        @endif

                            <tr>
                                <td>
                                    <div class="input-group ">
                                        <input class="form-control" id="coupon_input" type="text">
                                        <span class="input-group-btn" id="coupon_button">
                                            <button class="btn btn-sm" type="button" id="apply_coupon" data-total="{{$total}}"><header class="glyphicon glyphicon-ok "></header></button>
                                        </span>
                                    </div>
                                </td>
                                <td colspan="4">&nbsp;</td>
                                <td colspan="2">
                                <table class="table table-condensed total-result order-amount">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td id="total" data-total="{{$total}}">{{"$".$total}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <?php $discount = 0 ?>
                                        <td id="discount">{{$discount}}</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <?php $shipping_Tax = config('constants.shipping_Tax'); ?>
                                        <td>Shipping Cost</td>
                                            <?php  $shipping_cost = ($total < 500 ? $shipping_Tax : "Free") ?>
                                        <td id="shipping_cost" data-shipping_cost="{{$shipping_cost }}"  >{{ $shipping_cost=="Free" ? 0 :$shipping_cost }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <?php $finalTotal = $total + ($shipping_cost == "Free" ? 0 : $shipping_Tax) + $discount ?>
                                        <td id="finalTotal" data-finalTotal="{{$finalTotal}}"><span>{{ "$".$finalTotal  }}</span></td>
                                    </tr>
                                </table>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>

                {{--<div class="col-sm-4 pull-right payment-options">
                        <span>
                            <label><input type="checkbox"> Direct Bank Transfer</label>
                        </span>
                    <span>
                            <label><input type="checkbox"> Check Payment</label>
                        </span>
                    <span>
                            <label><input type="checkbox"> Paypal</label>
                        </span>
                </div>--}}
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection