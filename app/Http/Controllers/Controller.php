<?php
/**
 * Parent Class Controller.
 *
 * Author : Prajakta Sisale.
 */
namespace App\Http\Controllers;

use App\Configuration;
use App\Helper\Custom;
use App\User_wishlist;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
Use Cache;
use Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /*
     * public variable
     */
    public $conf ;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $value = Cache::rememberForever('configuration', function () {
            return Configuration::get();
        });
        $this->conf = ($value->pluck('conf_value','conf_key'))->toArray();
    }
    /**
     *  function for wishlist count
     *
     *  calling helper custom function
     */
    public function wishListCount(){
        Custom::wishListCount();
    }
}


