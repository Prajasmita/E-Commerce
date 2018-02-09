<?php


namespace App\Http\Controllers;

use App\Category;
use App\User_wishlist;
use Illuminate\Http\Request;
use App\Helper\Custom;
use App\Category_product;
use App\Product;
use App\User;
use Illuminate\Http\Response;
use Auth;
use Cart;

class ProductController extends Controller
{

    public function product_details($id )
    {

        $categories = Category::with('sub_category')->where('parent_id','=',0)->get();

        $products = Product::with('image_products','image')->select('id','product_name','price','quantity','short_discription','is_feature')->where('id','=',$id)->first()->toArray();

        if(empty($products['image_products'])){
                $products['image']['product_image_name'] = Custom::imageExistence('');
        }

        $my_wishlist =array();
        if(Auth::user() && $my_wishlist !== ''){

            $userId = Auth::user()->id;
            $wishlist_products = User::with(['user_wishlist'=>function($query){
                $query->select('id','user_id','product_id');
            }])->where('id','=',$userId)->first();

            foreach ( $wishlist_products->user_wishlist as $key => $wlist ) {
                array_push($my_wishlist,$wlist->product_id);
            }
        }

        $cart_product = array();
        if(Cart::count()){
            foreach ( Cart::content() as $item => $cart_list ) {
                array_push( $cart_product,$cart_list->id);
            }
        }

        return view('product_details',array('categories'=>$categories,'products'=>$products,'my_wishlist'=>$my_wishlist,'cart_product'=>$cart_product));
    }

    public function ajaxAddProductToWishlist(Request $request){

        $id = $request->id;
        $data=array();

        $product = Product::select('id')->where('id','=',$id)->first();
        $user = Auth::user()->id;

        $data['product_id']=$product->id;
        $data['user_id']=$user;

        User_wishlist::create($data);

        return json_encode('true');


    }

}
