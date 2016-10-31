<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
        echo 'hello';
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

        foreach ($models as $key=>$model){
            $name=$model->modelName;
            $output.=

                '<option value='.$name.'>'.$model->modelName.  '</option>';

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
