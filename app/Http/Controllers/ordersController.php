<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Spares;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\OrderItem;
use Illuminate\Support\Facades\View;
use App;
use DB;

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

        $orders=App\Orders::where('user_id', $user_id)
            ->get();



        return View::make('feedback')->with('orders', $orders);
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

        $orders=App\Orders::where('user_id', $user_id)
            ->get();

        $orderItems = OrderItem::with('spare')->
            where('order_id', $OrderId)->get();





            return View::make('feedback')->with('orderItems', $orderItems)->with('orders', $orders);


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
