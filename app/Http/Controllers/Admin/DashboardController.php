<?php

namespace App\Http\Controllers\Admin;
use App\Coupon;
use App\Http\Middleware\CheckRole;
use App\User;
use App\User_order;
Use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Helper\Custom;
use Illuminate\Http\Request;
Use DB;
Use \Khill\Lavacharts\Lavacharts;
Use Carbon\Carbon;
use Lava;
$lava = new \Khill\Lavacharts\Lavacharts;

/**
 * Class DashboardController for Dashboard.
 *
 * Author : Prajakta Sisale.
 */
class DashboardController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('checkrole');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request){


        $authUser = Auth::user();

        $register_users = User::selectRaw('count(id) as data,YEAR(created_at) year,MONTH(created_at) month')
            ->groupby('year','month')
            ->get();

        $orders = User_order::selectRaw('count(id) as data,YEAR(created_at) year,MONTH(created_at) month')
            ->groupby('year','month')
            ->get();

        $coupon_data = Coupon::select('code','no_of_uses')->get();
        //Custom::showAll($coupon_data->toArray());die;

        /*$coupons_data = array();


        $i = 0;
        foreach ( $coupons as $coupon ) {
            $coupons_data = array();
            array_push($coupons_data,$coupon->code);
            array_push($coupons_data,$coupon->no_of_uses);
            $arr_fin[$i] = $coupons_data;
            $i++;
        }
        $coupon_data = json_encode($arr_fin);*/


        return view('admin.dashboard', array('authUser' => $authUser,'register_users'=>$register_users,'orders'=>$orders,'coupon_data'=>$coupon_data));

    }

}