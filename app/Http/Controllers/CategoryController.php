<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('pages.categories',compact('category'));
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
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->created_by=0;
        $category->status=1;   
        $category->save();
        $this->allCategory($category->category_id);
        //return back();
    }

    public function allCategory($selected=0)
    {
        $category = Category::all();
        foreach($category as $item):
            echo '<option '.($selected== $item->category_id?'selected':'').' value="'.$item->category_id.'">'.$item->category_name.'</option>';
        endforeach;
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

    public function closecategory($id)
    {
        $category = Category::where('category_id','=', $id)
                    ->first();
        if(count($category) == 1){
            $category->status = 0;
            $category->save();
        }
        return back(); 
    }

    public function restorecategory($id)
    {
        $category = Category::where('category_id','=', $id)
                    ->first();
        if(count($category) == 1){
            $category->status = 1;
            $category->save();
        }
        return back(); 
    }

}
