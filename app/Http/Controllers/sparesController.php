<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Spares;
use App\Models;

use Illuminate\Support\Facades\DB;

class sparesController extends Controller
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
    public function store(Request $request)
    {

            $Spare=new Spares;
            $Spare->model_id=$request->get('modelId');
            $Spare->brand_id=$request->get('brandId');
            $Spare->partNumber=$request->get('partNumber');
            $Spare->warranty=$request->get('warranty');
            $Spare->retailer_id=$request->get('retailerId');
            $Spare->quantity=$request->get('quantity');
            $Spare->price=$request->get('price');
            $Spare->description=$request->get('description');
            $file = $request->file('image');

            // Get the contents of the file
            $contents = $file->openFile()->fread($file->getSize());

            $Spare->image=$contents;

            $Spare->save();
            \Session::flash('flash_message','Added new Spare.'); //<--FLASH MESSAGE

            return redirect()->back();

       /* catch (\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }*/
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

    public function getModels(Request $request)
    {
        $output="";
        $name="";
        $id=$request->get('brandName');
        $models = DB::select('select * from models where brandName = ?', [$id]);
        $output.=

            '<option value=> Select a Model </option>';
        foreach ($models as $key=>$model){
            $id=$model->id;
            $output.=

                '<option value='.$id.'>'.$model->modelName.' ('.$model->yearOfManufacture.') '. '-'.$model->transmissionType.'-'.$model->fuelType.  '</option>';

         }


        return response($output);

    }

    public function getYears(Request $request)
    {
        $output="";
        $year="";
        $id=$request->get('brandName');
        $models = DB::select('select * from models where modelName = ?', [$id]);
         foreach ($models as $key=>$model){
            $year=$model->yearOfManufacture;
            echo $year;

            $output.=

                '<option value='.$year.'>'.$year.  '</option>';

        }


        return response($output);

    }
}
