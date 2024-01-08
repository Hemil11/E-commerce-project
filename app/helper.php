<?php

use App\Models\Cart;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;

if (!function_exists('title')) {
    function title()
    {
        $dashboard = Dashboard::find(1);
        if(!$dashboard)
        {
            $dashboard = "test";
            return $dashboard;
        }
        return $dashboard->title;
        
    }
}

if (!function_exists('logoImage')) {
    function logoImage()
    {
        $dashboard = Dashboard::find(1);
        if(!$dashboard)
        {
            $dashboard = "test.png";
            return $dashboard;
        }
        return $dashboard->image;
    }
}

if (!function_exists('countOfCart')) {
    function countOfCart()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $cartCount = Cart::where('user_id', $user_id)->where('status', 0)->count();
            return $cartCount;
        }

        return 0;
    }
}
