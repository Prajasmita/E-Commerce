<div width="600">
    @php $total = 0 @endphp

    @if(count($order_review_page['order_products']))
        <table border="1">
            <thead>
            <tr >
                <td colspan="2">Item</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>
            </thead>
            <tbody>
            @foreach($order_review_page['order_products'] as $order_product)
                <tr id=""  >
                    <td colspan="2">
                        <a href="#"><img class="index_img" height="10px" width="10px" src="{{asset('img/product/'.$order_product['image_name'])}}" alt=""></a>
                        <h4>{{$order_product['name']}}</h4>
                    </td>
                    <td>
                        <p>${{$order_product['price']}}</p>
                    </td>
                    <td>
                        <div>
                            <input type="text" class="qty cart_quantity_input"  name="quantity" value="{{$order_product['quantity']}}" min="1"  size="2" id="number" readonly/>
                        </div>
                    </td>
                    <td>
                        @php $total = $total + $order_product['subtotal']  @endphp
                        <p class="cart_total_price">${{$order_product['subtotal']}}</p>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">&nbsp;</td>
                <td colspan="2">
                    <table  border="1">
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
                            <td><span>{{"$".$order_review_page['payment_details']['grand_total'] }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    @endif
</div>