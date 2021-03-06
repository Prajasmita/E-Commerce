<?php
/**
 * Class HomeController for Homepage operations.
 *
 * Author : Prajakta Sisale.
 */

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Category_product;
use App\Cms;
use App\Contact_us;
use App\Helper\Custom;
use App\Product;
Use App\Countries;
Use App\States;
use App\Subscribers;
use App\User;
use App\User_address;
use App\User_wishlist;
use Illuminate\Http\Request;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Auth;
Use Cart;
Use Validator;
use Illuminate\Support\Facades\Mail;
Use App\Mail\SendMessage;
Use Hash;
Use App\Email_template;
Use App\Configuration;
Use Cache;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Show the Ecommerce shopping site.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $banner_images = Banner::select('banner_name', 'banner_image')
            ->where('status', '=', '1')->get();

        $categories = Category::with('sub_category')->where('status', '=', '1')->where('parent_id', '=', 0)->get();

        $featured_products = Product::with('image')->where('is_feature', '=', '1')->limit(6)->get()->toArray();

        foreach ($featured_products as $key => $value) {

            $featured_products[$key]['image']['product_image_name'] = empty($value['image']['product_image_name']) ? Custom::imageExistence('') : Custom::imageExistence($value['image']['product_image_name']);

        }

        $my_wishlist = array();
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $wishlist_products = User::with(['user_wishlist' => function ($query) {
                $query->select('id', 'user_id', 'product_id');
            }])->where('id', '=', $userId)->first();

            $my_wishlist = array();

            foreach ($wishlist_products->user_wishlist as $key => $wlist) {
                array_push($my_wishlist, $wlist->product_id);
            }
        }

        $products = Category_product::select('category_id', 'product_id')->with((['products' => function ($query) {
            $query->select('id', 'product_name', 'price','quantity');
            $query->with(['image' => function ($query1) {
                $query1->select('product_id','product_image_name');
            }]);
        }]))->where('category_id', '=', '1')->limit(4)->get()->toArray();

        foreach ($products as $key => $value) {

            $products[$key]['products']['image'] = empty($value['products']['image']) ? Custom::imageExistence('') : Custom::imageExistence($value['products']['image']['product_image_name']);

        }

        $cart_product = array();
        if (Cart::count()) {
            foreach (Cart::content() as $item => $cart_list) {
                array_push($cart_product, $cart_list->id);
            }
        }

        return view('home', array('conf' => $this->conf, 'banner_images' => $banner_images, 'categories' => $categories, 'featured_products' => $featured_products, 'products' => $products, 'my_wishlist' => $my_wishlist, 'cart_product' => $cart_product));

    }

    /**
     * Display the user login page
     *
     * @return \Illuminate\View\View
     */
    public function userLogin()
    {
        return view('user_login', array('conf' => $this->conf));
    }

    /**
     * Show the contact us form.
     *
     * @return \Illuminate\View\View
     */
    public function contactUs()
    {

        return view('contact_us', array('conf' => $this->conf));

    }

    /**
     * Function for saving contact details.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveContactDetails(Request $request)
    {

        if ($this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required|min:10|max:11',
            'message' => 'required',
            'subject' => 'required',

        ])) {

            $request_data = array();
            $request_data['name'] = $request->name;
            $request_data['email'] = $request->email;
            $request_data['contact_no'] = $request->contact_no;
            $request_data['message'] = $request->message;
            $request_data['subject'] = $request->subject;

            Contact_us::create($request_data);

            $this->sendMail($request);

            return redirect('contact_us')->with('query_message', 'Your message has been recorded in our database.Thank You !!!');
        }
    }

    /**
     * Function for sending mail to admin
     * about query through contact us form.
     *
     * @param  int $data
     *
     */
    public function sendMail($data)
    {

        $template_content = Email_template::where('title', '=', 'contact_us_submission_for_admin')->select('content')->first();

        $string = array('{{name}}', '{{email}}', '{{contact_no}}', '{{subject}}', '{{message}}');

        $replace = array($data->name, $data->email, $data->contact_no, $data->subject, $data->message);

        $new_template_content = str_replace($string, $replace, $template_content->content);

        $admin_email = Configuration::where('conf_key', '=', 'Admin_email')->select('conf_value')->first();

        $admin_mail = $admin_email->conf_value;

        Mail::send([], [], function ($message) use ($new_template_content, $admin_mail) {
            $message->to($admin_mail)
                ->subject('Customer Message')
                ->setBody($new_template_content, 'text/html');

        });
    }

    /**
     * Function for showing address book.
     *
     *
     * @return \Illuminate\View\View
     */
    public function addressBook()
    {

        $user_id = Auth::user()->id;

        $userAddress = User_address::with('countries', 'states')->where('user_id', '=', $user_id)->orderBy('primary', 'desc')->get();

        return view('address_book', array('conf' => $this->conf, 'userAddress' => $userAddress));

    }

    /**
     * Function for adding New address.
     *
     * @return \Illuminate\View\View
     */
    public function addAddress()
    {

        $userAddress = User_address::orderBy('primary', 'desc')->get();
        $countries = Countries::get();
        $states = States::get();
        return view('add_address', array('userAddress' => $userAddress, 'countries' => $countries, 'states' => $states));

    }

    /**
     * Function for validating rules for address book.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address1' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'country' => 'required',
            'contact_no' => 'required|min:10|max:11',
        ];


    }

    /**
     * Function to store new address.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return json response
     */
    public function addressStore(Request $request)
    {

        if ($request->ajax()) {

            $validator = Validator::make($request->all(), $this->rules());

            if ($validator->fails()) {

                return response()->json(['errors' => $validator->errors()]);
            } else {

                User_address::create($request->all());
                return response()->json(array('message' => 'New address store Successfully !!', 'redirecturl' => 'address_book'));
            }
        }
    }

    /**
     * Function for editing address.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function addressEdit($id)
    {

        $user_address = User_address::findorfail($id);

        $countries = Countries::get();

        $states = States::get();
        return view('update_address', array('user_address' => $user_address, 'countries' => $countries, 'states' => $states));


    }

    /**
     * Function for updating address.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return json response
     */
    public function addressUpdate(Request $request)
    {

        if ($request->ajax()) {

            $validator = Validator::make($request->all(), $this->rules());

            if ($validator->fails()) {

                return response()->json(['errors' => $validator->errors()]);
            } else {

                $user_address = $request->all();

                $userAddress = User_address::findOrFail($user_address['id']);
                $userAddress->update($user_address);

                return response()->json(array('message' => 'Address Updated Successfully !!', 'redirecturl' => 'address_book'));
            }

        }
    }

    /**
     * Function for making address primary from address book.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return json response
     */
    public function makePrimaryAddress(Request $request)
    {

        if ($request->ajax()) {


            $id = $request->id;

            $authUser = Auth::user()->id;


            User_address::where('user_id', '=', $authUser)
                ->where('primary', '=', '1')->update(array('primary' => '0'));

            User_address::where('id', '=', $id)->update(array('primary' => '1'));

            return json_encode("true");


        }
    }

    /**
     * Function to delete user_address
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addressDelete($id)
    {

        User_address::destroy($id);

        return redirect('address_book')->with('message', 'Address deleted !!!');


    }

    /**
     * Function for changing user password.
     *
     * @return \Illuminate\View\View
     */
    public function changePassword()
    {

        return view('change_password', array('conf' => $this->conf));
    }

    /**
     * Function for storing changed user password
     *
     * and sending mail to the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeChangedPassword(Request $request)
    {

        if ($this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|alpha_num|min:8|max:12',
            'confirm_new_password' => 'required|same:new_password'
        ])) {
            $user = Auth::user();
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $hash_new_password = Hash::make($new_password);

            if (Hash::check($old_password, $user->password)) {

                Mail::send([], [], function ($message) use ($new_password) {
                    $message->to(Auth::user()->email)
                        ->subject('Password Changed')
                        ->setBody('Hello user Your Password Changed Successully. Your New Password is ' . $new_password);
                });

                User::where('id', '=', $user->id)->update(array('password' => $hash_new_password));

                return redirect('change_password')->with('success_message', 'Password Changed Successfully.');

            } else {

                return redirect('change_password')->with('message', 'Old Password is Wrong.Please Enter Correct Password.');
            }
        }
    }

    /**
     * Function for forget password view
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword()
    {

        return view('forget_password', array('conf' => $this->conf));

    }

    /**
     * Function for sending mail to the user about new password.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function retrievePassword(Request $request)
    {

        $email = $request->email;
        $random_password = str_random(8);
        $hashed_random_password = Hash::make($random_password);

        User::where('email', '=', $email)->update(array('password' => $hashed_random_password));

        if (User::where('email', '=', $email)->exists()) {

            Mail::send([], [], function ($message) use ($email, $random_password) {
                $message->to($email)
                    ->subject('New Password')
                    ->setBody('Hi, welcome user, Your password is ' . $random_password . '!!!');
            });
            return redirect('forget_password')->with('retrieve_password', 'Password Send to Your Mail Successfully. Please Check Your Mail For Password !!!');

        } else {

            return redirect('forget_password')->with('register_email', 'Invalid Email Address. Please First Register with us. !!!');

        }

    }

    /**
     * Display the about us page.
     *
     * @param  int $page_name
     *
     * @return \Illuminate\View\View
     */
    public function getPages($page_name)
    {
        $page_data = Cms::where('title', '=', $page_name)->first();

        return view('get_page', array('conf' => $this->conf, 'page_data' => $page_data));
    }

    /**
     * Display wish list.
     *
     * @return \Illuminate\View\View
     */
    public function userWishList()
    {
        $user_id = Auth::user()->id;

        $wishlists = User_wishlist::with(['product' => function ($query) {
            $query->with(['image' => function ($query1) {
                $query1->select('product_image_name', 'product_id');
            }]);
        }])->where("user_id", "=", $user_id)->get()->toArray();

        foreach ($wishlists as $key => $value) {

            $wishlists[$key]['product']['image']['product_image_name'] = empty($value['product']['image']) ? Custom::imageExistence('') : Custom::imageExistence($value['product']['image']['product_image_name']);

        }

        $cart_product = array();
        if (Cart::count()) {
            foreach (Cart::content() as $item => $cart_list) {
                array_push($cart_product, $cart_list->id);
            }
        }

        return view('wishlist', array('conf' => $this->conf, 'wishlists' => $wishlists, 'cart_product' => $cart_product));
    }

    /*
     * Function for myaccount view
     *
     * @return \Illuminate\View\View
     */
    public function myAccount()
    {
        $user_id = Auth::user()->id;

        $user = User::where('id', '=', $user_id)->first();

        return view('my_account', array('conf' => $this->conf, 'user' => $user));

    }

    /*
     * Function for update account
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAccount(Request $request)
    {

        //Custom::showAll($request->image);die;
        $data = array();

        if ($request->image) {
            $current_time = time();

            $image = $request->file('image');
            $img_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $data['avatar'] = $img_name . '_' . $current_time . '.' . $image->getClientOriginalExtension();

            $destinationPath = 'img/user';

            $image->move($destinationPath, $data['avatar']);
        }
        $data['first_name'] = $request->first_name;
        $request->middle_name ? $data['middle_name'] = $request->middle_name : '';
        $data['last_name'] = $request->last_name;
        $data['contact_no'] = $request->contact_no;

        User::where('id', $request->user_id)->update($data);

        return redirect('my_account')->with('update_myaccount', 'Your information updated successfully !!!');
    }

}
