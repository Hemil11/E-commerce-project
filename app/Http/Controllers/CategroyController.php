<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategroyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view("categroy.list", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categroy.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "image" => "required|image|mimes:jpeg,png,jpg,gif|max:2048", 
        ]);

        $image = $request->file('image');
        $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('category_img'), $image_name);

        $category = new Category;
        $category->name = $request->name;
        $category->image = $image_name; 
        $category->save();

        return redirect('categroy/list');
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
        $category = category::find($id);
        return view("categroy.update", compact("category"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image = $request->file('image');
        $image_name = rand(100000, 999999).time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('category_img'), $image_name);

        $category = category::find($request->id);
        $category->name = $request->name;
        $category->image = $image_name;
        $category->save();
        return redirect("categroy/list");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categroy = Category::find($id);
        $categroy->delete();
        return redirect("categroy/list");
    }
}
