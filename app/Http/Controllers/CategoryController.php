<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Helper\Custom;
use App\Category_product;
use App\Product;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function ajaxByCategoryId(Request $request ){

        if($request->ajax()){

            $id = $request->id;
            $products = Category_product::select('category_id','product_id')->with((['products' => function($query){
                $query->select('id','product_name','price');
                $query->with(['image'=>function($query1){
                    $query1->select('product_image_name','product_id');
                }]);
            }]))->where('category_id','=',$id)->limit(4)->get();

//            Custom::runQuery();die;
//            Custom::showAll($products->toArray());
            return json_encode($products);
        }
    }
}