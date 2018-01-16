<?php

namespace App\Http\Controllers;


use App\Coupon;
use App\Helper\Custom;
use App\Product;
use App\User_address;
use App\User_order;
use Illuminate\Http\Request;
Use Cart;
Use DB;
use Illuminate\Support\Facades\Auth;


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

        //Custom::showAll($cart->toArray());die;

        return view('checkout',array('user'=>$user,'cart'=>$cart,'codes'=>$codes));
    }

    /*
    * Function to store user_address
    *
    */
    public function storeUserAddress(Request $request){

        $user_address = array();
       //Custom::showAll($request->toArray());die;


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
        $user_address['state'] = $request->state;
        $user_address['country'] = $request->country;
        $user_address['contact_no'] = $request->contact_no;
        $user_address['message'] = $request->message;

        $updateAddress = User_address::findOrFail($user_id);
        $updateAddress->update($user_address);
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
       * Function for store order
       *
       */
    public function orderStore(Request $request)
    {

        $user_order = array();
        $this->validate($request, [
            'payment_gateway'=> 'required',
        ]);

        $user_id = Auth::user()->id;

        $billing_address = User_address::select('id')->where('user_id','=',$user_id)->where('primary','=','1')->first();

        $user_order['user_id'] = $user_id;
        $user_order['coupon_id'] = $request->coupon;
        $user_order['payment_gateway_id'] = $request->payment_gateway;
        $user_order['grand_total'] = $request->grand_total;
        $user_order['shipping_charges'] = $request->shipping_charge;
        $user_order['billing_address'] = $billing_address->id;
        $this->storeUserAddress($request);
        User_order::create($user_order);

        return redirect('order_review');
    }

    /*
      * Function for review order
      *
      */
    public function orderReview(){



        return view('order_review');

    }

}

