<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('admin.auth.login');
});

Auth::routes();

Route::group(['namespace' => 'Admin','middleware'=>['auth'],'prefix'=>'admin'],function(){

    Route::get('/', 'DashboardController@index')->name('admin');

    Route::get('users/create',['as'=> 'users.create','uses'=>'UsersController@create']);
    Route::get('users',['as'=>'users.index','uses'=>'UsersController@index']);
    Route::get('users/{user}',['as'=> 'users.show','uses'=>'UsersController@show']);
    Route::get('users/{user}/edit',['as'=> 'users.edit','uses'=>'UsersController@edit']);
    Route::patch('users/{user}',['as'=> 'users.update','uses'=>'UsersController@update']);
    Route::post('users',['as'=>'users.store','uses'=>'UsersController@store']);
    Route::get('users/{user}/destroy',['as'=> 'users.destroy','uses'=>'UsersController@destroy']);

    Route::get('configuration/create',['as'=> 'configuration.create','uses'=>'ConfigurationController@create']);
    Route::get('configuration',['as'=>'configuration.index','uses'=>'ConfigurationController@index']);
    Route::get('configuration/{configuration}',['as'=> 'configuration.show','uses'=>'ConfigurationController@show']);
    Route::get('configuration/{configuration}/edit',['as'=> 'configuration.edit','uses'=>'ConfigurationController@edit']);
    Route::patch('configuration/{configuration}',['as'=> 'configuration.update','uses'=>'ConfigurationController@update']);
    Route::post('configuration',['as'=>'configuration.store','uses'=>'ConfigurationController@store']);
    Route::get('configuration/{configuration}/destroy',['as'=> 'configuration.destroy','uses'=>'ConfigurationController@destroy']);

    Route::get('banners/create',['as'=> 'banners.create','uses'=>'BannersController@create']);
    Route::get('banners',['as'=>'banners.index','uses'=>'BannersController@index']);
    Route::get('banners/{banner}',['as'=> 'banners.show','uses'=>'BannersController@show']);
    Route::get('banners/{banner}/edit',['as'=> 'banners.edit','uses'=>'BannersController@edit']);
    Route::patch('banners/{banner}',['as'=> 'banners.update','uses'=>'BannersController@update']);
    Route::post('banners',['as'=>'banners.store','uses'=>'BannersController@store']);
    Route::get('banners/{banner}/destroy',['as'=> 'banners.destroy','uses'=>'BannersController@destroy']);

    Route::get('categories/create',['as'=> 'categories.create','uses'=>'CategoriesController@create']);
    Route::get('categories',['as'=>'categories.index','uses'=>'CategoriesController@index']);
    Route::get('categories/{category}',['as'=> 'categories.show','uses'=>'CategoriesController@show']);
    Route::get('categories/{category}/edit',['as'=> 'categories.edit','uses'=>'CategoriesController@edit']);
    Route::patch('categories/{category}',['as'=> 'categories.update','uses'=>'CategoriesController@update']);
    Route::post('categories',['as'=>'categories.store','uses'=>'CategoriesController@store']);
    Route::get('categories/{category}/destroy',['as'=> 'categories.destroy','uses'=>'CategoriesController@destroy']);

    Route::get('products/create',['as'=> 'products.create','uses'=>'ProductsController@create']);
    Route::get('products',['as'=>'products.index','uses'=>'ProductsController@index']);
    Route::get('products/{product}',['as'=> 'products.show','uses'=>'ProductsController@show']);
    Route::get('products/{product}/edit',['as'=> 'products.edit','uses'=>'ProductsController@edit']);
    Route::patch('products/{product}',['as'=> 'products.update','uses'=>'ProductsController@update']);
    Route::post('products',['as'=>'products.store','uses'=>'ProductsController@store']);
    Route::get('products/{product}/destroy',['as'=> 'products.destroy','uses'=>'ProductsController@destroy']);

    Route::get('coupons/create',['as'=> 'coupons.create','uses'=>'CouponsController@create']);
    Route::get('coupons',['as'=>'coupons.index','uses'=>'CouponsController@index']);
    Route::get('coupons/{coupon}',['as'=> 'coupons.show','uses'=>'CouponsController@show']);
    Route::get('coupons/{coupon}/edit',['as'=> 'coupons.edit','uses'=>'CouponsController@edit']);
    Route::patch('coupons/{coupon}',['as'=> 'coupons.update','uses'=>'CouponsController@update']);
    Route::post('coupons',['as'=>'coupons.store','uses'=>'CouponsController@store']);
    Route::get('coupons/{coupon}/destroy',['as'=> 'coupons.destroy','uses'=>'CouponsController@destroy']);

    Route::get('contactus',['as'=> 'contact.admin','uses'=>'ContactUsContoller@index']);
    Route::get('admin_note/{id}',['as'=> 'admin.note','uses'=>'ContactUsContoller@adminNote']);
    Route::post('/admin_note_save',['as'=> 'admin_note.save','uses'=>'ContactUsContoller@saveAdminNote']);

    Route::get('email_template',['as'=>'email.template','uses'=> 'emailTemplateController@emailTemplate']);
    Route::get('email_template/create',['as'=> 'email_template.create','uses'=>'emailTemplateController@create']);
    Route::post('email_template',['as'=>'email_template.store','uses'=>'emailTemplateController@store']);
    Route::get('email_template/{email_template_id}',['as'=> 'email_template.show','uses'=>'emailTemplateController@show']);
    Route::get('email_template/{email_template_id}/edit',['as'=> 'email_template.edit','uses'=>'emailTemplateController@edit']);
    Route::patch('email_template/{email_template_id}',['as'=> 'email_template.update','uses'=>'emailTemplateController@update']);

    Route::get('user_orders',['as'=> 'user.orders','uses'=>'UserOrderController@index']);
    Route::get('user_orders/{id}',['as'=> 'order.details','uses'=>'UserOrderController@orderDetails']);

    Route::get('cms/create',['as'=> 'cms.create','uses'=>'CmsController@create']);
    Route::get('cms',['as'=>'cms.index','uses'=>'CmsController@index']);
    Route::get('cms/{cms}',['as'=> 'cms.show','uses'=>'CmsController@show']);
    Route::get('cms/{cms}/edit',['as'=> 'cms.edit','uses'=>'CmsController@edit']);
    Route::patch('cms/{cms}',['as'=> 'cms.update','uses'=>'CmsController@update']);
    Route::post('cms',['as'=>'banners.store','uses'=>'CmsController@store']);
    Route::get('cms/{cms}/destroy',['as'=> 'cms.destroy','uses'=>'CmsController@destroy']);



});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/user_logout','Auth\UserLoginController@logout')->name('user_logout');

