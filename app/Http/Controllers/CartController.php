<?php

namespace App\Http\Controllers;


use App\Coupon;
use App\Helper\Custom;
use App\Product;
use App\User_address;
use Illuminate\Http\Request;
Use Cart;
Use DB;


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

        //Custom::showAll($cart->toArray());die;

        return view('checkout',array('user'=>$user,'cart'=>$cart));
    }

    /*
    * Function to store user_address
    *
    */
    public function storeUserAddress(Request $request){

        $request = array();

       // return view('checkout',array('user'=>$user));


    }
    /*
       * Function for applying coupon
       *
       */
    public function applyCoupon(Request $request){
        if($request->ajax()){

            $code = $request->couponCode;

            $total = $request->total;

            $couponcodes =Coupon::select('code','percent_off','status')->where('status','=','1')->where(DB::raw('BINARY `code`'), $code)->first();

            //Custom::showAll($couponcodes->toArray());die;

            if($couponcodes){

                $percent_off = $couponcodes->percent_off;
               //Custom::showAll($percent_off);
                $discount = floatval(($total * $percent_off)/100);

             //Custom::showAll($discount);

                return json_encode($discount);
            }
            else{

                return json_encode("false");
            }
        }
    }

}

