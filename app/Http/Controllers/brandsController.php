<?php

namespace App\Http\Controllers;

use App\Brands;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Http\Requests\BrandDataRequest;

use Illuminate\Support\Facades\Redirect;
use Validator;


class brandsController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("Admin/brand");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/brand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BrandDataRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandDataRequest $request)
    {
       $Brand=new Brands;
        $Brand->brandName=$request->get('brandName');
        $Brand->admin_id=$request->get('admin_id');


        $Brand->save();
        \Session::flash('flash_message','Created Successfully.'); //<--FLASH MESSAGE

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
    public function edit(BrandDataRequest $request)
    {
        $brandName =$request->get('brandName');
        $id=$request->get('modelid');
        DB::update('update brands set brandName = ? where id = ?',[$brandName,$id]);
        \Session::flash('flash_message','Updated Successfully.'); //<--FLASH MESSAGE

        return redirect()->back();
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
         $brand=brands::find($id);
        $brand->delete();
        return Redirect::to('/admin/brand');

    }
}
