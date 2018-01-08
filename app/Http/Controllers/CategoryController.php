<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Helper\Custom;
use App\Category_product;
use App\Product;
use App\Category;
use App\Banner;
use Illuminate\Http\Response;
use Auth;

class CategoryController extends Controller
{


    public function categoryProducts($id)
    {

        $products = Category_product::select('category_id','product_id')->with((['products' => function($query){
            $query->select('id','product_name','price');
            $query->with(['image'=>function($query1){
                $query1->select('product_image_name','product_id');
            }]);
        }]))->where('category_id','=',$id)->get();

        $banner_images = Banner::select('banner_name','banner_image')
            ->where('status','=','1')->get();

        $categories = Category::with('sub_category')->where('parent_id','=',0)->get();

        $categoryName = Category::select('id','name')->where('id','=',$id)->first();

        /*$my_wishlist =array();
        if(Auth::user() && $my_wishlist == ''){

            $userId = Auth::user()->id;
            $wishlist_products = User::with(['user_wishlist'=>function($query){
                $query->select('id','user_id','product_id');
            }])->where('id','=',$userId)->first();

            foreach ( $wishlist_products->user_wish_list as $key => $wlist ) {
                array_push($my_wishlist,$wlist->product_id);
            }
        }*/

        return view('category_products', array('products' => $products,'categories'=>$categories,'banner_images'=>$banner_images,'categoryName'=>$categoryName/*,'my_wishlist'=>$my_wishlist*/));


    }

    public function ajaxByCategoryId(Request $request ){

        if($request->ajax()){

            $id = $request->id;
            $products = Category_product::select('category_id','product_id')->with((['products' => function($query){
                $query->select('id','product_name','price');
                $query->with(['image'=>function($query1){
                    $query1->select('product_image_name','product_id');
                }]);
            }]))->where('category_id','=',$id)->limit(4)->get();

            return json_encode($products);
        }
    }
}