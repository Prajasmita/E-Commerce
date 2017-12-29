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

Route::get('/', function () {
    return view('admin.auth.login');
});

/*
Route::get('/admin', function () {
    return view('admin.blank');
})->middleware('auth');*/

Route::get('/admin', 'Admin\DashboardController@index')->name('admin');

/*Route::get('/', function()
{
    return View::make('dashboard', array('first_name' => $user->first_name));
});*/

Auth::routes();

//Route::resource('admin/users', 'Admin\UsersController');

Route::group(['namespace' => 'Admin','middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('users/create',['as'=> 'users.create','uses'=>'UsersController@create']);
    Route::get('users',['as'=>'users.index','uses'=>'UsersController@index']);
    Route::get('users/{user}',['as'=> 'users.show','uses'=>'UsersController@show']);
    Route::get('users/{user}/edit',['as'=> 'users.edit','uses'=>'UsersController@edit']);
    Route::patch('users/{user}',['as'=> 'users.update','uses'=>'UsersController@update']);
    Route::post('users',['as'=>'users.store','uses'=>'UsersController@store']);
    Route::get('users/{user}/destroy',['as'=> 'users.destroy','uses'=>'UsersController@destroy']);
});


/*Route::get('admin/users/{user}',['as'=> 'users.show','uses'=>'Admin\UsersController@show']);

// Route::get('users/{user}',['as'=> 'users.update','uses'=>'UsersController@update']);
Route::get('admin/users/{user}',['as'=> 'users.update','uses'=>'Admin\UsersController@update']);*/

//Route::get('admin/users/create','UsersController@create');
Auth::routes();


Route::group(['namespace' => 'Admin','middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('configuration/create',['as'=> 'configuration.create','uses'=>'ConfigurationController@create']);
    Route::get('configuration',['as'=>'configuration.index','uses'=>'ConfigurationController@index']);
    Route::get('configuration/{configuration}',['as'=> 'configuration.show','uses'=>'ConfigurationController@show']);
    Route::get('configuration/{configuration}/edit',['as'=> 'configuration.edit','uses'=>'ConfigurationController@edit']);
    Route::patch('configuration/{configuration}',['as'=> 'configuration.update','uses'=>'ConfigurationController@update']);
    Route::post('configuration',['as'=>'configuration.store','uses'=>'ConfigurationController@store']);
    Route::get('configuration/{configuration}/destroy',['as'=> 'configuration.destroy','uses'=>'ConfigurationController@destroy']);
});

//Route::resource('admin/configuration', 'Admin\\ConfigurationController');
/*Route::resource('admin/banners', 'Admin\\BannersController');*/

Route::group(['namespace' => 'Admin','middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('banners/create',['as'=> 'banners.create','uses'=>'BannersController@create']);
    Route::get('banners',['as'=>'banners.index','uses'=>'BannersController@index']);
    Route::get('banners/{banner}',['as'=> 'banners.show','uses'=>'BannersController@show']);
    Route::get('banners/{banner}/edit',['as'=> 'banners.edit','uses'=>'BannersController@edit']);
    Route::patch('banners/{banner}',['as'=> 'banners.update','uses'=>'BannersController@update']);
    Route::post('banners',['as'=>'banners.store','uses'=>'BannersController@store']);
    Route::get('banners/{banner}/destroy',['as'=> 'banners.destroy','uses'=>'BannersController@destroy']);
});

Route::group(['namespace' => 'Admin','middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('categories/create',['as'=> 'categories.create','uses'=>'CategoriesController@create']);
    Route::get('categories',['as'=>'categories.index','uses'=>'CategoriesController@index']);
    Route::get('categories/{category}',['as'=> 'categories.show','uses'=>'CategoriesController@show']);
    Route::get('categories/{category}/edit',['as'=> 'categories.edit','uses'=>'CategoriesController@edit']);
    Route::patch('categories/{category}',['as'=> 'categories.update','uses'=>'CategoriesController@update']);
    Route::post('categories',['as'=>'categories.store','uses'=>'CategoriesController@store']);
    Route::get('categories/{category}/destroy',['as'=> 'categories.destroy','uses'=>'CategoriesController@destroy']);
});
//Route::resource('admin/categories', 'Admin\\CategoriesController');

//Route::resource('admin/products', 'Admin\\ProductsController');
Route::group(['namespace' => 'Admin','middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('products/create',['as'=> 'products.create','uses'=>'ProductsController@create']);
    Route::get('products',['as'=>'products.index','uses'=>'ProductsController@index']);
    Route::get('products/{product}',['as'=> 'products.show','uses'=>'ProductsController@show']);
    Route::get('products/{product}/edit',['as'=> 'products.edit','uses'=>'ProductsController@edit']);
    Route::patch('products/{product}',['as'=> 'products.update','uses'=>'ProductsController@update']);
    Route::post('products',['as'=>'products.store','uses'=>'ProductsController@store']);
    Route::get('products/{product}/destroy',['as'=> 'products.destroy','uses'=>'ProductsController@destroy']);
});

//Route::resource('admin/coupons', 'Admin\\CouponsController');
Route::group(['namespace' => 'Admin','middleware'=>'auth','prefix'=>'admin'],function(){
    Route::get('coupons/create',['as'=> 'coupons.create','uses'=>'CouponsController@create']);
    Route::get('coupons',['as'=>'coupons.index','uses'=>'CouponsController@index']);
    Route::get('coupons/{coupon}',['as'=> 'coupons.show','uses'=>'CouponsController@show']);
    Route::get('coupons/{coupon}/edit',['as'=> 'coupons.edit','uses'=>'CouponsController@edit']);
    Route::patch('coupons/{coupon}',['as'=> 'coupons.update','uses'=>'CouponsController@update']);
    Route::post('coupons',['as'=>'banners.store','uses'=>'CouponsController@store']);
    Route::get('coupons/{coupon}/destroy',['as'=> 'coupons.destroy','uses'=>'CouponsController@destroy']);
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user_login','HomeController@userLogin')->name('user_login');

Route::post('/category_data/{id}',['as'=>'category_data','uses'=>'CategoryController@ajaxByCategoryId']);
/*Route::get('/category_data','CategoryController@ajaxByCategoryId')->name('category_data');*/