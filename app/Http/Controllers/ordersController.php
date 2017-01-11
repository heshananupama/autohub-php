<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Spares;
use App\Feedback;

 use Illuminate\Http\Request;
 use App\Http\Requests;
use App\Http\Requests\ComplainDataRequest;

use App\OrderItem;
use Illuminate\Support\Facades\View;
use App;
use DB;
use Auth;

class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id= Auth::user()->id;

        $orders=App\Orders::where('user_id', $user_id) ->orderBy('created_at', 'asc')
            ->get();



        return View::make('feedback')->with('orders', $orders);
    }

    public function search(Request $request){
        $search=($request->search);
        $user_id = Auth::user()->id;

        $orderItems = OrderItem::with('spare', 'order') ->orderBy('created_at', 'desc')->get();

        foreach ($orderItems as $key=> $orderItem){
             if($orderItem->order->orderDate!=$search ){
                unset($orderItems[$key]);
            }
        }


        return View::make('Retailer/ordersSearch')->with('orderItems', $orderItems);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveReview(Request $request)
    {
        $user_id = Auth::user()->id;

        $orderItemId=$request->orderItemId;
        $starValue=$request->starValue;
        $review=$request->review;
        $feedback=new Feedback();
        $feedback->orderItem_id=$orderItemId;
        $feedback->rating=$starValue;
        $feedback->user_id=$user_id;
        $feedback->description=$review;
        $feedback->feedbackType="Review";

        $feedback->save();
        return "feedback added Successfully";

     }
    public function saveComplain(Request $request)
    {
        $user_id = Auth::user()->id;
        $phoneNumber=$request->phoneNumber;

        $orderItemId=$request->orderItemId;
         $complain=$request->complain;
        $feedback=new Feedback();
        $feedback->orderItem_id=$orderItemId;
         $feedback->user_id=$user_id;
        $feedback->phoneNumber=$phoneNumber;

        $feedback->description=$complain;
        $feedback->feedbackType="Complain";

        $feedback->save();
        return "feedback added Successfully";

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($OrderId)
    {
        $user_id= Auth::user()->id;

        $orderDate= DB::table('orders')->where('id', $OrderId)->value('orderDate');


        $orders=App\Orders::where('user_id', $user_id)
            ->get();

        $feedbackReview=DB::table('feedback')->where('feedbackType','=', 'Review')->get();
        $feedbackComplain=DB::table('feedback')->where('feedbackType','=', 'Complain')->get();



        $orderItems = OrderItem::with('spare','order')->
            where('order_id', $OrderId)->get();





            return View::make('feedback')->with('orderItems', $orderItems)->with('orders', $orders)->with('orderDate',$orderDate)
                ->with('feedbackComplains',$feedbackComplain)->with('feedbackReviews',$feedbackReview);


        /*if ($request->ajax()){
            $output="";
            $orderItems=DB::table('orderItem')->where ('order_id','=', $request->orderId)->get();
            if($orderItems){
                foreach ($orderItems as $key=>$orderItem){
                    $spare=Spares::find($orderItem->spare_id);
                    $imagepath=$spare->imagePath;
                    $output.='<tr>'.
                        '<td>'.$spare->description.'</td>'.
                        '<td>'.$orderItem->orderStatus.'</td>'.

                        '<td>

                                        <img style="width: 50px;height: 50px;"
                                                        src=\'{{ asset("images/spares/"{$imagepath}")}}\'>
                        
                        </td>'.

                        '<td>

                        </td>' .

                        '<td>  

                                </td>'.
                        '</tr>';
                }

                return response($output);
            }
        }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDate(Request $request)
    {
        $order=Orders::find($request->orderId);
        return response($order->orderDate);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
