<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\product_variant;
use App\Models\userDetails;
use App\Models\variant;
use App\Models\variant_value;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        $products = Product::with('Category')->get();
        // dd($products->toArray());
        return view("product.list", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $variants = variant::all();

        return view("product.create", compact('categories', 'variants'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->variant == null) {
            $request->validate([
                "name" => 'required',
                "image" => "required",
                "price" => "required",
                "quantity" => "required",
                "categroy_id" => "required",
                "description" => "required",
            ]);
            $image = $request->file('image');
            $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('product_img'), $image_name);

            $product = new product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->image = $image_name;
            $product->save();

        } else {
            if ($request->variant_type == 'single_variant') {
                $request->validate([
                    "name" => 'required',
                    "price" => "required",
                    "quantity" => "required",
                    "image" => "required",
                    "category_id" => "required",
                    "variant_id" => "required",
                    "variant_price" => "required",
                    "description" => "required"
                ]);

                $image = $request->file('image');
                $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('product_img'), $image_name);

                $product = new product;
                $product->name = $request->name;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->category_id = $request->category_id;
                $product->description = $request->description;
                $product->variant_type = $request->variant_type;
                $product->variant_id = $request->variant;
                $product->image = $image_name;
                $product->save();

                $id = $product->id;
                $variant_id = $request->variant;
                $veriant = variant::find($variant_id);

                $variant_value_id = $request->input('variant_id');
                $variant_price = $request->input('variant_price');

                // Assuming the arrays have the same length
                $arrayLength = count($variant_price);
                for ($i = 0; $i < $arrayLength; $i++) {
                    $product_variant = new product_variant;
                    $product_variant->product_id = $id;
                    $product_variant->variant_id = $variant_id;
                    $product_variant->variant_value_id = $variant_value_id[$i];
                    $product_variant->price = $variant_price[$i];
                    $product_variant->save();
                }
            } elseif ($request->variant_type == 'multi_variant') {
                $request->validate([
                    "name" => "required",
                    "price" => "required",
                    "quantity" => "required",
                    "category_id" => "required",
                    "variant" => "required",
                    "variant_type" => "required",
                    "variant_id" => "required",
                    "multi_variant_price" => "required",
                    "description" => "required",
                    "another_variant_id" => "required",
                    "second_another_variant_id" => "required",
                    "image" => "required",
                ]);

                $image = $request->file('image');
                $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();

                $image->move(public_path('product_img'), $image_name);

                $product = new product;
                $product->name = $request->name;
                $product->price = $request->price;
                $product->quantity = $request->quantity;
                $product->category_id = $request->category_id;
                $product->description = $request->description;
                $product->variant_type = $request->variant_type;
                $product->image = $image_name;
                $product->save();

                $id = $product->id;
                $variant_id = $request->variant_id;
                $veriant = variant::find($variant_id);

                $variant_value_id = $request->input('variant_value_id');
                $variant_price = $request->input('multi_variant_price');
                // Assuming the arrays have the same length
                // Assuming the arrays have the same length
                    $product_variant = new product_variant;
                $product_variant->product_id = $id;
                $product_variant->variant_id = json_encode($variant_id); // Accessing specific index
                $product_variant->variant_value_id = json_encode($variant_value_id); // Accessing specific index
                $product_variant->price = $variant_price; // Accessing specific index
                $product_variant->save();

                $arrayLength = count($variant_price);
                for ($i = 0; $i < $arrayLength; $i++) {
                }

            }
        }
        return redirect('product/list');
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
        $product = product::find($id);
        $categories = Category::all();
        $variants = variant::all();
        $variant_values = variant_value::all();
        $product_variants = product_variant::where('product_id', $id)->get();
        return view("product.update", compact("product", "categories", "variants", "product_variants", "variant_values"));

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
        if ($request->variant == null) {
            $request->validate([
                "name" => 'required',
                "image" => "required",
                "price" => "required",
                "quantity" => "required",
                "categroy_id" => "required",
                "description" => "required",
            ]);
            $image = $request->file('image');
            $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('product_img'), $image_name);

            $product = product::find($request->id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->image = $image_name;
            $product->save();

        } else {
            $request->validate([
                "name" => 'required',
                "price" => "required",
                "quantity" => "required",
                "image" => "required",
                "category_id" => "required",
                // "variant_id" => "required",
                // "variant_price" => "required",
                "description" => "required"
            ]);

            $image = $request->file('image');
            $image_name = rand(100000, 999999) . time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('product_img'), $image_name);

            $product = product::find($request->id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->variant_type = $request->variant_type;
            $product->variant_id = $request->variant;
            $product->image = $image_name;
            $product->save();

            $id = $product->id;
            $variant_id = $request->variant;
            $veriant = variant::find($variant_id);

            $variant_value_id = $request->input('variant_id');
            $variant_price = $request->input('variant_price');

            $product_variant_value_id = $request->product_variant_id;
            $test = product_variant::find($product_variant_value_id);

            if (!empty($variant_value_id) && !empty($variant_price)) {
                $arrayLength = count($variant_price);
                for ($i = 0; $i < $arrayLength; $i++) {
                    if (isset($variant_value_id[$i]) && isset($variant_price[$i])) {


                        $product_variant = new product_variant;
                        $product_variant->product_id = $id;
                        $product_variant->variant_id = $variant_id;
                        $product_variant->variant_value_id = $variant_value_id[$i];
                        $product_variant->price = $variant_price[$i];
                        $product_variant->save();
                    }
                }
            } else {
                $arrayLength = count($variant_price);
                for ($i = 0; $i < $arrayLength; $i++) {

                    $product_variant = product_variant::find($product_variant_value_id);
                    $product_variant->product_id = $id;
                    $product_variant->variant_id = $variant_id;
                    $product_variant->variant_value_id = $variant_value_id[$i];
                    $product_variant->price = $variant_price[$i];
                    $product_variant->save();

                }

            }

        }
        return redirect('product/list');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();
        return redirect("product/list");
    }
    public function allProduct(Request $request)
    {
        $products = Product::all();
        return view("product-dashboard", compact("products"));
    }

    // show categroy product only
    public function categoryProduct(Request $request)
    {
        $products = Product::where('category_id', $request->id)->get();
        return view('categroy.product', compact('products'));
    }
    // 
    public function orderSuccess(Request $request)
    {

        $orders = Order::where('user_id', auth()->user()->id)->get();

        $order_details = OrderDetail::where('user_id', auth()->user()->id)
            ->join('products', 'products.id', 'order_details.product_id')
            ->get();
        $user = userDetails::where('user_id', auth()->user()->id)
            ->join('users', 'users.id', 'user_details.user_id')->first();
        return view('order.details', compact('order_details', 'user', 'orders'));
    }
    public function singleProduct(Request $request)
    {

        $product = Product::find($request->id);
        $product_variants = product_variant::where('product_id', $request->id)->first();
        // dd($product->toArray(),$product_variants->toArray());
        return view("single-product", compact('product', 'product_variants'));

    }
    public function variantValue(Request $request)
    {
        if (is_array($request->id)) {
            $ids = $request->id; // No need to cast to array
            
            $variant_values = []; // Initialize an empty array to store results
            
            foreach ($ids as $id) {
                $variant_value = variant_value::where('variant_id', $id)->get();
                $variant_values = array_merge($variant_values, $variant_value->toArray());
            }
            
            return $variant_values;
        } else {
            $variant_value = variant_value::where('variant_id', $request->id)->get();
            return response()->json($variant_value);
        }
        
    }
    public function productVariantDelete(Request $request)
    {
        $id = $request->id;
        $product_variant = product_variant::find($id);
        $product_variant->delete();
        return response()->json(['done']);
    }
}