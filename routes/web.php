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
Route::get('/home', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/car-brands/bmw', function () {
    return view('vehicleBrands');
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
        // can only access this if type == A
        return view('Admin/category');
    });

    Route::get("admin/brand", function () {

        $brands = DB::table('brands')->get();
        return View::make('Admin/brand')->with('brands', $brands);

    });

    Route::get('/admin/model', function () {
        $models = DB::table('models')->paginate(5);
        $brands = DB::table('brands')->get();

        return View::make('Admin/model')->with('models', $models)->with('brands', $brands);

    });

    Route::get('/admin/brand/delete/{id}', 'brandsController@destroy');
    Route::post('/admin/brand/edit', 'brandsController@edit');
    Route::post('/admin/model/edit', 'modelsController@edit');
    Route::get('/admin/model/delete/{id}', 'modelsController@destroy');
    Route::post('/admin/registerRetailer/register', 'retailerController@store');
    Route::post("admin/model", 'modelsController@store');
    Route::get("/admin/model/search", 'modelsController@show');
    Route::post("admin/brand", 'brandsController@store');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/feedback', function () {
        return view('feedback');
    });


});

Auth::routes();

Route::group(['middleware' => 'App\Http\Middleware\Retailer'], function () {

    /*Retailer Routes*/
    Route::get('/retailer/home', function () {
        return view('Retailer/home');
    });
    Route::post("/retailer/spares", 'sparesController@store');

    Route::get('/retailer/spares/getModels', 'sparesController@getModels');

    Route::get('/retailer/spares', function () {
        $models = DB::table('models')->get();
        $brands = DB::table('brands')->get();

        return View::make('Retailer/spares')->with('models', $models)->with('brands', $brands);

    });

    Route::get('/retailer/spares/getYears', 'sparesController@getYears');



});