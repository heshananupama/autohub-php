<?php

namespace App\Http\Controllers;

use App\Message;
use App\OrderItem;
use Illuminate\Http\Request;

use App\Http\Requests\EnquiryDataRequest;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\View;

use App\Enquiries;

 class enquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function store(EnquiryDataRequest $request)
    {

        $user_id = Auth::user()->id;

        $Enquiry=new Enquiries;

        $Enquiry->customer_id=$user_id;
        $Enquiry->message=$request->get('message');
        $Enquiry->contactNo=$request->get('contactNo');
        $Enquiry->save();

        \Session::flash('flash_message','Successfully Sent'); //<--FLASH MESSAGE

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMessages()
    {
        $user_id = Auth::user()->id;
        $data=array();

        $messages = Message::with('customer', 'retailer')
            ->where('user_id', $user_id)->get();
        $orderItem=OrderItem::with('spare','order')->get();


        return View::make('messages')->with('messages', $messages)->with('orderItems',$orderItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
