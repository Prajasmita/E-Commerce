<?php


namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Helper\Custom;
use App\Category_product;
use App\Product;
use Illuminate\Http\Response;

class ProductDetailsController extends Controller
{
    public function product_details($id )
    {

        $categories = Category::with('sub_category')->where('parent_id','=',0)->get();

        $products = Product::with('image_products','image')->select('id','product_name','price','quantity','short_discription')->where('id','=',$id)->get()->first();
     //Custom::showAll($products->toArray());die;
        //echo $id;die;

     return view('product_details',array('categories'=>$categories,'products'=>$products));
    }
}
