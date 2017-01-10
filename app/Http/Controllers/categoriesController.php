<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Categories;
use App\Http\Requests\CategoryDataRequest;
use Illuminate\Support\Facades\DB;

class categoriesController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryDataRequest $request)
    {
        try {
            $Category = new Categories;
            $Category->categoryName = $request->get('categoryName');
            $Category->admin_id = $request->get('admin_id');

            $Category->save();
            \Session::flash('flash_message', 'Added new Category.'); //<--FLASH MESSAGE

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $categories = DB::table('categories')->where('categoryName', 'LIKE', '%' . $request->search . '%')
                ->orWhere('categoryName', 'LIKE', '%' . $request->search . '%')->get();
            if ($categories) {
                foreach ($categories as $key => $category) {
                    $output .= '<tr>' .
                        '<td>' . $category->id . '</td>' .

                        '<td>' . $category->categoryName . '</td>' .

                        '<td>

                                    <a class=" btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit"  >Edit </a>

                                    <a class=" btn btn-danger btn-sm" href="" >Delete </a>

                                </td>' .
                        '</tr>';
                }

                return response($output);
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryDataRequest $request)
    {
        $categoryName = $request->get('categoryName');
        $id = $request->get('categoryId');
        error_log($id);

        DB::update("update categories 
        set categoryName = '$categoryName'  where id = $id");
        \Session::flash('flash_message', 'Updated Successfully.'); //<--FLASH MESSAGE

        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = categories::find($id);
            $category->delete();
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $ex) {
            dd($ex->getMessage());
            // Note any method of class PDOException can be called on $ex.
        }

    }
}
