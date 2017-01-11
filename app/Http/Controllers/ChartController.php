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

class ChartController extends Controller
{
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
    public function loadStrategicSalesChart(Request $request)
    {

        $year= 2016;
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
                $reportData[$month][$category->categoryName] = $categoryValue ;
                $reportData[$month]['subTotal'] =  $subTotal;

            }

        }

        return $reportData;



    }


    public function loadStrategicBrandsChart(Request $request)
    {

        $year= 2016;
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


        $brands = App\Brands::all();
        foreach ($months as $month) {

            $subTotal = 0;

            foreach ($brands as $brand) {
                $brandValue = 0;
                foreach ($salesItems as $salesItem) {
                    $requestDate = explode('-', $salesItem->order->orderDate );
                    $salesItemYear= $requestDate[0];
                    $salesItemMonth= $requestDate[1];
                    $salesItemYearMonth=$salesItemYear.'-'.$salesItemMonth;


                    if ($month == $salesItemYearMonth && ($brand->id == $salesItem->spare->brand_id)) {
                        $brandValue = $brandValue + $salesItem->subTotal-$salesItem->totalCost;

                    }
                }
                 $reportData[$month][$brand->brandName] = $brandValue ;

            }

        }

        return $reportData;



    }

    public function loadSalesChart()
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

    }


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

    public function  loadOverviewRevenue(){

        $salesItems = array();
        $reportData = [];

        $reportTotal = 0;


           $year=2016;

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
                     $reportData[$month]['subTotal'] =  $subTotal ;
                    $reportData[$month]['totalCost']=$totalCost ;
                    $reportData[$month]['totalProfit']=  $totalProfit ;


                }
                $reportTotal = $reportTotal + $totalProfit;
            }

return $reportData;
    }

}
