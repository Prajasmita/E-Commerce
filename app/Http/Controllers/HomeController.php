<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Category_product;
use App\Contact_us;
use App\Helper\Custom;
use App\Product;
Use App\Countries;
Use App\States;
use App\User;
use App\User_address;
use App\User_wishlist;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
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
     *
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

       // Custom::showAll($userAddress->toArray());die;

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

    /**
     * Display the user login page.
     *
     *
     */
    public function userLogin()
    {
        return view('user_login');
    }
    /**
     * Show the contact us form.
     *
     */
    public function contactUs(){

        return view('contact_us');

    }

    public function saveContactDetails(Request $request){

        if($this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|email',
            'contact_no'=> 'required|min:10|max:11',
            'message' => 'required'
        ])) {

            $request_data = array();

            $request_data['name'] = $request->name;
            $request_data['email'] = $request->email;
            $request_data['contact_no'] = $request->contact_no;
            $request_data['message'] = $request->message;
            $request_data['subject'] = $request->subject;

           // Custom::showAll($request_data);die;

            Contact_us::create($request_data);
            return redirect('contact_us')->with('message', 'Your message has been recorded in our database.Thank You !!!');
        }
    }


    public function addressBook(){

        $userAddress = User_address::orderBy('primary', 'desc')->get();

        $countries = Countries::get();
        foreach($userAddress as $user_address){
            $country_id =Countries::select('id')->where('name','=',$user_address->country)->first();

        }

        $states = States::where('country_id','=',$country_id->id)->get();

        return view('address_book',array('userAddress'=> $userAddress,'countries'=>$countries,'states'=>$states));

    }

    public function addAddress(){
        //echo "hello";
        $userAddress = User_address::orderBy('primary', 'desc')->get();
        $countries = Countries::get();

        foreach($userAddress as $user_address){
            $country_id =Countries::select('id')->where('name','=',$user_address->country)->first();

        }

        $states = States::where('country_id','=',$country_id->id)->get();

        return view('add_address',array('userAddress'=> $userAddress,'countries'=>$countries,'states'=>$states));

    }

    public function addressStore(Request $request){

        if($request->ajax()){
            Custom::showAll($request);


        }
    }

    public function addressEdit(Request $request){


        echo "hello";die;
        //return view ('update_address');


    }

    public function makePrimaryAddress(Request $request){

        if($request->ajax()){


            $checkboxValue = $request->checkboxValue;
            $id = $request->id;


            $user_address = User_address::findorfail($id);
            Custom::showAll($user_address->toArray());

      }


    }

}
