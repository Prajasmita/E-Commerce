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
            <div class="form-group">

                {!! Form::open(['route' => ['order.store'],'class'=>'checkout_form']) !!}
                <div class="shopper-informations">
                    <div class="row">
                        <div class="col-sm-6 clearfix">
                            <div class="bill-to">
                                <p>Bill To</p>
                                <div class=" col-sm-12">

                                    <div class="col-sm-6">
                                        <input type="text" name="user_id" id="user_id" value="{{$user->id}}" class="hidden_field">

                                        <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
                                                <input type="text" name="company_name" id="company_name" value="{{$user->company_name}}" placeholder="Company Name" class="checkout-form-input">
                                                {!! $errors->first('company_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                            <input type="text" name="email" value="{{$user->email}}" placeholder="Email*" class="checkout-form-input">
                                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                            <input type="text" name="title" value="{{$user->title}}" placeholder="Title" class="checkout-form-input">
                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                                            <input type="text" name="first_name" value="{{$user->first_name}}" placeholder="First Name *" class="checkout-form-input">
                                            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('middle_name') ? 'has-error' : ''}}">
                                            <input type="text" name="middle_name" value="{{$user->middle_name}}" placeholder="Middle Name" class="checkout-form-input">
                                            {!! $errors->first('middle_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                                            <input type="text" name="last_name" value="{{$user->last_name}}" placeholder="Last Name *" class="checkout-form-input">
                                            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('address1') ? 'has-error' : ''}}">
                                            <input type="text" name="address1" value="{{$user->address1}}" placeholder="Address 1 *" class="checkout-form-input">
                                            {!! $errors->first('address1', '<span class="help-block">:message</span>') !!}
                                        </div>
                                        <div class="form-group {{ $errors->has('address2') ? 'has-error' : ''}}">
                                            <input type="text" name="address2" value="{{$user->address2}}" placeholder="Address 2" class="checkout-form-input">
                                            {!! $errors->first('address2', '<span class="help-block">:message</span>') !!}
                                        </div>


{{--
                                        <input type="text" name="company_name" id="company_name" value="{{$user->company_name}}" placeholder="Company Name" class="checkout-form-input">
--}}
                                    </div>
                                        <div class="col-sm-6">
                                            <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : ''}}">
                                                <input type="text" name="zip_code" value="{{$user->zip_code}}" placeholder="Zip / Postal Code *" class="checkout-form-input">
                                                {!! $errors->first('zip_code', '<span class="help-block">:message</span>') !!}
                                            </div>
                                            <select name="country" class="checkout-form-input select-country">
                                                @foreach($countries as $country)
                                                    <option value="{{ ($country->name) ? $country->id : '' }}" {{ ($user->country == $country->name) ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>

                                            <select name="state" class="checkout-form-input select-state">
                                                @php $country_id = ($country->name) ? $country->id : ''  @endphp
                                                @foreach($states as $state)
                                                    <option value="{{ ($state->name) ? $state->id  : '' }}"  {{ ($user->state == $state->name) ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="form-group {{ $errors->has('contact_no') ? 'has-error' : ''}}">
                                                <input type="text" name="contact_no" value="{{$user->contact_no}}" placeholder="Mobile Phone" class="checkout-form-input">
                                                {!! $errors->first('contact_no', '<span class="help-block">:message</span>') !!}
                                            </div>
                                        </div>
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

                    {{--*/ $total = '0' /*--}}
                    @php $total = 0 @endphp
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
                                        {!! Form::text('Coupon Code',null,['id' => 'coupon_input','class' => 'form-control']);  !!}

                                        <span class="input-group-btn" id="coupon_button">
                                                <button class="btn btn-sm" type="button" id="apply_coupon" data-total="{{$total}}"><i class="glyphicon glyphicon-ok "></i></button>
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
                                            @php $shipping_Tax = config('constants.shipping_Tax');@endphp
                                            <td>Shipping Cost</td>
                                            @php  $shipping_cost = ($total < 500 ? $shipping_Tax : 0) @endphp
                                            <td id="shipping_cost" data-shipping_cost="{{$shipping_cost }}"  >{{ $shipping_cost== 0 ?  "Free" : "$".$shipping_cost }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            @php $finalTotal = $total + ($shipping_cost == "Free" ? 0 : $shipping_Tax) + $discount @endphp
                                            <td id="finalTotal" data-finalTotal="{{$finalTotal}}"><span>{{ "$".$finalTotal  }}</span></td>
                                        </tr>
                                        <input type="text" name="coupon" class="hidden_field" value="0">
                                        <input type="text" name="grand_total" class="hidden_field" value="{{$finalTotal}}">
                                        <input type="text" name="shipping_charge" class="hidden_field" value="{{$shipping_cost}}">
                                        <input type="text" name="discount" class="hidden_field" value="{{$discount}}">

                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                </div>



                <div class="col-sm-4 pull-left payment-options">

                    <div class="form-group {{ $errors->has('payment_gateway') ? 'has-error' : ''}}">
                        <div class="col-md-6">
                            <input   name="payment_gateway" value=1 type="radio" id="cod" data-pg="1" }}>COD
                            <input  name="payment_gateway" value=2 type="radio" class="payment_gateway"  id="paypal" data-pg="2"}}>Paypal
                            {!! $errors->first('payment_gateway', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <span>
                        <div class="form-group {{ $errors->has('contact_no') ? 'has-error' : ''}}">
                                <input type="radio" name="payment_gateway" id="cod" class="payment_gateway" value=1 data-pg="1">
                                <label>COD</label>
                                {!! $errors->first('payment_gateway', '<p class="help-block">:message</p>') !!}

                                <input type="radio" name="payment_gateway" id="paypal" class="payment_gateway" value=2 data-pg="2">
                            <label>Paypal</label>
                            {!! $errors->first('payment_gateway', '<p class="help-block">:message</p>') !!}

                        </div>
                    </span>
                </div>
                <div>
                    {!! Form::submit('Proceed', ['class' => 'btn btn-warning pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>


    </section> <!--/#cart_items-->
@endsection