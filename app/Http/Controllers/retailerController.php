<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use App\User;
use App\Retailer;
use App\Http\Requests\RegisterRetailerDataRequest;

class retailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        //
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
