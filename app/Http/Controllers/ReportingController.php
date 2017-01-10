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
class ReportingController extends Controller
{
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
