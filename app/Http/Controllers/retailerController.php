<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;
use App;
use App\User;
use App\Orders;

use App\Message;
use App\Spares;
use App\OrderItem;
use App\Feedback;
use Illuminate\Support\Facades\View;
use App\Retailers;
use Auth;
use App\Http\Requests\RegisterRetailerDataRequest;
use Mockery\CountValidator\Exception;

class retailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::user()->id;
        $reviewItems = DB::table('feedback')->where('feedbackType', '=', "review")
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id')->join('users', 'feedback.user_id', '=', 'users.id')->get();

        foreach ($reviewItems as $key => $reviewItem) {

            $spare = Spares::find($reviewItem->spare_id);

            if ($spare->retailer_id != $user_id) {
                unset($reviewItems[$key]);
            } else {
                $reviewItems[$key]->spdescription = $spare->description;
                $reviewItems[$key]->imagePath = $spare->imagePath;
            }

        }

        $orders = App\Orders::all();

        $reviewCount = $reviewItems->count();
        $enquiryCount = App\Enquiries::all()->count();


        $orderItems = Orderitem::with('spare', 'order')->where('orderStatus', '=', 'purchased')->get();

        foreach ($orderItems as $key => $orderItem) {
            if ($orderItem->spare->retailer_id != Auth::user()->id) {
                unset($orderItems[$key]);
            }
        }
        $ordersCount = $orderItems->count();

        $complainItems = DB::table('feedback')->where('feedbackType', '=', "Complain")
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id')->join('users', 'feedback.user_id', '=', 'users.id')->get();

        foreach ($complainItems as $key => $complainItem) {
            $spare = Spares::find($complainItem->spare_id);
            if ($spare->retailer_id != $user_id) {
                unset($complainItems[$key]);

            } else {
                $complainItems[$key]->spdescription = $spare->description;
                $complainItems[$key]->imagePath = $spare->imagePath;

            }
        }

        $complainCount = $complainItems->count();


        return View::make('Retailer/home')->with('reviewCount', $reviewCount)->with('enquiryCount', $enquiryCount)->with('ordersCount', $ordersCount)->with('complainCount', $complainCount)->with('orders', $orders)->with('orderItems', $orderItems);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRetailerDataRequest $request)
    {
        $imagePath = "";

        $RecordUser = new User;
        $RecordUser->name = $request->get('name');


        $RecordUser->email = $request->get('email');
        $RecordUser->password = bcrypt($request->get('password'));
        $id = DB::table('users')->insertGetId(
            ['email' => $RecordUser->email, 'name' => $RecordUser->name, 'password' => $RecordUser->password, 'type' => 'r']
        );

        $Record = new Retailers;
        $Record->address = $request->get('address');
        $Record->contactNo = $request->get('contactNo');

        if ($file = $request->hasFile('retailerImage')) {
            $file = $request->file('retailerImage');

            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path() . '/images';
            $file->move($destinationPath, $fileName);
            $imagePath = $fileName;

            $Record->avatarImage = $imagePath;
        }

        $Record->shopName = $request->get('shopName');
        $Record->user_id = $id;
        $Record->save();

        \Session::flash('flash_message', 'New Retailer registerd Successfully.'); //<--FLASH MESSAGE
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function complains()
    {
        $user_id = Auth::user()->id;


        $orderItems = DB::table('feedback')->where('feedbackType', '=', "Complain")
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id')->join('users', 'feedback.user_id', '=', 'users.id')->get();

        foreach ($orderItems as $key => $orderItem) {
            $spare = Spares::find($orderItem->spare_id);
            if ($spare->retailer_id != $user_id) {
                unset($orderItems[$key]);

            } else {
                $orderItems[$key]->spdescription = $spare->description;
                $orderItems[$key]->imagePath = $spare->imagePath;

            }
        }
         return View::make('Retailer/complains')->with('complains', $orderItems);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function loadOrders()
    {


        $orderItems = OrderItem::with('spare', 'order')->get();


        return View::make('Retailer/Orders')->with('orderItems', $orderItems);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function changeOrderItemStatus(Request $request)
    {
        $orderItemId = $request->orderItemId;
        $orderItemStatus = $request->orderItemStatus;
        try {
            DB::table('orderItem')
                ->where('id', $orderItemId)
                ->update(['orderStatus' => $orderItemStatus]);
            return "Order Status Changed Successfully";
        } catch (Exception $e) {

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function makeReply(Request $request)
    {

        $message = new Message();

        $Message = $request->message;
        $customerId = $request->customerId;
        $retailerId = $request->retailerId;
        $message->messageType = "Enquiry";
        $message->user_id = $customerId;
        $message->message = $Message;
        $message->retailer_id = $retailerId;
        $message->save();

        return "Message Successfully Sent";


    }

    public function makeComplainReply(Request $request)
    {
        $message = new Message();

        $Message = $request->message;
        $orderItem = $request->orderItem;

        $customerId = $request->customerId;
        $retailerId = $request->retailerId;
        $message->messageType = "Complain";
        $message->orderItem_id=$orderItem;
        $message->user_id = $customerId;
        $message->message = $Message;
        $message->retailer_id = $retailerId;
        $message->save();

        return "Message Successfully Sent";


    }
    public function loadOrdersChart()
    {

        $orderItems = OrderItem::with('spare', 'order')->get();
        $date = array();

        $value = 0;
        $orders = array();
        $salesItems = array();

        foreach ($orderItems as $key => $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                if ($orderItem->order->orderDate >= date('Y-m-d', strtotime("-1 week"))) {

                    array_push($salesItems, $orderItem);
                }
            }

        }

        foreach ($salesItems as $key => $salesItem) {
            $currentDate = $salesItem->order->orderDate;
            if (in_array($currentDate, $date)) {

                $value = $value + 1;


                if ($key == (count($salesItems) - 1)) {

                    array_push($orders, $value);


                }


            } else {

                if ($key == 0) {
                    array_push($date, $currentDate);
                    $value = 1;

                    if ($salesItems[0]->order->orderDate != $currentDate) {
                        array_push($orders, $value);
                    }

                } elseif ($key == (count($salesItems) - 1)) {
                    array_push($date, $currentDate);

                    array_push($orders, $value);
                    $value = 1;
                    array_push($orders, $value);

                } else {
                    array_push($date, $currentDate);

                    array_push($orders, $value);
                    $value = 1;
                }

            }
        }


        $salesChart = array('Date' => $date,
            'value' => $orders);
        return ($salesChart);

    }
    public function loadSalesChart(Request $request)
    {

            $year= date("Y");
        $salesItems=[];



        $mon = array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July ',
            'August',
            'September',
            'October',
            'November',
            'December',
        );

        $months = array(
            $year.'-01',
            $year.'-02',
            $year.'-03',
            $year.'-04',
            $year.'-05',
            $year.'-06',
            $year.'-07',
            $year.'-08',
            $year.'-09',
            $year.'-10',
            $year.'-11',
            $year.'-12',
        );





        foreach ($months as $key => $month) {

            $reportData[$month] = [];

        }

        foreach ($months as $key => $month) {

            $reportData[$month]['month'] = $mon[$key];

        }


        $orderItems = OrderItem::with('spare', 'order')->get();

        foreach ($orderItems as $key => $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                array_push($salesItems, $orderItem);
            }


        }


        $categories = App\Categories::all();
        foreach ($months as $month) {

            $subTotal = 0;

            foreach ($categories as $category) {
                $categoryValue = 0;
                foreach ($salesItems as $salesItem) {
                    $requestDate = explode('-', $salesItem->order->orderDate );
                    $salesItemYear= $requestDate[0];
                    $salesItemMonth= $requestDate[1];
                    $salesItemYearMonth=$salesItemYear.'-'.$salesItemMonth;


                    if ($month == $salesItemYearMonth && ($category->id == $salesItem->spare->category_id)) {
                        $categoryValue = $categoryValue + $salesItem->subTotal;

                    }
                }
                $subTotal = $categoryValue + $subTotal;
                $reportData[$month][$category->categoryName] = "Rs. " . $categoryValue . "/=";
                $reportData[$month]['subTotal'] = "Rs. " . $subTotal . "/=";

            }

        }

        return $reportData;



    }

/*    public function loadSalesChart()
    {
        $orderItems = OrderItem::with('spare', 'order')->get();
        $date = array();

        $value = 0;
        $orders = array();
        $salesItems = array();
         foreach ($orderItems as $key => $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                if ($orderItem->order->orderDate >= date('Y-m-d', strtotime("-1 week"))) {

                    array_push($salesItems, $orderItem);
                }

            }
        }

        foreach ($salesItems as $key => $salesItem) {
            $currentDate = $salesItem->order->orderDate;


            if (in_array($currentDate, $date)) {

                $value += $salesItem->subTotal;

                if ($key == (count($salesItems) - 1)) {
                    array_push($orders, $value);

                }

            } else {

                if ($key == 0) {
                    array_push($date, $currentDate);
                    $value = $salesItem->subTotal;

                    if ((count($salesItems) == 1)) {
                        array_push($orders, $value);

                    }

                    if ($salesItems[0]->order->orderDate != $currentDate) {
                        array_push($orders, $value);
                    }

                } elseif ($key == (count($salesItems) - 1)) {

                    array_push($date, $currentDate);

                    array_push($orders, $value);
                    $value = $salesItem->subTotal;
                    array_push($orders, $value);

                } else {
                    array_push($date, $currentDate);

                    array_push($orders, $value);
                    $value = $salesItem->subTotal;;
                }

            }


        }


        $salesChart = array('Date' => $date,
            'value' => $orders);
        return ($salesChart);

    }*/


    function loadProfitsChart(){
        $orderItems = OrderItem::with('spare', 'order')->get();
        $date = array();

        $value = 0;
        $orders = array();
        $salesItems = array();
        foreach ($orderItems as $key => $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                if ($orderItem->order->orderDate >= date('Y-m-d', strtotime("-1 week"))) {

                    array_push($salesItems, $orderItem);
                }

            }
        }

        foreach ($salesItems as $key => $salesItem) {
            $currentDate = $salesItem->order->orderDate;


            if (in_array($currentDate, $date)) {

                $value += $salesItem->subTotal-$salesItem->totalCost;

                if ($key == (count($salesItems) - 1)) {
                    array_push($orders, $value);

                }

            } else {

                if ($key == 0) {
                    array_push($date, $currentDate);
                    $value = $salesItem->subTotal-$salesItem->totalCost;

                    if ((count($salesItems) == 1)) {
                        array_push($orders, $value);

                    }

                    if ($salesItems[0]->order->orderDate != $currentDate) {
                        array_push($orders, $value);
                    }

                } elseif ($key == (count($salesItems) - 1)) {

                    array_push($date, $currentDate);

                    array_push($orders, $value);
                    $value = $salesItem->subTotal-$salesItem->totalCost;
                    array_push($orders, $value);

                } else {
                    array_push($date, $currentDate);

                    array_push($orders, $value);
                    $value = $salesItem->subTotal-$salesItem->totalCost;;
                }

            }


        }


        $salesChart = array('Date' => $date,
            'value' => $orders);
        return ($salesChart);

    }



    function loadDonutChart()
    {
        $purchased = 0;
        $shipped = 0;
        $delivered = 0;
        $orderItems = OrderItem::all();

        $salesItems = array();
        $values = array();


        foreach ($orderItems as $key => $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                array_push($salesItems, $orderItem);

            }


        }


        foreach ($salesItems as $key => $salesItem) {


            if ($salesItem->orderStatus == "Shipped") {
                $shipped++;
            } elseif ($salesItem->orderStatus == "Purchased") {
                $purchased++;
            } elseif ($salesItem->orderStatus == "Delivered") {
                $delivered++;
            }

        }


        $values = [$shipped, $purchased, $delivered];
        return ($values);
    }


    public function loadEnquiries()
    {
        $enquiries = App\Enquiries::with('user')->get();
        return View::make('Retailer/enquiries')->with('enquiries', $enquiries);
    }

    public function reports()
    {
        return View::make('Retailer/reports');
    }

    public function loadReports(Request $request)
    {

        $userId = Auth::user()->id;
        $retailer = DB::table('retailers')
            ->where('user_id', $userId)->first();
        $image = $retailer->avatarImage;
        $address = $retailer->address;

        $data = array();
        $dayArray = array();
        $salesItems = array();
        $reportData = [];
        $reportStartDate = "";
        $reportEndDate = "";
        $reportHeading = "";
        $startdate = "";
        $reportTotal = 0;
        $costTotal=0;
        $profitTotal=0;

        if ($request->reportType == "sales" && $request->frequency == "weekly") {
            $reportHeading = "Weekly Sales Report";
            $startdate = date('Y-m-d', strtotime("-1 week"));
            $enddate = date('Y-m-d');

            while (strtotime($startdate) < strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }

            foreach ($data as $key => $date) {
                if ($key == 0) {
                    $reportStartDate = $date;
                } elseif ($key = count($data) - 1) {
                    $reportEndDate = $date;
                }
            }
            foreach ($dayArray as $key => $day) {
                $reportData[$day] = [];

            }

            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }
            $categories = App\Categories::all();
            foreach ($data as $date) {
                $day = date('l', strtotime($date));

                $subTotal = 0;

                foreach ($categories as $category) {
                    $categoryValue = 0;
                    foreach ($salesItems as $salesItem) {
                        if ($date == $salesItem->order->orderDate && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue + $salesItem->subTotal;

                        }
                    }
                    $subTotal = $categoryValue + $subTotal;

                    $reportData[$day][$category->categoryName] = "Rs. " . $categoryValue . "/=";
                    $reportData[$day]['subTotal'] = "Rs. " . $subTotal . "/=";

                }
                $reportTotal = $reportTotal + $subTotal;

            }
            dd($reportData);
            $reportTotal = "Rs." . $reportTotal . "/=";

            return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('reportStartDate', $reportStartDate)
                ->with('reportEndDate', $reportEndDate)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);


        }

        if ($request->reportType == "sales" && $request->frequency == "monthly") {

            if ($request->monthSelect != null) {
                $reportHeading = "Monthly Sales Report";

                $requestDate = $request->monthSelect;
                $requestDate = explode('-', $requestDate);
                $year = $requestDate[0];
                $month = $requestDate[1];

                $startdate = $year . '-' . $month . '-01';
                $startdate = str_replace(' ', '', $startdate);

                // $a_date = new DateTime( $startdate );
                $enddate = date("Y-m-t", strtotime($startdate));


            } else {
                $reportHeading = "Last 30 Days Sales Report";

                $startdate = date('Y-m-d', strtotime("-1 month"));
                $enddate = date('Y-m-d');
            }


            while (strtotime($startdate) <= strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }

            foreach ($data as $key => $date) {
                if ($key == 0) {
                    $reportStartDate = $date;
                } elseif ($key = count($data) - 1) {
                    $reportEndDate = $date;

                }

                $reportData[$date] = [];

            }

            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }
            $categories = App\Categories::all();
            foreach ($data as $date) {
                $day = date('l', strtotime($date));

                $subTotal = 0;

                foreach ($categories as $category) {
                    $categoryValue = 0;
                    foreach ($salesItems as $salesItem) {
                        if ($date == $salesItem->order->orderDate && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue + $salesItem->subTotal;

                        }
                    }
                    $subTotal = $categoryValue + $subTotal;
                    $reportData[$date][$category->categoryName] = "Rs. " . $categoryValue . "/=";
                    $reportData[$date]['subTotal'] = "Rs. " . $subTotal . "/=";

                }
                $reportTotal = $reportTotal + $subTotal;
            }
            $reportTotal = "Rs." . $reportTotal . "/=";

            return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('reportStartDate', $reportStartDate)
                ->with('reportEndDate', $reportEndDate)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);


        }

        if ($request->reportType == "orders" && $request->frequency == "weekly") {
            $reportHeading = "Weekly Orders Report";
            $startdate = date('Y-m-d', strtotime("-1 week"));
            $enddate = date('Y-m-d');

            while (strtotime($startdate) < strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }

            foreach ($data as $key => $date) {
                if ($key == 0) {
                    $reportStartDate = $date;
                } elseif ($key = count($data) - 1) {
                    $reportEndDate = $date;
                }
            }
            foreach ($dayArray as $key => $day) {
                $reportData[$day] = [];
            }

            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }
            $categories = App\Categories::all();
            foreach ($data as $date) {
                $day = date('l', strtotime($date));

                $subTotal = 0;

                foreach ($categories as $category) {
                    $categoryValue = 0;
                    foreach ($salesItems as $salesItem) {
                        if ($date == $salesItem->order->orderDate && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue + 1;

                        }
                    }
                    $subTotal = $categoryValue + $subTotal;
                    $reportData[$day][$category->categoryName] = $categoryValue;
                    $reportData[$day]['subTotal'] = $subTotal;

                }
                $reportTotal = $reportTotal + $subTotal;

            }
            return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('reportStartDate', $reportStartDate)
                ->with('reportEndDate', $reportEndDate)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);;


        }

        if ($request->reportType == "orders" && $request->frequency == "monthly") {


            if ($request->monthSelect != null) {
                $reportHeading = "Monthly Orders Report";

                $requestDate = $request->monthSelect;
                $requestDate = explode('-', $requestDate);
                $year = $requestDate[0];
                $month = $requestDate[1];

                $startdate = $year . '-' . $month . '-01';
                $startdate = str_replace(' ', '', $startdate);
                // $a_date = new DateTime( $startdate );
                $enddate = date("Y-m-t", strtotime($startdate));


            } else {

                $reportHeading = "Last 30 days Order Items Report";
                $startdate = date('Y-m-d', strtotime("-4 week"));
                $enddate = date('Y-m-d');
            }


            while (strtotime($startdate) <= strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }

            foreach ($data as $key => $date) {
                if ($key == 0) {
                    $reportStartDate = $date;
                } elseif ($key = count($data) - 1) {
                    $reportEndDate = $date;

                }

                $reportData[$date] = [];

            }

            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }
            $categories = App\Categories::all();
            foreach ($data as $date) {
                $day = date('l', strtotime($date));

                $subTotal = 0;

                foreach ($categories as $category) {
                    $categoryValue = 0;
                    foreach ($salesItems as $salesItem) {
                        if ($date == $salesItem->order->orderDate && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue + 1;

                        }
                    }

                    $subTotal = $categoryValue + $subTotal;
                    $reportData[$date][$category->categoryName] = $categoryValue;
                    $reportData[$date]['subTotal'] = $subTotal;

                }
                $reportTotal = $reportTotal + $subTotal;

            }

            return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('reportStartDate', $reportStartDate)
                ->with('reportEndDate', $reportEndDate)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);

        }

        if ($request->reportType == "sales" && $request->frequency == "daily") {
            $dailySales = [];
            $dailyTotal = 0;
            $reportHeading = "Daily Sales Report";
            if ($request->oneDate) {
                $startdate = $request->oneDate;
            } else {
                $startdate = date('Y-m-d');

            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);

                }


            }


            foreach ($salesItems as $salesItem) {
                if ($startdate == $salesItem->order->orderDate) {

                    $dailyTotal = $dailyTotal + $salesItem->subTotal;

                    array_push($dailySales, $salesItem);

                }
            }


            return View::make('Retailer/reports')->with('image', $image)->with('dailyTotal', $dailyTotal)->with('dailySales', $dailySales)->with('reportHeading', $reportHeading)->with('reportDate', $startdate);


        }

       if ($request->reportType == "orders" && $request->frequency == "daily") {
           $dailySales = [];
           $dailyTotal = 0;
           $reportHeading = "Daily Orders Report";

           $dailyOrders=array();

           if ($request->oneDate) {
               $startdate = $request->oneDate;
           } else {
               $startdate = date('Y-m-d');

           }
            $orderItems = OrderItem::with('spare', 'order')->get();
           $orders=Orders::with('user')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);

                }


            }






            foreach ($salesItems as $salesItem) {
                if ($startdate == $salesItem->order->orderDate) {

                    $dailyTotal = $dailyTotal + 1;

                    array_push($dailySales, $salesItem);

                }
            }
           foreach ($dailySales as $dailySale){
               foreach ($orders as $order){
                   if($order->id==$dailySale->order_id){
                       if(!in_array($order, $dailyOrders, true)){
                           array_push($dailyOrders, $order);
                       }
                    }
               }

           }

            return View::make('Retailer/reports')->with('image', $image)->with('dailyTotal', $dailyTotal)->with('dailySales', $dailySales)->with('reportHeading', $reportHeading)->with('reportDate', $startdate)->with('dailyOrders',$dailyOrders);


        }



        if ($request->reportType == "inventory") {
            $categories = App\Categories::all();
            $retailer_id = Auth::user()->id;
            $reportHeading = "Inventory Report";
            $spares = Spares::with('brand', 'model', 'category')
                ->where('retailer_id', $retailer_id)->get();
            $startdate = date('Y-m-d');


            return View::make('Retailer/reports')->with('image', $image)->with('address', $address)->with('categories', $categories)->with('spares', $spares)->with('reportHeading', $reportHeading)->with('reportDate', $startdate);

        }


        if ($request->reportType == "profit" && $request->frequency == "daily") {
            $dailyProfit = [];
            $dailyTotal = 0;
            $reportHeading = "Daily Income Report";
            if ($request->oneDate) {
                $startdate = $request->oneDate;
            } else {
                $startdate = date('Y-m-d');
            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }


            foreach ($salesItems as $salesItem) {
                if ($startdate == $salesItem->order->orderDate) {

                    $dailyTotal = $dailyTotal + $salesItem->subTotal - $salesItem->totalCost;
                    $costTotal=$costTotal+$salesItem->totalCost;
                    $profitTotal=$profitTotal+$salesItem->subTotal;
                    array_push($dailyProfit, $salesItem);

                }
            }

             return View::make('Retailer/reports')->with('image', $image)->with('costTotal',$costTotal)->with('profitTotal',$profitTotal)->with('dailyTotal', $dailyTotal)->with('dailyProfit', $dailyProfit)->with('reportHeading', $reportHeading)->with('reportDate', $startdate);


        }

        if ($request->reportType == "profit" && $request->frequency == "weekly") {
            $dailyProfit = [];
            $dailyTotal = 0;

            $reportHeading = "Weekly Income Report";
            $startdate = date('Y-m-d', strtotime("-1 week"));
            $enddate = date('Y-m-d');

            while (strtotime($startdate) <= strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }

            foreach ($data as $startdate) {
                foreach ($salesItems as $salesItem) {
                    if ($startdate == $salesItem->order->orderDate) {

                        $dailyTotal = $dailyTotal + $salesItem->subTotal - $salesItem->totalCost;
                        $costTotal=$costTotal+$salesItem->totalCost;
                        $profitTotal=$profitTotal+$salesItem->subTotal;
                        array_push($dailyProfit, $salesItem);

                    }
                }

            }


            return View::make('Retailer/reports')->with('image', $image)->with('costTotal',$costTotal)->with('profitTotal',$profitTotal)->with('dailyTotal', $dailyTotal)->with('dailyProfit', $dailyProfit)->with('reportHeading', $reportHeading)->with('reportDate', $startdate);


        }

        if ($request->reportType == "profit" && $request->frequency == "monthly") {

            if ($request->monthSelect != null) {
                $reportHeading = "Monthly Income Report";

                $requestDate = $request->monthSelect;
                $requestDate = explode('-', $requestDate);
                $year = $requestDate[0];
                $month = $requestDate[1];
                $int = (int)$month;


                $monthName = date('F', mktime(0, 0, 0, $int, 10));


                $startdate = $year . '-' . $month . '-01';
                $startdate = str_replace(' ', '', $startdate);
                // $a_date = new DateTime( $startdate );
                $enddate = date("Y-m-t", strtotime($startdate));


            } else {

                $reportHeading = "Last 30 days Income Report";
                $startdate = date('Y-m-d', strtotime("-4 week"));
                $enddate = date('Y-m-d');
                $monthName=$startdate." to ".$enddate;
            }


            while (strtotime($startdate) <= strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }


            $dailyProfit = [];
            $dailyTotal = 0;


            while (strtotime($startdate) <= strtotime($enddate)) {
                $day = date('l', strtotime($startdate));
                array_push($dayArray, $day);

                array_push($data, $startdate);
                $startdate = date("Y-m-d", strtotime("+1 day", strtotime($startdate)));
            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }


            foreach ($data as $startdate) {
                foreach ($salesItems as $salesItem) {
                    if ($startdate == $salesItem->order->orderDate) {

                        $dailyTotal = $dailyTotal + $salesItem->subTotal - $salesItem->totalCost;
                        $costTotal=$costTotal+$salesItem->totalCost;
                        $profitTotal=$profitTotal+$salesItem->subTotal;

                        array_push($dailyProfit, $salesItem);

                    }
                }

            }


            return View::make('Retailer/reports')->with('image', $image)->with('costTotal',$costTotal)->with('profitTotal',$profitTotal)->with('dailyTotal', $dailyTotal)->with('dailyProfit', $dailyProfit)->with('reportHeading', $reportHeading)->with('month', $monthName);


        }

        if ($request->reportType == "sales" && $request->frequency == "yearly") {

            if ($request->yearSelect != null) {
                $reportHeading = "Yearly Sales Report";

                $year = $request->yearSelect;





            } else {
                $reportHeading = "This Year Sales Report";

             $year= date("Y");
            }


            $mon = array(
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July ',
                'August',
                'September',
                'October',
                'November',
                'December',
            );

            $months = array(
                $year.'-01',
                $year.'-02',
                $year.'-03',
                $year.'-04',
                $year.'-05',
                $year.'-06',
                $year.'-07',
                $year.'-08',
                $year.'-09',
                $year.'-10',
                $year.'-11',
                $year.'-12',
            );





            foreach ($months as $key => $month) {

                $reportData[$month] = [];

            }

            foreach ($months as $key => $month) {

                    $reportData[$month]['month'] = $mon[$key];

            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }


            $categories = App\Categories::all();
            foreach ($months as $month) {

                $subTotal = 0;

                foreach ($categories as $category) {
                    $categoryValue = 0;
                    foreach ($salesItems as $salesItem) {
                        $requestDate = explode('-', $salesItem->order->orderDate );
                        $salesItemYear= $requestDate[0];
                        $salesItemMonth= $requestDate[1];
                        $salesItemYearMonth=$salesItemYear.'-'.$salesItemMonth;


                        if ($month == $salesItemYearMonth && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue + $salesItem->subTotal;

                        }
                    }
                    $subTotal = $categoryValue + $subTotal;
                    $reportData[$month][$category->categoryName] = "Rs. " . $categoryValue . "/=";
                    $reportData[$month]['subTotal'] = "Rs. " . $subTotal . "/=";

                }
                $reportTotal = $reportTotal + $subTotal;
            }
             $reportTotal = "Rs." . $reportTotal . "/=";
             return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('reportStartDate', $reportStartDate)
                ->with('year', $year)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);


        }


        if ($request->reportType == "orders" && $request->frequency == "yearly") {

            if ($request->yearSelect != null) {
                $reportHeading = "Yearly Orders Report";

                $year = $request->yearSelect;





            } else {
                $reportHeading = "This Year Orders Report";

                $year= date("Y");
            }


            $mon = array(
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July ',
                'August',
                'September',
                'October',
                'November',
                'December',
            );

            $months = array(
                $year.'-01',
                $year.'-02',
                $year.'-03',
                $year.'-04',
                $year.'-05',
                $year.'-06',
                $year.'-07',
                $year.'-08',
                $year.'-09',
                $year.'-10',
                $year.'-11',
                $year.'-12',
            );





            foreach ($months as $key => $month) {

                $reportData[$month] = [];

            }

            foreach ($months as $key => $month) {

                $reportData[$month]['month'] = $mon[$key];

            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }


            $categories = App\Categories::all();
            foreach ($months as $month) {

                $subTotal = 0;

                foreach ($categories as $category) {
                    $categoryValue = 0;
                    foreach ($salesItems as $salesItem) {
                        $requestDate = explode('-', $salesItem->order->orderDate );
                        $salesItemYear= $requestDate[0];
                        $salesItemMonth= $requestDate[1];
                        $salesItemYearMonth=$salesItemYear.'-'.$salesItemMonth;


                        if ($month == $salesItemYearMonth && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue +1;

                        }
                    }
                    $subTotal = $categoryValue + $subTotal;
                    $reportData[$month][$category->categoryName] = $categoryValue ;
                    $reportData[$month]['subTotal'] = $subTotal;

                }
                $reportTotal = $reportTotal + $subTotal;
            }

            return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('reportStartDate', $reportStartDate)
                ->with('year', $year)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);


        }


        if ($request->reportType == "profit" && $request->frequency == "yearly") {

            if ($request->yearSelect != null) {
                $reportHeading = "Yearly Income Report";

                $year = $request->yearSelect;





            } else {
                $reportHeading = "This Year Income Report";

                $year= date("Y");
            }


            $mon = array(
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July ',
                'August',
                'September',
                'October',
                'November',
                'December',
            );

            $months = array(
                $year.'-01',
                $year.'-02',
                $year.'-03',
                $year.'-04',
                $year.'-05',
                $year.'-06',
                $year.'-07',
                $year.'-08',
                $year.'-09',
                $year.'-10',
                $year.'-11',
                $year.'-12',
            );





            foreach ($months as $key => $month) {

                $reportData[$month] = [];

            }

            foreach ($months as $key => $month) {

                $reportData[$month]['month'] = $mon[$key];

            }


            $orderItems = OrderItem::with('spare', 'order')->get();

            foreach ($orderItems as $key => $orderItem) {


                if ($orderItem->spare->retailer_id == Auth::user()->id) {
                    array_push($salesItems, $orderItem);
                }


            }


            $categories = App\Categories::all();
            foreach ($months as $month) {

                $subTotal = 0;
                $totalCost=0;
                $totalProfit=0;
                foreach ($categories as $category) {
                    $categoryValue = 0;
                    $categoryCost=0;

                    foreach ($salesItems as $salesItem) {
                        $requestDate = explode('-', $salesItem->order->orderDate );
                        $salesItemYear= $requestDate[0];
                        $salesItemMonth= $requestDate[1];
                        $salesItemYearMonth=$salesItemYear.'-'.$salesItemMonth;


                        if ($month == $salesItemYearMonth && ($category->id == $salesItem->spare->category_id)) {
                            $categoryValue = $categoryValue + $salesItem->subTotal;
                            $categoryCost=$categoryCost+$salesItem->totalCost;

                        }
                    }
                    $subTotal = $categoryValue + $subTotal;
                    $totalCost=$categoryCost+$totalCost;
                    $totalProfit=$subTotal-$totalCost;
                    $reportData[$month][$category->categoryName] = "Rs. " . $categoryValue . "/=";
                    $reportData[$month]['subTotal'] = "Rs. " . $subTotal . "/=";
                    $reportData[$month]['totalCost']="Rs. " . $totalCost . "/=";
                    $reportData[$month]['totalProfit']="Rs. " . $totalProfit . "/=";


                }
                $reportTotal = $reportTotal + $totalProfit;
            }
             $reportTotal = "Rs." . $reportTotal . "/=";
            return View::make('Retailer/reports')->with('image', $image)->with('categories', $categories)->with('day', $dayArray)->with('yearlyProfit',2)->with('reportStartDate', $reportStartDate)
                ->with('year', $year)->with('reportData', $reportData)->with('reportHeading', $reportHeading)->with('reportTotal', $reportTotal);


        }

    }

}
