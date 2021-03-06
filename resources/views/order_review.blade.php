@extends('home_template')


@section('content')
    <section id="cart_items">
        <div class="container">
            @if ( session()->has('payment_message') )
                <div class="alert alert-success">{{ session()->get('payment_message') }}</div>
            @endif
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Order</a></li>
                    <li class="active">Order Review</li>
                </ol>
            </div><!--/breadcrums-->
            <!--/shipping address-->
            <div class="user_info">
                <table class="pull-right">
                    <tr>
                        <td><strong>
                                <h4>{{$order_review_page['user_info']['first_name']}} {{$order_review_page['user_info']['middle_name']}} {{$order_review_page['user_info']['last_name']}}</h4>
                            </strong></td>
                    </tr>
                    <tr>
                        <td> {{$order_review_page['user_info']['email']}}</td>
                    </tr>
                    <tr>
                        <td>{{$order_review_page['user_info']['contact_no']}} </td>
                    </tr>
                    <tr>
                        <td> {{$order_review_page['user_info']['address1']}}
                            ,{{ $order_review_page['user_info']['address2'] ? $order_review_page['user_info']['address2'] :'' }}</td>
                    </tr>
                    <tr>
                        <td> {{$order_review_page['user_info']['city']}}
                            ,{{$order_review_page['user_info']['zip_code']}}</td>
                    </tr>
                    <tr>
                        <td> {{$order_review_page['user_info']['state']}}
                            ,{{$order_review_page['user_info']['country']}}</td>
                    </tr>
                    <tr>
                        <td>Payment Status
                            : {{$order_review_page['payment_details']['status'] == 'O' ? 'Processing' : 'Pending'}}</td>
                    </tr>
                </table>
            </div>


            <div class="table-responsive cart_info">
                @php $total = 0 @endphp

                @if(count($order_review_page['order_products']))
                    <table class="table table-condensed total-result ">
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

                        {{--
                                                @php echo "<pre>"; print_r($order_review_page);exit; @endphp
                        --}}


                        @foreach($order_review_page['order_products'] as $order_product)

                            <tr id="">
                                <td class="cart_product">
                                    <a href="#"><img class="index_img"
                                                     src="{{asset('img/product/'.$order_product['image_name'])}}"
                                                     alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$order_product['name']}}</a></h4>
                                </td>
                                <td class="cart_price">
                                    <p>${{$order_product['price']}}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <input type="text" class="qty cart_quantity_input" name="quantity"
                                               value="{{$order_product['quantity']}}" min="1" size="2" id="number"
                                               readonly/>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    @php $total = $total + $order_product['subtotal']  @endphp
                                    <p class="cart_total_price">${{$order_product['subtotal']}}</p>
                                </td>

                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result order-amount">
                                    <tr>
                                        <td>Cart Sub Total</td>
                                        <td>{{"$".$total}}</td>
                                    </tr>
                                    @if(($order_review_page['payment_details']['discount']))
                                        <tr>
                                            <td>Discount</td>
                                            <td> {{"$".$order_review_page['payment_details']['discount']}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Shipping Cost</td>
                                        <td>{{ $order_review_page['payment_details']['shipping_charges'] ?  "$". $order_review_page['payment_details']['shipping_charges']: "Free Shipping"  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>{{"$".$order_review_page['payment_details']['grand_total'] }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @endif
            </div>


        </div>
    </section>

@endsection