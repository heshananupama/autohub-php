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

Route::get('/browse/filter', 'searchController@filterResults' );
Route::get('/browse/getModels', 'sparesController@getModels' );



Route::get('/cart/deleteCartItem/{id}', 'searchController@destroy' );

Route::get('/home', function () {
    return view('home');
});
Route::get('/productInfo/{id}',['uses'=>'searchController@loadProduct',
    'as'=>'product.index'] );





Route::get('/productInfo/{value}/checkQuantity', 'searchController@checkQuantity');


Route::get('/advanceSearch', 'searchController@advance');

Route::get('/browse', 'searchController@index');

Route::get('/browse/toyota', 'searchController@toyota');

Route::get('/browse/suspensions', 'searchController@suspension');






Route::get('/car-brands/bmw', function () {
    return view('vehicleBrands');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/feedback', 'ordersController@index');
    Route::get('/inbox', 'enquiriesController@showMessages');

    Route::get('/feedback/{id}', 'ordersController@show');
    Route::get('/feedback/{id}/saveReview', 'ordersController@saveReview');
    Route::get('/feedback/{id}/saveComplain', 'ordersController@saveComplain');

    Route::get('/productInfo/{id}/addToCart','searchController@addToCart');

    Route::post('/enquiry', 'enquiriesController@store');


    Route::get('/enquiry', function () {
        return view('Enquiry');
    });

    Route::get('/feedback/getDate', 'ordersController@getDate');

    Route::get('/cart','searchController@viewCart' );
    Route::get('/cart/changeStatus','searchController@changeCartStatus' );

    Route::get('/checkout/{price}','searchController@getCheckout');



});






//Admin Routes
Route::group(['middleware' =>  'App\Http\Middleware\Admin'], function () {
    Route::get('/admin/registerRetailer', function () {
        // can only access this if type == A
        return view('Admin/registerRetailers');
    });

    Route::get('/admin/home','brandsController@loadHome')    ;

    Route::get('/admin/category', function () {

        $categories = DB::table('categories')->paginate(5);

         // can only access this if type == A
        return View::make('Admin/category')->with('categories', $categories);

     });

    Route::get("admin/brand", function () {

        $brands = DB::table('brands')->paginate(5);
        return View::make('Admin/brand')->with('brands', $brands);

    });

    Route::get("/admin/retailer", function () {

        $users = DB::table('users')->where('type','=','r')->get();
        $retailers=DB::table('retailers')->get();
        return View::make('Admin/retailer')->with('retailers', $retailers)->with('users',$users);

    });

    Route::get('/admin/model', function () {
        $models = DB::table('models')->paginate(5);
        $brands = DB::table('brands')->get();

        return View::make('Admin/model')->with('models', $models)->with('brands', $brands);

    });
    Route::get('/admin/retailer/delete/{id}', 'brandsController@destroyRetailer');
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
    Route::get('/retailer/home', 'retailerController@index');


    Route::get("/retailer/orders", 'retailerController@loadOrders');

    Route::post("/retailer/generateReports", 'ReportingController@loadReports');


    Route::get("/retailer/chartSales", 'ChartController@loadSalesChart');
    Route::get("/retailer/loadStrategicSalesChart", 'ChartController@loadStrategicSalesChart');

    Route::get("/retailer/loadStrategicBrandsChart", 'ChartController@loadStrategicBrandsChart');

    Route::get("/retailer/chartProfits", 'ChartController@loadProfitsChart');
    Route::get("/retailer/loadOverviewRevenue", 'ChartController@loadOverviewRevenue');


    Route::get("/retailer/chartOrders", 'ChartController@loadOrdersChart');

    Route::get("/retailer/chartDonuts", 'ChartController@loadDonutChart');

    Route::get("/retailer/enquiries", 'retailerController@loadEnquiries');

    Route::get("/retailer/enquiries/newReply", 'retailerController@makeReply');

    Route::get("/retailer/orders/changeStatus", 'retailerController@changeOrderItemStatus');

    Route::get("/retailer/complains", 'retailerController@complains');
    Route::get("/retailer/complains/newReply", 'retailerController@makeComplainReply');


    Route::get("/retailer/reports", 'retailerController@reports');

    Route::get('/retailer/charts', function () {
        return view('Retailer/charts');
    });

    Route::post("/retailer/spares", 'sparesController@store');

    Route::post("/retailer/spares/edit", 'sparesController@edit');

    Route::get('/retailer/spares/delete/{id}', 'sparesController@destroy');

    Route::get('/retailer/spares/getModels', 'sparesController@getModels');

    Route::post('/retailer/spares/search', 'sparesController@search');
    Route::post('/retailer/orders/search', 'ordersController@search');



    Route::get('/retailer/spares', 'sparesController@load') ;

    Route::get('/retailer/spares/getYears', 'sparesController@getYears');


});