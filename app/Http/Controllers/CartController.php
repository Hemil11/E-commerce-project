<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // add product to cart 
    public function addToCart(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        $product = Product::find($id);
        $cart_product = $carts->where("product_id", $id)->first();

        if ($cart_product == null || $cart_product->status == 1) {
            // Create a new cart entry
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $id;
            $cart->quantity = 1;
            $cart->total_amount = $cart->quantity * $product->price;
            $cart->save();
        } elseif ($cart_product->product_id == $id && $cart_product->status == 0) {
            // Increase quantity for existing cart entry
            $cart_product->quantity += 1;
            $cart_product->total_amount = $cart_product->quantity * $product->price;
            $cart_product->save();
        } elseif ($cart_product->product_id != $id) {
            // Create a new cart entry for a different product
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->product_id = $id;
            $cart->quantity = 1;
            $cart->total_amount = $cart->quantity * $product->price;
            $cart->save();
        }

        return redirect('add/to/cart');
    }
    public function addToCartPage(Request $request)
    {
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->where('status', 0)
            ->get();

        $product = Cart::join('products', 'carts.product_id', '=', 'products.id')->get();
        return view('add_to_cart', compact('carts', 'product'));
    }

    public function updateCart(Request $request)
    {
        $cartId = $request->cart_id;
        $quantity = $request->quantity;

        $cart = Cart::find($cartId);
        $cart->quantity = $quantity;
        $cart->total_amount = $cart->product->price * $quantity;
        $cart->save();

        return response()->json(['success' => true]);
    }
    public function deleteCart(Request $request)
    {
        $cartId = $request->id;
        $cart = Cart::find($cartId)->delete();

        return back();
    }
}
