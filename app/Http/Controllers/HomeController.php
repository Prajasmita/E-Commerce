<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Category_product;
use App\Helper\Custom;
use App\Product;
use Illuminate\Http\Request;

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

//        Custom::runQuery();die;

        $categories = Category::with('sub_category')->where('parent_id','=',0)->get();

        $featured_products = Product::with('image_products')->where('is_feature','=','1')->get();
        //Custom::showAll($featured_products->toArray());die;

        $products = Category_product::select('category_id','product_id')->with((['products' => function($query){
            $query->select('id','product_name','price');
            $query->with(['image'=>function($query1){
                $query1->select('product_image_name','product_id');
            }]);
        }]))->where('category_id','=','1')->limit(4)->get();




        return view('home', array('banner_images' => $banner_images, 'categories' => $categories, 'featured_products' => $featured_products,'products'=>$products));

    }


    public function userLogin()
    {
        return view('user_login');
    }
}
