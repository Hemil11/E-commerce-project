<?php

namespace App\Http\Controllers;

use App\Models\variant;
use App\Models\variant_value;
use Illuminate\Http\Request;

class VeriantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veriants = variant::all();
        return view("veriant.list", compact('veriants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('veriant.create');
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
            "name" => "required"
        ]);

        $veriant = new variant;
        $veriant->name = $request->name;
        $veriant->status = $request->status;
        $veriant->save();

        return redirect('variant/list');

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
    public function edit(Request $request)
    {



        $id = $request->id;
        $veriant = variant::find($id);
        return view("veriant.update", compact('veriant'));
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
        $request->validate([
            "name" => "required"
        ]);
        $id = $request->id;
        $veriant = variant::find($id);
        $veriant->name = $request->name;
        $veriant->status = $request->status;
        $veriant->save();

        return redirect('variant/list');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $veriant = variant::find($id);
        $veriant->delete();

        return back();

    }
    public function valuecreate(Request $request)
    {
        $id = $request->id;
        $variant = variant::find($id);
        $variant_values = variant_value::where('variant_id', $variant->id)->get();

        return view('veriant.value.create', compact('variant', 'variant_values'));

    }
    public function valuestore(Request $request)
    {
        $id = $request->id;
        $veriant = variant::find($id);

        $variant_id = $request->input('id');
        $value = $request->input('value');

        // Assuming the arrays have the same length
        $arrayLength = count($value);
        for ($i = 0; $i < $arrayLength; $i++) {
            $variant_value = new variant_value;
            $variant_value->variant_id = $variant_id;
            $variant_value->name = $value[$i];
            $variant_value->save();
        }

    }
    public function valuedelete(Request $request)
    {
        $id = $request->id;
        $variant_value = variant_value::find($id);
        $variant_value->delete();
    }
    public function Productstore(Request $request)
    {
        $id = $request->id;
        $variant_value = variant_value::find($id);
        $variant_value->delete();
    }

}