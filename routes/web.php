<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


//Customer Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/cart/deleteCartItem/{id}', 'searchController@destroy' );

Route::get('/home', function () {
    return view('home');
});
Route::get('/productInfo/{id}',['uses'=>'searchController@loadProduct',
    'as'=>'product.index'] );

/*Route::group(['middleware' => 'web'], function () {
    Route::get('/productInfo/{id}/addToCart',['uses'=>'searchController@getAddToCart',
        'as'=>'product.addToCart'] );

});*/

Route::get('/checkout/{price}','searchController@getCheckout');

Route::get('/productInfo/{id}/addToCart','searchController@addToCart');


Route::get('/productInfo/{value}/checkQuantity', 'searchController@checkQuantity');


Route::post('/enquiry', 'enquiriesController@store');


Route::get('/enquiry', function () {
    return view('Enquiry');
});

Route::get('/browse', 'searchController@index');




Route::get('/car-brands/bmw', function () {
    return view('vehicleBrands');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/feedback', 'ordersController@index');
    Route::get('/feedback/{id}', 'ordersController@show');
    Route::get('/feedback/getDate', 'ordersController@getDate');

    Route::get('/cart','searchController@viewCart' );
    Route::get('/cart/changeStatus','searchController@changeCartStatus' );




});






//Admin Routes
Route::group(['middleware' =>  'App\Http\Middleware\Admin'], function () {
    Route::get('/admin/registerRetailer', function () {
        // can only access this if type == A
        return view('Admin/registerRetailers');
    });

    Route::get('/admin/home', function () {
        // can only access this if type == A
        return view('Admin/admin');
    });

    Route::get('/admin/category', function () {

        $categories = DB::table('categories')->paginate(5);

         // can only access this if type == A
        return View::make('Admin/category')->with('categories', $categories);

     });

    Route::get("admin/brand", function () {

        $brands = DB::table('brands')->paginate(5);
        return View::make('Admin/brand')->with('brands', $brands);

    });

    Route::get('/admin/model', function () {
        $models = DB::table('models')->paginate(5);
        $brands = DB::table('brands')->get();

        return View::make('Admin/model')->with('models', $models)->with('brands', $brands);

    });

    Route::get('/admin/brand/delete/{id}', 'brandsController@destroy');
    Route::post('/admin/brand/edit', 'brandsController@edit');
    Route::post("admin/brand", 'brandsController@store');
    Route::get("/admin/brand/search", 'brandsController@show');



    Route::post("/admin/category", 'categoriesController@store');
    Route::post("/admin/category/edit", 'categoriesController@edit');
    Route::get("/admin/category/search", 'categoriesController@show');
    Route::get('/admin/category/delete/{id}', 'categoriesController@destroy');



    Route::post('/admin/model/edit', 'modelsController@edit');
    Route::get('/admin/model/delete/{id}', 'modelsController@destroy');
    Route::post("admin/model", 'modelsController@store');
    Route::get("/admin/model/search", 'modelsController@show');
    Route::post('/admin/registerRetailer/register', 'retailerController@store');


});



Auth::routes();

Route::group(['middleware' => 'App\Http\Middleware\Retailer'], function () {

    /*Retailer Routes*/
    Route::get('/retailer/home', function () {
        return view('Retailer/home');
    });

    Route::post("/retailer/spares", 'sparesController@store');
    Route::post("/retailer/spares/edit", 'sparesController@edit');

    Route::get('/retailer/spares/delete/{id}', 'sparesController@destroy');

    Route::get('/retailer/spares/getModels', 'sparesController@getModels');

    Route::get('/retailer/spares', 'sparesController@load') ;
    Route::get('/retailer/spares/getYears', 'sparesController@getYears');



});