<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Helper\Custom;
use App\Category_product;
use App\Category;
use App\User;
use App\Banner;
use Illuminate\Http\Response;
use Auth;
use Cart;

class CategoryController extends Controller
{


    public function categoryProducts($id)
    {
        $products = Category_product::select('category_id', 'product_id')->with((['products' => function ($query) {
            $query->select('id', 'product_name', 'price');
            $query->with(['image' => function ($query1) {
                $query1->select('product_image_name', 'product_id');
            }]);
        }]))->where('category_id', '=', $id)->get()->toArray();

        foreach ($products as $key => $value) {

            $products[$key]['products']['image'] = empty($value['products']['image']) ? Custom::imageExistence('') : Custom::imageExistence($value['products']['image']['product_image_name']);

        }

        $banner_images = Banner::select('banner_name', 'banner_image')
            ->where('status', '=', '1')->get();

        $categories = Category::with('sub_category')->where('parent_id', '=', 0)->get();

        $categoryName = Category::select('id', 'name')->where('id', '=', $id)->first();

        $my_wishlist = array();
        if (Auth::user()) {

            $userId = Auth::user()->id;
            $wishlist_products = User::with(['user_wishlist' => function ($query) {
                $query->select('id', 'user_id', 'product_id');
            }])->where('id', '=', $userId)->first();

            foreach ($wishlist_products->user_wishlist as $key => $wlist) {
                array_push($my_wishlist, $wlist->product_id);
            }
        }
        $cart_product = array();
        if (Cart::count()) {
            foreach (Cart::content() as $item => $cart_list) {
                array_push($cart_product, $cart_list->id);
            }
        }

        return view('category_products', array('conf'=> $this->conf,'products' => $products, 'categories' => $categories,
            'banner_images' => $banner_images, 'categoryName' => $categoryName,
            'my_wishlist' => $my_wishlist, 'cart_product' => $cart_product));
    }

    public function ajaxByCategoryId(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;

            $products = Category_product::select('category_id', 'product_id')->with((['products' => function ($query) {
                $query->select('id', 'product_name', 'price');
                $query->with(['image' => function ($query1) {
                    $query1->select('product_image_name', 'product_id');
                }]);
            }]))->where('category_id', '=', $id)->limit(4)->get();

            $my_wishlist = array();
            if (Auth::user()) {

                $userId = Auth::user()->id;
                $wishlist_products = User::with(['user_wishlist' => function ($query) {
                    $query->select('id', 'user_id', 'product_id');
                }])->where('id', '=', $userId)->first();

                foreach ($wishlist_products->user_wishlist as $key => $wlist) {
                    array_push($my_wishlist, $wlist->product_id);
                }
            }
            $cart_product = array();
            if (Cart::count()) {
                foreach (Cart::content() as $key => $cart_list) {
                    array_push($cart_product, intval($cart_list->id));
                }
            }
            return json_encode(array($products, $my_wishlist, $cart_product));
        }
    }
}