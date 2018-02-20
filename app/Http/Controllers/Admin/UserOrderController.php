<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Custom;
use App\Http\Controllers\Controller;
use App\User_address;
use App\User_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
Use DB;
use App\Countries;
use App\Order_details;
use App\States;
Use View;
Use Cart;
Use Cost;

/**
 * Class UserOrderController for orders details.
 *
 * Author : Prajakta Sisale.
 */
class UserOrderController extends Controller
{
    /**
     * Function for user order listing.
     *
     */
    public function index(Request $request)
    {
        $result = array();
        if ($request->ajax()) {

            $totalRecords = User_order::count();

            $limit = $request->input('length');
            if ($limit == -1) {
                $limit = $totalRecords;
            }

            $offset = $request->input('start');
            $search = $request->input('search');
            $search_word = trim($search['value']);

            $draw = $request->input('draw');

            $user_orders = User_order::select('id', 'grand_total', 'user_id', 'status', 'payment_gateway_id','order_no', 'created_at')->orderBy('created_at','desc');

            if ($search_word != '') {

                $user_orders = User_order::where('order_no', 'LIKE', "%$search_word%");


            }

            $user_orders = $user_orders
                ->skip($offset)
                ->take($limit)
                ->get();



            if ($search_word != '') {
                $recordsFiltered = $user_orders->count();
                $recordsTotal = $user_orders->count();

            } else {
                $recordsFiltered = User_order::count();
                $recordsTotal = User_order::count();
            }
            //Custom::runQuery();
            $final = array();
            foreach ($user_orders as $key => $val) {
                $res_data = array();
                $res_data['user_id'] = $val['user_id'];
                $res_data['id'] = $val['id'];
                $res_data['date'] = $val['created_at']->format('d M,Y');
                $res_data['order_no'] = $val['order_no'];
                $res_data['total'] = $val['grand_total'];
                $res_data['status'] = $val['status'] == 'O' ? 'Processing' : 'Pending';
                $res_data['payment'] = $val['payment_gateway_id'] == 1 ? 'COD' : 'Paypal';
                $final[] = $res_data;
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] = $final;

            return $result;
        }

        $authUser = Auth::user();
        return view('admin.user_orders.index', compact('templates', 'authUser'), array('js' => 'user_order_listing'));

    }

    /**
     * Function for user order details.
     *
     */
    public function orderDetails($order_id)
    {

        $authUser = Auth::user();

        $order_review_page = $this->orderReview($order_id);

        return view('admin.user_orders.show', array('authUser' => $authUser, 'order_review_page' => $order_review_page));


    }

    /*
     * Function for order review page variables.
     */
    public function orderReview($order_id)
    {

        $payment_details = User_order::select('id', 'user_id', 'grand_total', 'shipping_charges', 'discount', 'status','payment_gateway_id')->where('id', '=', $order_id)->first();

        $user_info = User_address::where('user_id', "=", $payment_details->user_id)->first();

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

        return array('user_info' => $user_info, 'order_products' => $order_products, 'payment_details' => $payment_details);

    }

}