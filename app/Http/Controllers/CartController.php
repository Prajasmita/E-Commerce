<?php

namespace App\Http\Controllers;


use App\Countries;
use App\Coupon;
use App\Helper\Custom;
use App\Order_details;
use App\Product;
use App\States;
use App\User_address;
use App\User_order;
use Illuminate\Http\Request;
Use Cart;
Use DB;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
Use Srmklive\PayPal\Facades\PayPal;
Use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{

    /*
     * Function for view cart
     *
     */
    public function index()
    {

        $cart = Cart::content();

        return view('cart', array('cart' => $cart));
    }

    /*
     * Function to store product in cart
     *
     */
    public function store(Request $request)
    {

        if ($request->ajax()) {

            $id = $request->id;

            $products = Product::with(['image' => function ($query) {
                $query->get();
            }])->select('id', 'product_name', 'price', 'quantity')->where('id', '=', $id)->first();

            Cart::add(array('id' => $id, 'name' => $products->product_name, 'qty' => 1, 'price' => $products->price, 'options' => ['image' => $products->image->product_image_name]));

            return json_encode('true');


        }
    }

    /*
     * Function to update product in cart
     *
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->id;
            $rowId = $request->rowId;
            $quantity = $request->quantity;
            $product_quantity = Product::select('quantity')->where('id', "=", $id)->first();

            if ($quantity <= $product_quantity->quantity && $quantity >= 1) {

                Cart::update($rowId, ['qty' => $quantity]);

                $count = Cart::count();

                return json_encode($count);

            }
            else {
                return json_encode("false");
            }
        }
    }


    /*
     * Function for delete product from cart
     *
     */
    public function delete(Request $request)
    {

        if ($request->ajax()) {

            $rowId = $request->rowId;

            //Custom::showAll($rowId);

            Cart::remove($rowId);
            return json_encode("true");
        }
    }

    /*
    * Function for checkout
    *
    */
    public function checkout(){


        $user = User_address::where('primary','=','1')->first();

        $cart = Cart::content();

        $coupons = Coupon::select('id','code')->get();
        $codes = array();
        foreach ($coupons as $code => $coupon ){
            array_push($codes,$coupon->id);
        }

        $countries = Countries::get();

        $country_id =Countries::select('id')->where('name','=',$user->country)->first();

        $states = States::where('country_id','=',$country_id->id)->get();

        return view('checkout',array('user'=>$user,'cart'=>$cart,'codes'=>$codes,'countries'=>$countries,'states' => $states));
    }
    /*
       * Function for applying coupon
       *
       */
    public function selectStates(Request $request){

        if($request->ajax()){

            $selectedcountry = $request->country;
            //Custom::showAll($selectedcountry);die;
            $states = States::select('id','name')->where('country_id','=',$selectedcountry)->get();
           //Custom::showAll($states->toArray());die;
            return json_encode($states);


        }



    }


    /*
       * Function for applying coupon
       *
       */
    public function applyCoupon(Request $request){
        if($request->ajax()){

            $code = $request->couponCode;

            $total = $request->total;

            $couponcodes =Coupon::select('id','code','percent_off','status')->where('status','=','1')->where(DB::raw('BINARY `code`'), $code)->first();

            if($couponcodes){

                $coupon_id=$couponcodes->id;
                $percent_off = $couponcodes->percent_off;
                $discount = floatval(($total * $percent_off)/100);


                return json_encode(array($discount,$coupon_id));
            }
            else{

                return json_encode("false");
            }
        }
    }

    /*
    * Function to store user_address
    *
    */
    public function storeUserAddress(Request $request){

        $user_address = array();
        //Custom::showAll($request->toArray());die;

        $country = Countries::where('id','=',$request->country)->first();
        $state = States::where('id','=',$request->state)->first();
        //Custom::showAll($country->name);
        //Custom::showAll($state->name);die;

        $user_id = $request->user_id;
        $user_address['company_name'] = $request->company_name;
        $user_address['email'] = $request->email;
        $user_address['title'] = $request->title;
        $user_address['first_name'] = $request->first_name;
        $user_address['middle_name'] = $request->middle_name;
        $user_address['last_name'] = $request->last_name;
        $user_address['address1'] = $request->address1;
        $user_address['address2'] = $request->address2;
        $user_address['zip_code'] = $request->zip_code;
        $user_address['state'] = $state->name;
        $user_address['country'] = $country->name;
        $user_address['contact_no'] = $request->contact_no;
        $user_address['message'] = $request->message;

        $updateAddress = User_address::findOrFail($user_id);
        $updateAddress->update($user_address);
    }

    /*
       * Function for store order
       *
       */
    public function orderStore(Request $request)
    {

       //Custom::showAll($request->toArray());die;

        if($this->validate($request, [
            'payment_gateway'=> 'required',
            'email'=> 'required|email',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'address1'=> 'required',
            'zip_code'=> 'required|size:6',
            'country'=> 'required',
            'state'=> 'required',
            'contact_no'=> 'required',
        ])){

            $user_order = array();
            $user_id = Auth::user()->id;

            $billing_address = User_address::select('id')->where('user_id','=',$user_id)->where('primary','=','1')->first();

            $user_order['user_id'] = $user_id;
            $user_order['coupon_id'] = $request->coupon;
            $user_order['payment_gateway_id'] = $request->payment_gateway;
            $user_order['grand_total'] = $request->grand_total;
            $user_order['shipping_charges'] = $request->shipping_charge == "Free" ? 0 :$request->shipping_charge;
            $user_order['billing_address'] = $billing_address->id;
            $user_order['discount'] = $request->discount;

            $this->storeUserAddress($request);
            $data1 = User_order::create($user_order);

            $order_id = $data1->id;
            $this->storeOrderDetail($order_id);
            //Cart::destroy();

            if($request->payment_gateway == 1){

               $order_review_page = $this->orderReview($order_id);

              //Custom::showAll($order_review_page);die;

               return view('order_review',array('order_review_page' => $order_review_page));

            }
            else{

                //echo "paypal";die;
                $provider = PayPal::setProvider('express_checkout');  // To use express checkout(used by default).

                $data=[];
                $data['items'] = Order_details::Join('products','order_details.product_id','=','products.id')
                    ->join('image_products as i', 'products.id','=','i.product_id')
                    ->select('products.*','i.product_image_name','order_details.order_id','order_details.quantity')
                    ->where('order_details.order_id','=',$order_id)
                    ->get();
//                Custom::showAll($data);die;
                $order_products = [];
                $total = 0;
                foreach ($data['items'] as $item => $product)
                {
                    $order_products['items'][0]['name']=$product->product_name;
                    $order_products['items'][0]['price']=$product->price;
                    $order_products['items'][0]['qty']=$product->quantity;
                    $subtotal = floatval($product->quantity * $product->price);
                    $total += $subtotal;
                }
                $order_products['total'] = $total;

                $order_products['invoice_id'] = $order_id;
                $order_products['invoice_description'] = "Order #{$order_products['invoice_id']} Invoice";
                $order_products['return_url'] = url('/payment/success');
                $order_products['cancel_url'] = url('/cart');

               //Custom::showAll($order_products);die;
//                $response = $provider->setExpressCheckout($data);

               //Use the following line when creating recurring payment profiles (subscriptions)


                $data1 = [];
                $data1['items'] = [
                    [
                        'name' => 'Product 1',
                        'price' => 9.99,
                        'qty' => 1
                    ],
                    [
                        'name' => 'Product 2',
                        'price' => 4.99,
                        'qty' => 2
                    ]
                ];

                $data1['invoice_id'] = 1;
                $data1['invoice_description'] = "Order #{$data1['invoice_id']} Invoice";
                $data1['return_url'] = url('/payment/success');
                $data1['cancel_url'] = url('/cart');

                $total = 0;
                foreach($data1['items'] as $item) {
                    $total += $item['price']*$item['qty'];
                }

                $data1['total'] = $total;

                $response = $provider->setExpressCheckout($data1);

                //print_r($response);die;
                // This will redirect user to PayPal
                return redirect($response['paypal_link']);


            }
        }

    }

    public function storeOrderDetail($id){


        $cart = Cart::content();
        foreach ($cart as $item => $cartitem)
        {
            $cart_item = array();
            $order_details = array();

            array_push($cart_item , $cartitem);

            $order_details['amount'] = $cartitem->price;
            $order_details['product_id'] = $cartitem->id;
            $order_details['quantity'] = $cartitem->qty;
            $order_details['order_id'] =  $id;

            Order_details::create($order_details);

        }
    }
    /*
     * Function for order review page
     */
    public function orderReview($order_id){


        /*return view('order_review');
        die;*/
        //$order_id = 1;
        $user_id = Auth::user()->id;

        $user_info = User_address::where('user_id',"=",$user_id)->first();
       //Custom::showAll($user_info);die;


        $order_details = Order_details::Join('products','order_details.product_id','=','products.id')
            ->join('image_products as i', 'products.id','=','i.product_id')
            ->select('products.*','i.product_image_name','order_details.order_id','order_details.quantity')
            ->where('order_details.order_id','=',$order_id)
            ->get();


        $order_product = array();

        $order_products=array();
        foreach ($order_details as $item => $product)
        {
            $order_product['price']=$product->price;
            $order_product['quantity']=$product->quantity;
            $order_product['image_name']=$product->product_image_name;
            $subtotal = floatval($product->quantity * $product->price);
            $order_product['subtotal']=$subtotal;
            $order_product['name']=$product->product_name;
            $order_products[] = $order_product;

        }
        /*Custom::showAll($order_products);

        die;*/
        $payment_details = User_order::select('id','grand_total','shipping_charges','discount')->where('id','=',$order_id)->first();

        //Custom::showAll($payment_details->toArray());die;


        return array('user_info' => $user_info,'order_products' => $order_products,'payment_details' => $payment_details );

        //redirect('order_review')->with(['user_info' => $user_info,'order_products' => $order_products,'payment_details' => $payment_details]);

        //return redirect()->route('order_review',['user_info' => $user_info,'order_products' => $order_products,'payment_details' => $payment_details]);


    }


    public function payWithPaypal(){

        return view('paypal');
    }

}

