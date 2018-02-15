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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $authUser = Auth::user();

        $register_users = User::selectRaw('count(id) as data,YEAR(created_at) year,MONTH(created_at) month')
            ->groupby('year', 'month')
            ->get();

        $orders = User_order::selectRaw('count(id) as data,YEAR(created_at) year,MONTH(created_at) month')
            ->groupby('year', 'month')
            ->get();

        $coupon_data = Coupon::select('code', 'no_of_uses')->get();

        return view('admin.dashboard', array('authUser' => $authUser, 'register_users' => $register_users, 'orders' => $orders, 'coupon_data' => $coupon_data));

    }

}