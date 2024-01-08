@extends('layouts.app')

@section('content')
    <a href="{{ route('product.all') }}" class="btn btn-primary"><i class="fa fa-long-arrow-left"></i> Back</a>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalAmount = 0; ?>
            @foreach ($carts as $cart)
                <tr>
                    <th>{{ $cart->id }}</th>
                    <td>{{ $cart->product->name }}</td>
                    <td><img src="{{ asset('product_img/' . $cart->product->image) }}" height="90px" width="90px"
                            class="rounded"></td>
                    <td>
                        <input type="number" name="quantity" class="quantity" value="{{ $cart->quantity }}" min="1"
                            max="100">
                    </td>
                    <td hidden class="price" data-product-price="{{ $cart->product->price }}">{{ $cart->product->price }}
                    </td>
                    <td class="total-amount" data-cart-id="{{ $cart->id }}" data-product-id="{{ $cart->product->id }}">
                        {{ $cart->quantity * $cart->product->price }}</td>
                    <td>
                        <a href="{{ route('cart.delete', ['id' => $cart->id]) }}" class="btn btn-danger">remove</a>
                    </td>
                    <?php $totalAmount += $cart->total_amount; ?>

                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total Amount: ₹<strong id="total_amount">  {{ ($totalAmount) }}</strong></h3>
    
    @if ($totalAmount != 0)
    <a href="{{ route('check.out') }}" class="btn btn-primary m-3 " style="float:right;">CheckOut<i
        class="fa fa-arrow-right" aria-hidden="true"></i></a>
        @endif
    </div>
@endsection

@push('script')
<script>
        $(document).ready(function() {
            $('.quantity').on('input', function() {
                var quantityValue = $(this).val();
                var price = parseFloat($(this).closest('tr').find('.price').data('product-price'));
                var totalAmount = quantityValue * price;
                var cartId = $(this).closest('tr').find('.total-amount').data('cart-id');
                var productId = $(this).closest('tr').find('.total-amount').data('product-id');
                var $this = $(this);
    
                // Update the total amount for the specific product
                $(this).closest('tr').find('.total-amount').text(totalAmount);
    
                // Update the overall total amount for all products
                var newTotalAmount = 0;
                $('.total-amount').each(function() {
                    newTotalAmount += parseFloat($(this).text());
                });
                $('#total_amount').text(newTotalAmount); // Adjust precision as needed
    
                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.update') }}',
                    data: {
                        cart_id: cartId,
                        quantity: quantityValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
@endpush
