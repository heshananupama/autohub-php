<?php

namespace App\Http\Controllers;

use App\Brands;
use App\Categories;
use App\Http\Middleware\Retailer;
use App\Models;
use App\Retailers;
use App\Spares;
use App\User;
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
    public function show(Request $request)
    {
        if ($request->ajax()){
            $output="";
            $brands=DB::table('brands')->where ('brandName','LIKE','%'.$request->search.'%')
                ->orWhere('brandName','LIKE','%'.$request->search.'%')->get();
            return response($brands);
            /*if($brands){
                foreach ($brands as $key=>$brand){
                    $output.='<tr>'.
                        '<td>'.$brand->id.'</td>'.

                        '<td>'.$brand->brandName.'</td>'.

                        '<td>

                                    <a class=" btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit"  >Edit </a>

                                    <a class=" btn btn-danger btn-sm" href="" >Delete </a>

                                </td>'.
                        '</tr>';
                }

                return response($output);
            }*/
        }

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
        $id=$request->get('id');
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

        try {
            $brand=Brands::find($id);
            $brand->delete();
            return Redirect::to('/admin/brand');
        } catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
            // Note any method of class PDOException can be called on $ex.
        }


    }

    public function destroyRetailer($id)
    {
        $userRetailer=DB::table('retailers')->where('id', '=',$id )->first();
         $userId=$userRetailer->user_id;

        $retailer=Retailers::find($id);
        $retailer->delete();
        $user=User::find($userId);
        $user->delete();
        return Redirect::to('/admin/retailer');

    }
    public function loadHome(){
        $categories=Categories::all();
        $categoryCount=$categories->count();

        $spares=Spares::all();
        $spareCount=$spares->count();
         $models=Models::all();
        $modelCount=$models->count();

        $brands=Brands::all();
        $brandCount=$brands->count();


        $customers=User::where('type','c');
        $customerCount=$customers->count();

        $retailers=User::where('type','r');
        $retailerCount=$retailers->count();

        return view('Admin/admin')->with('customerCount',$customerCount)->with('retailerCount',$retailerCount)->with('brandCount',$brandCount)->with('modelCount',$modelCount)->with('categoryCount',$categoryCount)->with('sparesCount',$spareCount)->with('customerCount',$customerCount);
    }
}
