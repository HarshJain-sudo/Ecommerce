<?php

namespace App\Http\Controllers;

use App\Category_model;
use foo\bar;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_active=0;
        $categories=Category_model::all();
        return view('backEnd.category.index',compact('menu_active','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_active=2;
        $plucked=Category_model::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        return view('backEnd.category.create',compact('menu_active','cate_levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkCateName(Request $request){
        $data=$request->all();
        $category_name=$data['name'];
        $ch_cate_name_atDB=Category_model::select('name')->where('name',$category_name)->first();
        if($category_name==$ch_cate_name_atDB['name']){
            echo "true"; die();
        }else {
            echo "false"; die();
        }
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name',
            'url'=>'required',
        ]);
        $data=$request->all();
        Category_model::create($data);
        return redirect()->route('category.index')->with('message','Added Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu_active=0;
        $plucked=Category_model::where('parent_id',0)->pluck('name','id');
        $cate_levels=['0'=>'Main Category']+$plucked->all();
        $edit_category=Category_model::findOrFail($id);
        return view('backEnd.category.edit',compact('edit_category','menu_active','cate_levels'));
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
        $update_categories=Category_model::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,name,'.$update_categories->id,
            'url'=>'required',
        ]);
        //dd($request->all());die();
        $input_data=$request->all();
        if(empty($input_data['status'])){
            $input_data['status']=0;
        }
        $update_categories->update($input_data);
        return redirect()->route('category.index')->with('message','Updated Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Category_model::findOrFail($id);
        $delete->delete();
        return redirect()->route('category.index')->with('message','Delete Success!');
    }
}
