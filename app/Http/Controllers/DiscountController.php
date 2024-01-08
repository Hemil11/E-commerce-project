<?php

namespace App\Http\Controllers;

use App\Models\delivery_fee;
use App\Models\discount;
use App\Models\order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::all();
        return view("discount.list", compact("discounts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("discount.create");
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
            "code" => "required|unique:discounts,code",
            "start_date" => "required|date",
            "end_date" => "required|date",
            "limit" => "required",
            "discount" => "required"
        ]);

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if ($start_date->lessThan($end_date)) {

            $discount = new discount;
            $discount->code = $request->code;
            $discount->start_date = $start_date;
            $discount->end_date = $end_date;
            $discount->limit = $request->limit;
            $discount->discount = $request->discount;
            $discount->save();

            return redirect("discount/list");
        } else {
            return back()->withInput()->withErrors(['start_date' => 'Start date must be less than end date']);
        }
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
        $discount = Discount::find($id);
        return view('discount.update', compact('discount'));
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
            "start_date" => "required|date",
            "end_date" => "required|date",
            "limit" => "required|digits_between:1,100",
            "discount" => "required"
        ]);

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        if ($start_date->lessThan($end_date)) {

            $discount = discount::find($request->id);
            $discount->code = $request->code;
            $discount->start_date = $start_date;
            $discount->end_date = $end_date;
            $discount->limit = $request->limit;
            $discount->discount = $request->discount;
            $discount->save();

            return redirect("discount/list");
        } else {
            return back()->withInput()->withErrors(['start_date' => 'Start date must be less than end date']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        $discount->delete();
        return redirect('discount/list');
    }
    
    // discount in totalamount
    public function discountAmount(Request $request)
        {$totalAmount = $request->defaultTotalAmount;
            $conditions = delivery_fee::all(); // Use get() to fetch the conditions
            
            $fee = 0;
            $conditionMet = false;
            
            foreach ($conditions as $condition) {
                switch ($condition->check) {
                    case "=":
                        $conditionMet = ($totalAmount == $condition->start_price);
                        break;
                    case "<":
                        $conditionMet = ($totalAmount < $condition->start_price);
                        break;
                    case ">":
                        $conditionMet = ($totalAmount > $condition->start_price);
                        break;
                }
            
                if (($condition->condition == 'and' && $conditionMet) || ($condition->condition == 'or' && ($conditionMet || $fee == 0))) {

                    $fee = $condition->fees;

                }
            }
            //  dd($fee);
            
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->total_amount = $totalAmount;
            $order->discount = $request->discounts;
            $order->delivery_fee = $fee;    
            $order->is_paid = 0;
            $order->save();
            
            return response()->json(['message' => 'Order created successfully']);
            
    }

}