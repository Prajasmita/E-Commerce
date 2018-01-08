<?php

namespace App\Http\Controllers\Admin;
use App\Http\Middleware\CheckRole;
Use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Helper\Custom;
use Illuminate\Http\Request;
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
    public function index()
    {

        $authUser = Auth::user();

       return view('admin.dashboard', array('authUser' => $authUser));

    }


}