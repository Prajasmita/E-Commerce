<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Category_product;
use App\Helper\Custom;
use App\Product;
use App\User;
use App\User_wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the Ecommerce shopping site.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $banner_images = Banner::select('banner_name','banner_image')
            ->where('status','=','1')->get();

        $categories = Category::with('sub_category')->where('parent_id','=',0)->get();

        $featured_products = Product::with('image_products')->where('is_feature','=','1')->get();

        $my_wishlist =array();
        if(Auth::user()){
            $userId = Auth::user()->id;
            $wishlist_products = User::with(['user_wishlist'=>function($query){
                $query->select('id','user_id','product_id');
            }])->where('id','=',$userId)->first();

            $my_wishlist = array();

            foreach ( $wishlist_products->user_wishlist as $key => $wlist ) {
                array_push($my_wishlist,$wlist->product_id);
            }
        }

        $products = Category_product::select('category_id','product_id')->with((['products' => function($query){
            $query->select('id','product_name','price');
            $query->with(['image'=>function($query1){
                $query1->select('product_image_name','product_id');
            }]);
        }]))->where('category_id','=','1')->limit(4)->get();


        $cart_product = array();
        if(Cart::count()){
            foreach ( Cart::content() as $item => $cart_list ) {
                array_push( $cart_product,$cart_list->id);
            }
        }

        return view('home', array('banner_images' => $banner_images, 'categories' => $categories, 'featured_products' => $featured_products,'products'=>$products,'my_wishlist'=>$my_wishlist,'cart_product'=>$cart_product));

    }


    public function userLogin()
    {
        return view('user_login');
    }
}
