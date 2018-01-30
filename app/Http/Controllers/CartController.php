<?php

namespace App\Http\Controllers;


use App\Countries;
Use Illuminate\Support\Facades\URL;
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
Use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
Use Illuminate\Support\Facades\Redirect;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;




class CartController extends Controller
{

    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');

        //Custom::showAll($paypal_conf);die;
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


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


        $user_id = Auth::user()->id;

        $user = User_address::where('primary','=','1')->where('user_id','=',$user_id)->first();

        //Custom::showAll($user);die;
        $cart = Cart::content();

        $coupons = Coupon::select('id','code')->get();
        $codes = array();
        foreach ($coupons as $code => $coupon ){
            array_push($codes,$coupon->id);
        }

        $countries = Countries::get();

        if($user){
            $states = States::where('country_id','=',$user->country)->get();
            return view('checkout',array('user'=>$user,'cart'=>$cart,'user_id'=> $user_id,'codes'=>$codes,'countries'=>$countries,'states' => $states));

        }else{
            $states = States::get();
            return view('checkout',array('user'=>$user,'user_id'=> $user_id,'cart'=>$cart,'codes'=>$codes,'countries'=>$countries,'states' => $states));
        }

    }
    /*
       * Function for applying coupon
       *
       */
    public function selectStates(Request $request){

        if($request->ajax()){

            $selectedcountry = $request->country;
            $states = States::select('id','name')->where('country_id','=',$selectedcountry)->get();
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

            $couponcodes =Coupon::select('id','code','percent_off','no_of_uses','status')->where('status','=','1')->where(DB::raw('BINARY `code`'), $code)->first();

            if($couponcodes){

                $coupon_id=$couponcodes->id;
                $percent_off = $couponcodes->percent_off;
                $discount = floatval(($total * $percent_off)/100);

                $coupon_used_count = intval(($couponcodes->no_of_uses == NULL ? 0 : $couponcodes->no_of_uses ) + 1) ;

                Coupon::where('id','=',$coupon_id)->update(array('no_of_uses' => $coupon_used_count));

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
        $user_address['note'] = $request->message;

       // Custom::showAll($user_address);die;

        $updateAddress = User_address::where('user_id','=',$user_id);

        //Custom::runQuery();die;
        $updateAddress->update($user_address);
    }

    /*
       * Function for store order
       *
       */
    public function orderStore(Request $request)
    {

        //Custom::showAll($request->toArray());die;

        if ($this->validate($request, [
            'payment_gateway' => 'required',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address1' => 'required',
            'zip_code' => 'required|size:6',
            'country' => 'required',
            'state' => 'required',
            'contact_no' => 'required',
        ])) {

            $user_order = array();
            $user_id = Auth::user()->id;

            $billing_address = User_address::select('id')->where('user_id', '=', $user_id)->where('primary', '=', '1')->first();

            $user_order['user_id'] = $user_id;
            $user_order['coupon_id'] = $request->coupon;
            $user_order['payment_gateway_id'] = $request->payment_gateway;
            $user_order['grand_total'] = $request->grand_total;
            $user_order['shipping_charges'] = $request->shipping_charge == "Free" ? 0 : $request->shipping_charge;
            $user_order['billing_address'] = $billing_address ? $billing_address->id : '';
            $user_order['discount'] = $request->discount;
            $user_order['status'] = 'P';


            $this->storeUserAddress($request);

            $data1 = User_order::create($user_order);

            $order_id = $data1->id;
            $this->storeOrderDetail($order_id);
            //Cart::destroy();
            if ($request->payment_gateway == 1) {

                User_order::where('id', '=', $order_id)->update(array('status' => 'O'));

                $order_review_page = $this->orderReview($order_id);

                //Custom::showAll($order_review_page);die;

                return view('order_review', array('order_review_page' => $order_review_page));

            } else {

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');


                $order_details = Order_details::Join('products', 'order_details.product_id', '=', 'products.id')
                    ->join('image_products as i', 'products.id', '=', 'i.product_id')
                    ->select('products.*', 'i.product_image_name', 'order_details.order_id', 'order_details.quantity')
                    ->where('order_details.order_id', '=', $order_id)
                    ->get();

                /*Custom::showAll($order_details->toArray());
                die;*/
                User_order::where('id', '=', $order_id)->update(array('status' => 'P'));


                $payment_details = User_order::select('id', 'grand_total', 'shipping_charges', 'discount')->where('id', '=', $order_id)->first();

                //Custom::showAll($payment_details->toArray());die;

                foreach ($order_details as $order) {

                    $item = new Item();

                    $item->setName($order->product_name)/** item name **/
                    ->setCurrency('USD')
                        ->setQuantity($order->quantity)
                        ->setPrice($order->price);
                    $new[] = $item;
                }

                /*Custom::showAll($new);
                die;*/
                $item_list = new ItemList();
                $item_list->setItems($new);
                //Custom::showAll($item_list);die;

                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($payment_details->grand_total);


                //dd($amount);
                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list);

                //Custom::showAll($transaction);die;

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('paypalsuccess'))/** Specify return URL **/
                ->setCancelUrl(URL::route('checkout'));

                //echo "hiii";die;

                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

                //dd($payment);
                /*dd($payment->create($this->_api_context));

                 exit;*/

                try {

                    //echo "jsdhfjk";die;
                    $payment->create($this->_api_context);
                    //dd($payment);


                } catch (\PayPal\Exception\PPConnectionException $ex) {

                    if (\Config::get('app.debug')) {
                        \Session::put('error', 'Connection timeout');
                        return Redirect::route('paywithpaypal');
                        /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                        /** $err_data = json_decode($ex->getData(), true); **/
                        /** exit; **/
                    } else {
                        \Session::put('error', 'Some error occur, sorry for inconvenient');
                        return Redirect::route('paywithpaypal');
                        /** die('Some error occur, sorry for inconvenient'); **/

                    }
                }

                foreach ($payment->getLinks() as $link) {
                    if ($link->getRel() == 'approval_url') {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }

                /** add payment ID to session **/
                Session::put('paypal_payment_id', $payment->getId());

                if (isset($redirect_url)) {
                    /** redirect to paypal **/
                    return Redirect::away($redirect_url);
                }

                \Session::put('error', 'Unknown error occurred');
                return Redirect::route('checkout');
            }
        }
    }





    public function storeOrderDetail($id){

        //echo "hello";die;

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
        //Custom::showAll($user_info->toArray());

        $country = Countries::where('id','=',$user_info->country)->first();
        $state = States::where('id','=',$user_info->state)->first();


        $user_info['country'] = $country->name;
        $user_info['state'] = $state->name;

        //Custom::showAll($user_info->toArray());die;

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

    public function paypalPaymentSuccess(){

        echo "hellooooo";die;
/*        $user_order::where('id','=',$order_id)->update(array('status' => 'P'));*/

      /* 127.0.0.1:8000/paypal
        ?paymentId=PAY-38152819VE720423VLJX7PVY
        &token=EC-8MT33991KF190133B&PayerID=CCSYPP7J6ASR4*/

      $payment_Id = $_GET['paymentId'];
      $payer_id = $_GET['PayerID'];



      /*dd($payer_id);
      die;*/




    }


}

