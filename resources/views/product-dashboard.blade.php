@extends('layouts.app')
@section('content')
    @if (session('success'))
        <script>
            // You can use a JavaScript library for notifications (e.g., Toastr, SweetAlert) or a simple alert
            alert("{{ session('success') }}");
        </script>
    @endif
    <div class="container main-div d-flex overflow-auto">
        @foreach ($products as $product)
            <div class="container m-4">
                <div class="card border-0 rounded-0 shadow" style="width: 18rem;">
                    <a href="{{ route('single.product', ['id' => $product->id]) }}">
                        <img src="{{ asset('product_img/' . $product->image) }}" height="150px" width="150px"
                        class="card-img-top rounded-0" alt="...">
                    </a>
                        <div class="card-body mt-3 mb-3">
                        <div class="row">
                            <div class="col-10">
                                <h4 class="card-title">{{ $product->name }}</h4>
                                <p class="card-text">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    ({{ $product->quantity }})
                                </p>
                            </div>
                            <div class="col-2">
                                <i class="bi bi-bookmark-plus fs-2"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center text-center g-0">
                        <div class="col-4">
                            <h5>₹{{ $product->price }}</h5>
                        </div>
                        <div class="col-8">
                            <a href="{{ route('cart.add', ['id' => $product->id]) }}"
                                class="btn btn-dark w-100 p-3 rounded-0 text-warning" id="add_to_cart">ADD TO CART</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
