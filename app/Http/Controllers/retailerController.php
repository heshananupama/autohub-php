<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App;
use App\Http\Requests;
use App\User;
use App\Message;
use App\Spares;
use App\OrderItem;
use App\Feedback;
use Illuminate\Support\Facades\View;
use App\Retailer;
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

        $user_id= Auth::user()->id;
        $reviewItems = DB::table('feedback')->where('feedbackType','=', "review")
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id') ->join('users', 'feedback.user_id', '=', 'users.id')->get();

        foreach ($reviewItems as $key=>$reviewItem){
            $spare=Spares::find($reviewItem->spare_id);
 
            if($spare->retailer_id!=$user_id){
                unset($reviewItems[$key]);

            }
            else{
                $reviewItems[$key]->spdescription=$spare->description;
                $reviewItems[$key]->imagePath=$spare->imagePath;

            }
        }

        $orders=App\Orders::all();

        $reviewCount=$reviewItems ->count();
        $enquiryCount=App\Enquiries::all()->count();


        $orderItems = Orderitem::with('spare', 'order')->get();

        foreach($orderItems as $key=>$orderItem){
            if($orderItem->spare->retailer_id!= Auth::user()->id){
                unset($orderItems[$key]);
            }
        }
        $ordersCount=$orderItems->count();

        $complainItems = DB::table('feedback')->where('feedbackType','=', "Complain")
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id') ->join('users', 'feedback.user_id', '=', 'users.id')->get();

        foreach ($complainItems as $key=>$complainItem){
            $spare=Spares::find($complainItem->spare_id);
            if($spare->retailer_id!=$user_id){
                unset($complainItems[$key]);

            }
            else{
                $complainItems[$key]->spdescription=$spare->description;
                $complainItems[$key]->imagePath=$spare->imagePath;

            }
        }

        $complainCount=$complainItems ->count();



         return View::make('Retailer/home')->with('reviewCount',$reviewCount)->with('enquiryCount',$enquiryCount)->with('ordersCount',$ordersCount)->with('complainCount',$complainCount)->with('orders',$orders) ;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRetailerDataRequest $request)
    {

        $RecordUser=new User;
        $RecordUser->name=$request->get('name');
        $RecordUser->email=$request->get('email');
        $RecordUser->password=bcrypt($request->get('password'));

        $id = DB::table('users')->insertGetId(
            ['email' => $RecordUser->email, 'name' => $RecordUser->name,'password'=>$RecordUser->password,'type'=>'r']
        );

         print_r($id);
        $Record=new Retailer;
        $Record->address=$request->get('address');
        $Record->contactNo=$request->get('contactNo');

        $Record->shopName=$request->get('shopName');
        $Record->user_id=$id;
        $Record->save();

        \Session::flash('flash_message','New Retailer registerd Successfully.'); //<--FLASH MESSAGE

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complains()
    {
        $user_id= Auth::user()->id;



        $orderItems = DB::table('feedback')->where('feedbackType','=', "Complain")
            ->join('orderItem', 'feedback.orderItem_id', '=', 'orderItem.id') ->join('users', 'feedback.user_id', '=', 'users.id')->get();

        foreach ($orderItems as $key=>$orderItem){
             $spare=Spares::find($orderItem->spare_id);
            if($spare->retailer_id!=$user_id){
                unset($orderItems[$key]);

            }
            else{
                $orderItems[$key]->spdescription=$spare->description;
                $orderItems[$key]->imagePath=$spare->imagePath;

            }
         }

         return View::make('Retailer/complains')->with('complains', $orderItems);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeOrderItemStatus(Request $request)
    {
        $orderItemId=$request->orderItemId;
        $orderItemStatus=$request->orderItemStatus;
        try{
            DB::table('orderItem')
                ->where('id', $orderItemId)
                ->update(['orderStatus' => $orderItemStatus]);
            return "Order Status Changed Successfully";
        }
        catch (Exception $e){

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function makeReply(Request $request)
    {

            $message=new Message();

            $Message=$request->message;
            $customerId=$request->customerId;
            $retailerId=$request->retailerId;
            $message->messageType="Enquiry";
            $message->user_id=$customerId;
            $message->message=$Message;
            $message->retailer_id=$retailerId;
            $message->save();

        return "Message Successfully Sent";


    }

    public function loadOrdersChart(){

        $orderItems = OrderItem::with('spare', 'order')->get();
        $date=array();

        $value=0;
        $orders=array();
        $salesItems=array();

        foreach($orderItems as $key=> $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                array_push($salesItems,$orderItem);
            }

        }

        foreach($salesItems as $key=> $salesItem) {
            $currentDate = $salesItem->order->orderDate;
            if( in_array($currentDate  ,$date ) )
            {

                $value=$value+1;


                if($key==(count($salesItems)-1)){

                    array_push($orders,$value);


                }




            }
            else{

                if($key==0){
                    array_push($date,$currentDate);
                    $value=1;

                    if($salesItems[0]->order->orderDate!=$currentDate){
                        array_push($orders,$value);
                    }

                }
                elseif ($key==(count($salesItems)-1)){
                    array_push($date,$currentDate);

                    array_push($orders,$value);
                    $value=1;
                    array_push($orders,$value);

                }
                else{
                    array_push($date,$currentDate);

                    array_push($orders,$value);
                    $value=1;
                }

            }
        }


        /*else{

            if($key==0){
                array_push($date,$currentDate);
                $value=$salesItem->subTotal;

                if($salesItems[0]->order->orderDate!=$currentDate){
                    array_push($orders,$value);
                }

            }
            elseif ($key==(count($salesItems)-1)){
                array_push($date,$currentDate);

                array_push($orders,$value);
                $value=$salesItem->subTotal;
                array_push($orders,$value);

            }
            else{
                array_push($date,$currentDate);

                array_push($orders,$value);
                $value=$salesItem->subTotal;;
            }

        }*/




        $salesChart=array('Date'=>$date,
            'value'=>$orders);
        return($salesChart);

    }


    public function loadSalesChart(){
        $orderItems = OrderItem::with('spare', 'order')->get();
        $date=array();

         $value=0;
        $orders=array();
        $salesItems=array();

        foreach($orderItems as $key=> $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                array_push($salesItems,$orderItem);


            }
        }
          foreach($salesItems as $key=> $salesItem) {
            $currentDate = $salesItem->order->orderDate;
                 if( in_array($currentDate  ,$date ) )
                {

                    $value+=$salesItem->subTotal;


                    if($key==(count($salesItems)-1)){

                        array_push($orders,$value);


                    }




                }
                else{

                    if($key==0){
                        array_push($date,$currentDate);
                        $value=$salesItem->subTotal;

                        if($salesItems[0]->order->orderDate!=$currentDate){
                            array_push($orders,$value);
                        }

                     }
                    elseif ($key==(count($salesItems)-1)){
                         array_push($date,$currentDate);

                        array_push($orders,$value);
                        $value=$salesItem->subTotal;
                        array_push($orders,$value);

                    }
                    else{
                        array_push($date,$currentDate);

                        array_push($orders,$value);
                        $value=$salesItem->subTotal;;
                    }

                }
              }



         $salesChart=array('Date'=>$date,
             'value'=>$orders);
        return($salesChart);

    }


    function loadDonutChart(){
        $purchased=0;
        $shipped=0;
        $delivered=0;
        $orderItems = OrderItem::all();

        $salesItems=array();
        $values=array();


        foreach($orderItems as $key=> $orderItem) {


            if ($orderItem->spare->retailer_id == Auth::user()->id) {
                array_push($salesItems,$orderItem);

            }


        }


        foreach($salesItems as $key=> $salesItem) {


            if ($salesItem->orderStatus == "Shipped") {
                $shipped++;
            }
            elseif ($salesItem->orderStatus == "Purchased") {
                $purchased++;
            }

            elseif ($salesItem->orderStatus == "Delivered") {
                $delivered++;
            }

        }


        $values=[$shipped,$purchased,$delivered];
        return($values);
    }



    public function loadEnquiries()
    {
        $enquiries=App\Enquiries::with('user')->get();
        return View::make('Retailer/enquiries')->with('enquiries',$enquiries);
    }



}