Route::get('/category_products/{id}',['as'=>'category_product','uses'=>'CategoryController@categoryProducts']);


Route::post('/category_data/{id}',['as'=>'category_data','uses'=>'CategoryController@ajaxByCategoryId']);




Route::post('/user_login','Auth\UserLoginController@login')->name('user_login');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart_data/{id}', ['as' => 'cart_data', 'uses' => 'CartController@store']);
Route::post('/cart/{id}/update',['as'=> 'cart.update','uses'=>'CartController@update']);
Route::delete('/cart/{id}/delete',['as'=> 'cart.delete','uses'=>'CartController@delete']);




Route::group(['middleware'=>['auth']],function() {
    Route::get('/checkout','CartController@checkout')->name('checkout');
    Route::post('/apply_coupon',['as'=> 'coupon.apply','uses'=>'CartController@applyCoupon']);
    Route::post('/order_review',['as'=> 'order.review','uses'=>'CartController@orderReview']);
    Route::get('/contact_us',['as'=>'contact_us','uses'=>'HomeController@contactUs']);

    Route::post('/contact_us','HomeController@saveContactDetails')->name('contact');
    Route::get('/address_book',['as'=> 'address.book','uses'=>'HomeController@addressBook']);
    Route::get('/address_add',['as'=> 'address.add','uses'=>'HomeController@addAddress']);

    Route::get('/address_edit/{id}',['as'=> 'address.edit','uses'=>'HomeController@addressEdit']);
    Route::post('/address_Update',['as'=> 'address.update','uses'=>'HomeController@addressUpdate']);

    Route::post('/address_store',['as'=> 'address.store','uses'=>'HomeController@addressStore']);
    Route::get('/address_delete/{id}',['as'=> 'address.delete','uses'=>'HomeController@addressDelete']);
    Route::post('/address_primary',['as'=> 'address.primary','uses'=>'HomeController@makePrimaryAddress']);


    Route::get('/change_password',['as'=> 'change.password','uses'=>'HomeController@changePassword']);
    Route::post('/change_password',['as'=> 'store.change_password','uses'=>'HomeController@storeChangedPassword']);
    Route::post('/order_store',['as'=> 'order.store','uses'=>'CartController@orderStore']);

    Route::post('/paypal',['as'=> 'paywithpaypal','uses'=>'CartController@payWithPaypal']);

    Route::get('/paypal/{id}', ['as' => 'paypalsuccess','uses' => 'CartController@paypalPaymentSuccess']);
    Route::get('/my_orders', ['as' => 'my.orders','uses' => 'CartController@myOrders']);
    Route::get('/my_order/{id}', ['as' => 'my.order','uses' => 'CartController@myOrder']);

    Route::get('/wishlist',['as' => 'my.wishlist','uses' => 'HomeController@userWishList']);
    Route::delete('/wishlist/{id}/delete',['as'=> 'wishlist.delete','uses'=>'ProductController@deleteWishlist']);

    Route::get('/product_details/{product}',['as'=> 'products.details','uses'=>'ProductController@product_details']);
    Route::post('/wishlist/{id}',['as'=> 'products.wishlist','uses'=>'ProductController@ajaxAddProductToWishlist']);


});

Route::get('/track_order', ['as' => 'track.order','uses' => 'CartController@trackOrder']);
Route::post('/track_order', ['as' => 'track.my_order','uses' => 'CartController@trackMyOrder']);

Route::get('forget_password',['as' => 'forget.password','uses' => 'HomeController@forgetPassword']);
Route::post('forget_password',['as' => 'retrieve.password','uses' => 'HomeController@retrievePassword']);


Route::post('/state/{id}',['as'=> 'country.state','uses'=>'CartController@selectStates']);

//Route::get('about_us',['as'=> 'about.us','uses'=>'HomeController@aboutUs']);

Route::get('/cms/{page_name}',['as'=> 'cms.page','uses'=>'HomeController@getPages']);

/*Route::get('about_us',['as'=> 'about.us','uses'=>'HomeController@aboutUs']);*/


Route::get('/temporary',['as'=> 'temp','uses'=>'CartController@orderReview']);


//Route::post('/contact',['as' => 'contactUs', 'uses'=>'HomeController@saveContactDetails']);
/*Route::get('/paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));*/



























