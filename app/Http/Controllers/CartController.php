<?php

namespace App\Http\Controllers;

Use App\Product;
Use App\Configuration;
use App\Countries;
Use Illuminate\Support\Facades\URL;
use App\Coupon;
use App\Helper\Custom;
use App\Order_details;
use App\States;
use App\User_address;
use App\User_order;
use Illuminate\Http\Request;
Use View;
Use Cart;
Use Mail;
Use DB;
Use Cost;
Use PayPal\Api\Invoice;
Use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
Use Illuminate\Support\Facades\Redirect;
Use App\Email_template;
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
use Symfony\Component\VarDumper\Caster\CutArrayStub;


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

            $quantity =  ($request->qty == 0) ? 1 :  $request->qty ;

            $products = Product::with(['image' => function ($query) {
                $query->get();
            }])->select('id', 'product_name', 'price', 'quantity')->where('id', '=', $id)->first()->toArray();

            $products['image'] = empty($products['image']) ? Custom::imageExistence('') : Custom::imageExistence($products['image']['product_image_name']);

            Cart::add(array('id' => $id, 'name' => $products['product_name'], 'qty' => $quantity, 'price' => $products['price'], 'options' => ['image' => $products['image']]));

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

            } else {
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

            Cart::remove($rowId);
            return json_encode("true");
        }
    }

    /*
    * Function for checkout
    *
    */
    public function checkout()
    {


        $user_id = Auth::user()->id;

        $user = User_address::where('primary', '=', '1')->where('user_id', '=', $user_id)->first();

        $cart = Cart::content();
        $coupons = Coupon::select('id', 'code')->get();
        $codes = array();
        foreach ($coupons as $code => $coupon) {
            array_push($codes, $coupon->id);
        }

        $countries = Countries::get();
        if ($user) {
            $states = States::where('country_id', '=', $user->country)->get();
            return view('checkout', array('user' => $user, 'cart' => $cart, 'user_id' => $user_id, 'codes' => $codes, 'countries' => $countries, 'states' => $states));

        } else {
            $states = States::get();
            return view('checkout', array('user' => $user, 'user_id' => $user_id, 'cart' => $cart, 'codes' => $codes, 'countries' => $countries, 'states' => $states));
        }

    }

    /*
       * Function for applying coupon
       *
       */
    public function selectStates(Request $request)
    {

        if ($request->ajax()) {

            $selectedcountry = $request->country;
            $states = States::select('id', 'name')->where('country_id', '=', $selectedcountry)->get();
            return json_encode($states);

        }

    }


    /*
       * Function for applying coupon
       *
       */
    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {

            $code = $request->couponCode;

            $total = $request->total;

            $couponcodes = Coupon::select('id', 'code', 'percent_off', 'no_of_uses', 'status')->where('status', '=', '1')->where(DB::raw('BINARY `code`'), $code)->first();

            if ($couponcodes) {

                $coupon_id = $couponcodes->id;
                $percent_off = $couponcodes->percent_off;
                $discount = floatval(($total * $percent_off) / 100);

                $coupon_used_count = intval(($couponcodes->no_of_uses == NULL ? 0 : $couponcodes->no_of_uses) + 1);

                Coupon::where('id', '=', $coupon_id)->update(array('no_of_uses' => $coupon_used_count));

                return json_encode(array($discount, $coupon_id));
            } else {

                return json_encode("false");
            }
        }
    }

    /*
    * Function to store user_address
    *
    */
    public function storeUserAddress(Request $request)
    {

        $user_address = array();

        $address = User_address::where('user_id', '=', $request->user_id)->get()->toArray();

        if (!empty($address)) {

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

            $updateAddress = User_address::where('user_id', '=', $user_id);

            $updateAddress->update($user_address);
        } else {

            $request['primary'] = '1';

            User_address::create($request->all());

        }

    }

    /*
       * Function for store order
       *
       */
    public function orderStore(Request $request)
    {

        if ($this->validate($request, [
            'payment_gateway' => 'required',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'address1' => 'required',
            'zip_code' => 'required|size:6',
            'country' => 'required',
            'city' => 'required',
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

            Cart::destroy();

            if ($request->payment_gateway == 1) {


                User_order::where('id', '=', $order_id)->update(array('status' => 'O'));

                $order_review_page = $this->orderReview($order_id);

                $this->sendMails($order_review_page);

                $request->session()->flash('payment_message', 'Payment Mode will be cash on delivery. Thank you For Using Our Shopping Cart !!!');


                return view('order_review', array('order_review_page' => $order_review_page));

            } else {

                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $order_details = Order_details::with(['product' => function ($query) {
                    $query->with('image')->get();
                }])->where('order_id', '=', $order_id)->get()->toArray();

                User_order::where('id', '=', $order_id)->update(array('status' => 'P'));


                $subtotal = 0;
                foreach ($order_details as $order) {

                    $item = new Item();

                    $item->setName($order['product']['0']['product_name'])/** item name **/
                    ->setCurrency('USD')
                        ->setQuantity($order['quantity'])
                        ->setPrice($order['amount']);
                    $new[] = $item;

                    $subtotal = $subtotal + ($order['quantity'] * $order['amount']);

                }

                $item_list = new ItemList();
                $item_list->setItems($new);

                $ship_tax = 0;

                $user_order_details = User_order::where('id', '=', $order_id)->first();
                $ship_cost = $user_order_details->shipping_charges;
                $currency = 'USD';
                $discount = $user_order_details->discount;

                $total = $subtotal + $ship_tax + $ship_cost - $discount;

                $details = new Details();
                $details->setSubtotal($subtotal)
                    ->setTax($ship_tax)
                    ->setShipping($ship_cost)
                    ->setShippingDiscount($discount);

                $amount = new Amount();
                $amount->setCurrency($currency)
                    ->setTotal($total)
                    ->setDetails($details);

                $transaction = new Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list);


                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('paypalsuccess', ['id' => $order_id]))/** Specify return URL **/
                ->setCancelUrl(URL::route('checkout'));


                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

                try {

                    $payment->create($this->_api_context);


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


    public function storeOrderDetail($id)
    {

        $cart = Cart::content();

        foreach ($cart as $item => $cartitem) {
            $cart_item = array();
            $order_details = array();

            array_push($cart_item, $cartitem);

            $order_details['amount'] = $cartitem->price;
            $order_details['product_id'] = $cartitem->id;
            $order_details['quantity'] = $cartitem->qty;

            $product = Product::select('quantity')->where('id', '=', $order_details['product_id'])->first();

            $updated_product_qty = intval($product->quantity) - intval($order_details['quantity']);

            Product::where('id', '=', $order_details['product_id'])->update(array('quantity' => $updated_product_qty));

            $order_details['order_id'] = $id;

            Order_details::create($order_details);

        }
    }

    /*
     * Function for order review page
     */
    public function orderReview($order_id)
    {

        $user_id = Auth::user()->id;

        $user_info = User_address::where('user_id', "=", $user_id)->first();

        $country = Countries::where('id', '=', $user_info->country)->first();
        $state = States::where('id', '=', $user_info->state)->first();


        $user_info['country'] = $country->name;
        $user_info['state'] = $state->name;

        $order_details = Order_details::with(['product' => function ($query) {
            $query->with('image')->get();
        }])->where('order_id', '=', $order_id)->get()->toArray();

        $order_product = array();
        $order_products = array();

        foreach ($order_details as $item => $product) {

            $order_product['price'] = $product['amount'];
            $order_product['quantity'] = $product['quantity'];
            $order_product['image_name'] = empty($product['product']['0']['image']['product_image_name'])
                ? Custom::imageExistence('')
                : Custom::imageExistence($product['product']['0']['image']['product_image_name']);
            $subtotal = floatval($product['quantity'] * $product['amount']);
            $order_product['subtotal'] = $subtotal;
            $order_product['name'] = $product['product']['0']['product_name'];
            $order_products[] = $order_product;

        }

        $payment_details = User_order::select('id', 'grand_total', 'shipping_charges', 'discount', 'status')->where('id', '=', $order_id)->first();

        return array('user_info' => $user_info, 'order_products' => $order_products, 'payment_details' => $payment_details);

    }

    /**
     * Function for paypal payment success
     *
     *
     */
    public function paypalPaymentSuccess($id, Request $request)
    {

        $payment_Id = $_GET['paymentId'];
        User_order::where('id', '=', $id)->update(array('status' => 'O', 'transaction_id' => $payment_Id));

        $order_review_page = $this->orderReview($id);
        $this->sendMails($order_review_page);

        $request->session()->flash('payment_message', 'Payment Done Succesfully !! Thank You For Using Our Shopping Cart !!!');

        return view('order_review', array('order_review_page' => $order_review_page));

    }

    /**
     * Function for fetching my orders
     *
     *
     */
    public function myOrders()
    {

        $user_id = Auth::user()->id;

        $my_order = User_order::with('order_details')->where('user_id', '=', $user_id)->get();

        return view('my_orders', array('my_order' => $my_order));

    }

    /**
     * Function for fetching my orders
     *
     *
     */
    public function myOrder($id)
    {

        $order_review_page = $this->orderReview($id);

        return view('my_order', array('order_review_page' => $order_review_page));
    }

    /**
     * Function for tracking order
     *
     */
    public function trackOrder()
    {

        return view('track_order');
    }

    public function trackMyOrder(Request $request)
    {

        if ($this->validate($request, [
            'order_id' => 'required',
            'email' => 'required|email'])) {

            $email = $request->email;
            $order_id = $request->order_id;


            $orderId = ltrim($order_id, "ORD0");

            $order_review_page = $this->orderReview($orderId);


            Mail::send('order_review', ['order_review_page' => $order_review_page], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Order Review');
            });

            return redirect('track_order')->with('traced_order', 'Order Traced Succesfully !!!');


        }

    }

    /**
     * Function for sending mail to admin and customer about placed order
     *
     */
    public function sendMails($order_review_page)
    {

        $user_order = User_order::where('id', '=', $order_review_page['payment_details']['id'])->first();

        $view = View::make('admin.email_template.order_details_table', ['order_review_page' => $order_review_page]);
        $html = $view->render();

        $template_content = Email_template::where('title', '=', 'order_details')->select('content')->first();


        $email = 'prajakta.sisale@neosofttech.com';

        $string = array('{{first_name}}', '{{email}}', '{{contact_no}}', '{{address1}}', '{{city}}', '{{state}}', '{{payment status}}', '{{last_name}}', '{{address2}}', '{{zip_code}}', '{{country}}', '{{order_id}}', '{{created date}}', '{{product table}}');

        $replace = array($order_review_page['user_info']['first_name'], $email, $order_review_page['user_info']['contact_no'], $order_review_page['user_info']['address1'], $order_review_page['user_info']['city'], $order_review_page['user_info']['state'], ($order_review_page['payment_details']['status'] == 'O' ? 'Processing' : 'Pending'), $order_review_page['user_info']['last_name'], $order_review_page['user_info']['address2'], $order_review_page['user_info']['zip_code'], $order_review_page['user_info']['country'], ('ORD' . str_pad($order_review_page['payment_details']['id'], 4, '0', STR_PAD_LEFT)), ($user_order->created_at->format('j F, Y')), $html);


        $new_template_content = str_replace($string, $replace, $template_content->content);

        $admin_template_content = Email_template::where('title', '=', 'order_details_for_admin')->select('content')->first();

        $admin_email = Configuration::where('conf_key', '=', 'Admin_email')->select('conf_value')->first();

        $admin_mail = $admin_email->conf_value;

        $admin_content = str_replace($string, $replace, $admin_template_content->content);

        Mail::send([], [], function ($message) use ($new_template_content, $email) {
            $message->to($email)
                ->subject('Placed Order Details')
                ->setBody($new_template_content, 'text/html');
        });

        Mail::send([], [], function ($message) use ($admin_content, $admin_mail) {
            $message->to($admin_mail)
                ->subject('Order Details of customer')
                ->setBody($admin_content, 'text/html');
        });
    }

}

