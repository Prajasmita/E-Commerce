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
    public function index(Request $request){

        $user_orders = array();
        $result = array();
        if($request->ajax()) {

            $totalRecords = User_order::count();

            $limit=$request->input('length');
            if($limit == -1){
                $limit = $totalRecords;
            }

            $offset=$request->input('start');
            $search=$request->input('search');
            $search_word=trim($search['value']);
            $draw = $request->input('draw');
            $column = $request->input('columns');
            $order = $request->input('order');
            /*$sortBy = $order[0]['column'];
            $sortOf = $order[0]['dir'];
            $date = $column[$sortBy]['data'];
            $orderId = $column[$sortBy]['data'];*/

            $user_orders = User_order::select('id','grand_total','user_id','status','payment_gateway_id','created_at');

            //Custom::showAll($user_orders);die;
            $user_orders = $user_orders
                ->skip($offset)
                ->take($limit)
                /*->orderBy($date , $sortOf)
                ->orderBy($orderId ,$sortOf)*/
                ->get();

            if ($search_word != '' ) {

                $user_orders = User_order::where('created_at', 'LIKE', "%$search_word%")
                    ->orWhere('order_id', 'LIKE', ltrim("%$search_word%",'0'));
            }

            if ($search_word != '' ) {
                $recordsFiltered = $user_orders->count();
                $recordsTotal = $user_orders->count();

            }else{
                $recordsFiltered = User_order::count();
                $recordsTotal = User_order::count();
            }
            /*$recordsFiltered = User_order::count();
            $recordsTotal = User_order::count();*/

            $final = array();
            foreach($user_orders as $key => $val){
                $res_data = array();
                $res_data['user_id'] = $val['user_id'];
                $res_data['id'] = $val['id'];
                $res_data['date'] = $val['created_at']->format('j F, Y');
                $res_data['order_id'] = 'ORD'.str_pad($val['id'] , '4','0',STR_PAD_LEFT);
                $res_data['total'] = $val['grand_total'];
                $res_data['status'] = $val['status'] == 'O' ? 'Processing' : 'Pending';
                $res_data['payment'] = $val['payment_gateway_id'] == 1 ? 'COD' : 'Paypal' ;
                $final[] = $res_data;
            }

            //Custom::showAll($final);die;

            $result['draw'] = $draw;
            $result['recordsFiltered'] =$recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] =   $final;

            return $result;
        }

        $authUser = Auth::user();
        return view('admin.user_orders.index', compact('templates','authUser'),array('js'=>'user_order_listing'));

    }

    /**
     * Function for user order details.
     *
     */
    public function orderDetails($order_id){

        $authUser =  Auth::user();

        $order_review_page = $this->orderReview($order_id);

        return view('admin.user_orders.show', array('authUser'=>$authUser,'order_review_page' => $order_review_page));



    }
    /*
     * Function for order review page variables.
     */
    public function orderReview($order_id)
    {

        $payment_details = User_order::select('id','user_id','grand_total', 'shipping_charges', 'discount', 'status')->where('id', '=', $order_id)->first();
        

        $user_info = User_address::where('user_id', "=", $payment_details->user_id)->first();
        //Custom::showAll($user_info);die;

        $country = Countries::where('id', '=', $user_info->country)->first();
        $state = States::where('id', '=', $user_info->state)->first();


        $user_info['country'] = $country->name;
        $user_info['state'] = $state->name;

        //Custom::showAll($user_info->toArray());die;

        $order_details = Order_details::Join('products', 'order_details.product_id', '=', 'products.id')
            ->join('image_products as i', 'products.id', '=', 'i.product_id')
            ->select('products.*', 'i.product_image_name', 'order_details.order_id', 'order_details.quantity','order_details.created_at')
            ->where('order_details.order_id', '=', $order_id)
            ->get();

        $order_product = array();

        $order_products = array();
        foreach ($order_details as $item => $product) {
            $order_product['price'] = $product->price;
            $order_product['quantity'] = $product->quantity;
            $order_product['image_name'] = $product->product_image_name;
            $subtotal = floatval($product->quantity * $product->price);
            $order_product['subtotal'] = $subtotal;
            $order_product['name'] = $product->product_name;
            $order_products[] = $order_product;

        }


        return array('user_info' => $user_info, 'order_products' => $order_products, 'payment_details' => $payment_details);

    }




}