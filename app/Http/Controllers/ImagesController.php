<?php

namespace App\Http\Controllers;

use App\ImageGallery_model;
use App\Products_model;
use Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
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
        $inputData=$request->all();
        if($request->file('image')){
            $images=$request->file('image');
            foreach ($images as $image){
                if($image->isValid()){
                    $extension=$image->getClientOriginalExtension();
                    $filename=rand(100,999999).time().'.'.$extension;
                    $large_image_path=public_path('products/large/'.$filename);
                    $medium_image_path=public_path('products/medium/'.$filename);
                    $small_image_path=public_path('products/small/'.$filename);
                    //// Resize Images
                    Image::make($image)->save($large_image_path);
                    Image::make($image)->resize(600,600)->save($medium_image_path);
                    Image::make($image)->resize(300,300)->save($small_image_path);
                    $inputData['image']=$filename;
                    ImageGallery_model::create($inputData);
                }
            }
        }
        return back()->with('message','Add Images Successed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu_active =3;
        $product=Products_model::findOrFail($id);
        $imageGalleries=ImageGallery_model::where('products_id',$id)->get();
        return view('backEnd.products.add_images_gallery',compact('menu_active','product','imageGalleries'));
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
        $delete=ImageGallery_model::findOrFail($id);
        $image_large=public_path().'/products/large/'.$delete->image;
        $image_medium=public_path().'/products/medium/'.$delete->image;
        $image_small=public_path().'/products/small/'.$delete->image;
        if($delete->delete()){
            unlink($image_large);
            unlink($image_medium);
            unlink($image_small);
        }
        return back()->with('message','Delete Success!');
    }
}
