<?php

namespace App\Http\Controllers;

use App\Models\delivery_fee;
use App\Models\order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // show edit page
    public function dashboardEdit(Request $request)
    {
        return view("edit-dashboard");
    }
    // change title name
    public function titleNameChange(Request $request)
    {
        $pageTitle = $request->title;
        $image = $request->file('image');
        $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('logo_img'), $image_name);

        $dashboard = dashboard::where('id', 1)->first();
        if (!$dashboard) {
            $dashboard = new dashboard;
            $dashboard->title = $pageTitle;
            $dashboard->image = $image_name;
            $dashboard->save();
        }
        $dashboard->title = $pageTitle;
        $dashboard->image = $image_name;
        $dashboard->save();
        return redirect('admin/index');
    }
    public function deliveryFee()
    {
        $delivery_fees = delivery_fee::all();
        return view('delivery_fee', compact('delivery_fees'));
    }
    public function deliveryFeeStore(Request $request)
{
    $startPrice = $request->input('start_price');
    $check = $request->input('check');
    $condition = $request->input('condition');
    $fees = $request->input('fees'); // Change 'delivery_fee' to 'fees'

    // dd($startPrice);
    // Assuming the arrays have the same length
    $arrayLength = count($startPrice);
    for ($i = 0; $i < $arrayLength; $i++) {
        $delivery_fee = new delivery_fee();
        $delivery_fee->start_price = $startPrice[$i];
        $delivery_fee->check = $condition[$i];
        $delivery_fee->condition = $check[$i];
        $delivery_fee->fees = $fees[$i]; // Change 'deliveryFee' to 'fees'
        $delivery_fee->save();
    }
}

    public function deliveryFeeDelete(Request $request)
    {
        $delivery_fee = delivery_fee::find($request->id);
        $delivery_fee->delete();
    }
    public function orderSummery(Request $request)
    {
        $user_id = Auth()->user()->id;
        $order = Order::where('user_id', $user_id)->where('is_paid',0)->first();
            return view('order.summery', compact( 'order'));
    }

}