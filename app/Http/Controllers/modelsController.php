<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ModelDataRequest;

use App\Models;
use Illuminate\Support\Facades\DB;

class modelsController extends Controller
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
    public function store(ModelDataRequest $request)
    {

        try{
            $Model=new Models;
            $Model->modelName=$request->get('modelName');
            $Model->transmissionType=$request->get('transmissionType');
            $Model->fuelType=$request->get('fuelType');
            $Model->engineCapacity=$request->get('engineCapacity');

            $Model->countryMade=$request->get('country');
            $Model->admin_id=$request->get('admin_id');
            $Model->brandName=$request->get('brandName');
            $Model->yearOfManufacture=$request->get('year');



            $Model->save();
            \Session::flash('flash_message','Added new Model.'); //<--FLASH MESSAGE

            return redirect()->back();
        }
        catch (\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $output="";

        if ($request->ajax()){
            $models=DB::table('models')->where ('modelName','LIKE','%'.$request->search.'%')
                ->orWhere('brandName','LIKE','%'.$request->search.'%')->get();
            if($models){
                foreach ($models as $key=>$model){
                    $Mid=$model->id;
                    $output.='<tr>'.
                        '<td>'.$model->id.'</td>'.

                        '<td>'.$model->modelName.'</td>'.
                    '<td>'.$model->brandName.'</td>'.
                        '<td>'.$model->transmissionType.'</td>'.

                        '<td>'.$model->fuelType.'</td>'.
                        '<td>'.$model->engineCapacity.'</td>'.

                        '<td>'.$model->yearOfManufacture.'</td>'.

                        '<td>'.$model->countryMade.'</td>'.
                        '<td>

                                    <a class=" btn btn-success btn-sm" onclick="EditModel('.$model->id.',\''.$model->modelName.'\',\''.$model->brandName.'\',
                                             \''.$model->transmissionType.'\',\''.$model->fuelType.'\' ,\''.$model->yearOfManufacture.'\', \''.$model->countryMade.'\')" >Edit </a>

                                    <a onclick="DeleteModel('.$model->id.')"  class=" btn btn-danger btn-sm"  >Delete </a>

                                </td>'.
                    '</tr>';
                }

            }

        }
        return response($output);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelDataRequest $request)
    {
        $brandName =$request->get('brandName');
        $modelName =$request->get('modelName');
        $transmissionType = $request->get('transmissionType');
        $fuelType = $request->get('fuelType');
        $engineCapacity = $request->get('engineCapacity');

        $country = $request->get('country');
        $year = $request->get('year');
        $id= $request->get('modelId');
        error_log($id);

        DB::update("update models 
        set brandName = '$brandName' , modelName='$modelName' , transmissionType='$transmissionType'  , fuelType= '$fuelType' , engineCapacity= '$engineCapacity' , countryMade='$country' , yearOfManufacture = '$year'  where id = $id");
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
        $model=models::find($id);
        $model->delete();
        return redirect()->back();
    }


}
