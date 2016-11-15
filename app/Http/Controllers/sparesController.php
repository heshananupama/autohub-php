<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SpareDataRequest;
use App\Http\Requests;
use App\Spares;
use App\Models;
use App\Brands;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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
    public function store(SpareDataRequest $request)
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
            if($file = $request->hasFile('spareImage')){
                $file = $request->file('spareImage') ;

                $fileName = $file->getClientOriginalName() ;
                $destinationPath = public_path().'/images/' ;
                $file->move($destinationPath,$fileName);
                $Spare->imagePath = $fileName ;

            }

            // Get the contents of the file
//            $contents = $file->openFile()->fread($file->getSize());
//
//            $Spare->image=$contents;

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
    public function edit(SpareDataRequest $request)
    {
        $id=$request->get('id');
        $model_id=$request->get('modelId');
        $brand_id=$request->get('brandId');
        $partNumber=$request->get('partNumber');
        $warranty=$request->get('warranty');
        $quantity=$request->get('quantity');
        $price=$request->get('price');
        $description=$request->get('description');
        if($file = $request->hasFile('spareImage')){
            $file = $request->file('spareImage') ;

            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/images/' ;
            $file->move($destinationPath,$fileName);
            $imagePath = $fileName ;

        }
        DB::update("update spares 
        set partNumber = '$partNumber' , quantity='$quantity', imagePath='$imagePath'  , price='$price'  , quantity= '$quantity' , warranty= '$warranty' , description='$description'  , brand_id='$brand_id',model_id='$model_id'   where id = $id");
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
        $spare=Spares::find($id);
        $spare->delete();
        return Redirect::to('/retailer/spares');
    }
    public function load()
    {

       /*return View::make('Retailer/spares')
           ->with (compact('models'))
           ->with(compact('brands'))
           ->with(compact('spares'));*/
/*      $models = \App\Models::with('models')->get();*/
        $brands=\App\Brands::all();
        $models=\App\Models::all();
        //$spares=\App\Spares::all();
        $spares = \App\Spares::with('brand','model')->get();


        /*        $spares=\App\Spares::with('spares')->get();*/
        return view('Retailer/spares',  compact('brands','models','spares'));



    }
    public function getModels(Request $request)
    {
        $output="";
        $name="";
        $id=$request->get('brandName');
        $models = DB::select('select * from models where brandName = ? order by modelName', [$id]) ;
        $output.=

            '<option value=> Select a Model </option>';
        foreach ($models as $key=>$model){
            $id=$model->id;
            $output.=

                '<option value='.$id.'>'.$model->modelName.' ('.$model->yearOfManufacture.') '. '-'.$model->transmissionType.'-'.$model->fuelType.'-'.$model->engineCapacity.   '</option>';

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
