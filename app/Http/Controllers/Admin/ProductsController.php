<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Helper\Custom;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Image_product;
use App\Product;
use App\Category_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
/**
 * Class ProductsController for CRUD operation of Products.
 *
 * Author : Prajakta Sisale.
 */
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $products = array();
        $result = array();
        if($request->ajax()) {

            $totalRecords=Product::count();
            $limit=$request->input('length');
            if($limit == -1){
                $limit = $totalRecords;
            }
            $offset=$request->input('start');
            $search=$request->input('search');
            $search_word=trim($search['value']);
            $draw = $request->input('draw');

            $column = $request->input('columns');

            $order = $request->input('order');

            $sortBy = $order[0]['column'];

            $sortOf = $order[0]['dir'];

            $name = $column[$sortBy]['data'];

            $products = Product::with('image');
            if ($search_word != '' ) {

                    $products->where('product_name', 'LIKE', "%$search_word%")
                    ->orWhere('price', 'LIKE', "%$search_word%");
            }
            $products = $products->skip($offset)
                    ->take($limit)
                    ->orderBy($name , $sortOf)
                    ->get();



            if ($search_word != '' ) {
               $recordsFiltered = $products->count();
                $recordsTotal = $products->count();

            }else{
                $recordsFiltered = Product::count();
                $recordsTotal = Product::count();
            }
            $final = array();
            foreach($products as $key => $val){

                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['product_name'] = $val['product_name'];
                $res_data['image_name'] = empty($val['image']['product_image_name']) ? Custom::imageExistence(''):Custom::imageExistence($val['image']['product_image_name']);
                $res_data['price'] = $val['price'];
                $final[] = $res_data;
            }
            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] =   $final;

            return $result;
        }

        $authUser = Auth::user();

        return view('admin.products.index', compact('products','authUser'),array('js'=>'product_listing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::with('products')
           ->get();

        $authUser = Auth::user();

        return view('admin.products.create',array('authUser'=> $authUser,'categories'=>$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        //Custom::showAll($request->has('is_feature')?1:0);die;
        $this->validate($request, [
            'product_name' => 'required',
            'sku' => 'required|alpha_num|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'image_name' => 'required',
            'image_name.*' => 'mimes:jpg,jpeg,png|image|max:2048',
            'short_discription' => 'required',
            'special_price' => 'required',
            'long_discription' =>'required',
            'category' =>'required',
            'status' => 'required'

        ]);

        $requestData['product_name']=$request->product_name;
        $requestData['sku']=$request->sku;
        $requestData['short_discription']=$request->short_discription;
        $requestData['long_discription']=$request->long_discription;
        $requestData['price']=$request->price;
        $requestData['special_price']=$request->special_price;
        $requestData['special_price_from_date']=$request->special_price_from_date;
        $requestData['special_price_to_date']=$request->special_price_to_date;
        $requestData['quantity']=$request->quantity;
        $requestData['status']=$request->status;
        $requestData['is_feature']=$request->has('is_feature') ? '1' : '0';
        $requestData['meta_title']=$request->meta_title;
        $requestData['meta_discription']=$request->meta_discription;
        $requestData['meta_keyword']=$request->meta_keyword;

        $product_data= Product::create($requestData);

            If (Input::hasFile('image_name')) {

                $images = Input::file('image_name');

                $destinationPath = 'img/product';

                foreach($images as $image){

                    $filename = $image->getClientOriginalName();
                    $image->move($destinationPath, $filename);
                    $requestData1['product_image_name'] = $filename;
                    $requestData1['product_id'] = $product_data['id'];
                    Image_product::create($requestData1);
                }

        }

        foreach($request->category as $selected_id) {

            $requestData2['category_id'] = $selected_id;

            $requestData2['product_id']=$product_data['id'];

            Category_product::create($requestData2);
        }

        return redirect('admin/products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
       $product_data = Product::with(['image','category_product' => function($query){
           $query->with('category');
       }])->findOrFail($id);

        $product_data['image_products'] = empty($product_data['image']['product_image_name']) ? Custom::imageExistence(''):Custom::imageExistence($product_data['image']['product_image_name']);

        $authUser = Auth::user();

        return view('admin.products.show', compact('product_data','authUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $authUser = Auth::user();

        $categories = Category::with('products')->get();

        $product_image = Image_product::get()->first;

        $product = Product::findOrFail($id);

        $product['price'] = number_format($product->price,2,'.', ',');

        return view('admin.products.edit', compact('product','authUser','categories','product_image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'product_name' => 'required',
            'sku' => 'required|alpha_num',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'special_price' => 'required',
            'image_name.*' => 'mimes:jpg,jpeg,png|image|max:2048',

        ]);

        $requestData['product_name']=$request->product_name;
        $requestData['sku']=$request->sku;
        $requestData['short_discription']=$request->short_discription;
        $requestData['long_discription']=$request->long_discription;
        $requestData['price']=$request->price;
        $requestData['special_price']=$request->special_price;
        $requestData['special_price_from_date']=$request->special_price_from_date;
        $requestData['special_price_to_date']=$request->special_price_to_date;
        $requestData['quantity']=$request->quantity;
        $requestData['status']=$request->status;
        $requestData['is_feature']=$request->has('is_feature') ? '1' : '0';

        $requestData['meta_title']=$request->meta_title;
        $requestData['meta_discription']=$request->meta_discription;
        $requestData['meta_keyword']=$request->meta_keyword;

        $product_data = Product::findOrFail($id);
        $product_data->update($requestData);

        If (Input::hasFile('image_name')) {

            $images = Input::file('image_name');

            $destinationPath = 'img/product';

            foreach($images as $image){

                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                $requestData1['product_image_name'] = $filename;
                $requestData1['product_id'] = $product_data['id'];

                $product_data1 = Image_product::where('product_id','=',$id);

                $product_data1->update($requestData1);
            }

        }

        /*foreach($request->category as $selected_id) {

            $requestData2['category_id'] = $selected_id;

            $requestData2['product_id']=$product_data['id'];

            $product_data2 = Category_product::where('product_id','=',$id);
            //Custom::showAll($product_data2->category_id);die;
            $product_data2->update($requestData2);

        }*/

        return redirect('admin/products')->with('flash_message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {

        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}
