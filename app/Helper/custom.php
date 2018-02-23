<?php

namespace App\Helper;

use App\User_wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Auth;
class Custom {

    // Function for printing data
    public static function showAll($array) {
        echo "<pre>";
        print_r($array);
    }

    // Function for Query
    public static function runQuery(){
        echo "<pre>";
        print_r(DB::getQueryLog());

    }

    //Function for Image Existence
    public static function imageExistence($val){

        if(isset($val) && $val!=''){
           if(file_exists('img/product/'.$val)){
               return $val;
            }
            else{
                return $defaultImage="defaultimage.jpeg";
            }
        }
        else{
            return $defaultImage="defaultimage.jpeg";
        }
    }
    /**
     * static function for wishlist count
     *
     * @return $wishlist_count
     */
    public static function wishListCount(){

        if(Auth::user()){
            $wishlist_count = User_wishlist::where('user_id',Auth::user()->id)->get()->count();
            return $wishlist_count ;
        }else{
            redirect('/');
        }
    }
}