<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::where('user_type', '2')->get();
        return view("user.list", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => "required",
            "email" => "required|email|unique:users,email",
            "image" => 'required',
            "password" => "required",
            "mo_no" => 'digits:10',
            "gender" => "required",
        ]);

        $image = $request->file('image');
        $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('user_img'), $image_name);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->image = $image_name;
        $user->mo_no = $request->mo_no;
        $user->save();

        $userdetail = new userDetails;
        $userdetail->user_id = $user->id;
        $userdetail->save();


        return redirect('user/list');
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
        $user = User::find($id);
        return view('user.update', compact('user'));
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
            'name' => "required",
            "mo_no" => 'digits:10',
            "gender" => "required",
        ]);

        $user = User::find($request->id);

        $image_name = $user->image;

        if ($request->image) {
            $image = $request->file('image');
            $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('user_img'), $image_name);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->image = $image_name;
        $user->mo_no = $request->mo_no;
        $user->save();
        return redirect('user/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back();
    }
    public function deatils()
    {
        $user = auth()->user();
        $user_detail = userDetails::where('user_id',$user->id)->first();
        if ($user_detail == null) {
            return view('user.main-details', compact('user'));
        }
        return view('user.all-details', compact('user','user_detail'));
        
    }
    public function updateDeatils(Request $request)
    {
        $user = Auth::user();
        $image_name = $user->image;

        if ($request->image) {
            $image = $request->file('image');
            $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('user_img'), $image_name);
        }

        $user = User::find($user->id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->mo_no = $request->mo_no;
        $user->image = $image_name;
        $user->gender = $request->gender;
        $user->save();

        $user_details = userDetails::where('user_id', $user->id)->first();
        if ($user_details) {
            $user_details->user_id = $user->id;
            $user_details->birth_date = Carbon::parse($request->birth_date)->format('Y-m-d H:i:s');
            $user_details->address = $request->address;
            $user_details->city = $request->city;
            $user_details->country = $request->country;
            $user_details->postal_code = $request->postal_code;
            $user_details->save();
        } else {
            $user_details = new userDetails;
            $user_details->user_id = $user->id;
            $user_details->birth_date = $request->birth_date;
            $user_details->address = $request->address;
            $user_details->city = $request->city;
            $user_details->country = $request->country;
            $user_details->postal_code = $request->postal_code;
            $user_details->save();
        }
        return back();

    }
}
