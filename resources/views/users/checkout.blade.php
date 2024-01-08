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
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalAmount = 0; ?>
            @foreach ($carts as $cart)
                <tr>
                    <td>{{ $cart->id }}</td>
                    <td>{{ $cart->product->name }}</td>
                    <td><img src="{{ asset('product_img/' . $cart->product->image) }}" height="90px" width="90px"
                            class="rounded"></td>
                    <td>{{ $cart->quantity }}</td>
                    <td>{{ $cart->total_amount }}</td>
                    <?php $totalAmount += $cart->total_amount; ?>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total Amount: <strong id="totalAmount">₹. {{ $totalAmount }}</strong></h3>


    {{-- @if ($totalAmount != 0)
        <!-- Add Stripe payment button -->
        <a
        </a>

        <!-- Add Razorpay payment button -->
        <button id="razorpay-btn" class="btn btn-primary btn-block mt-3">
            Pay with Razorpay <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    @endif --}}
    <button type="button" id="discount_button" style="display: block" class="btn btn-primary btn-block float-right  "
        data-bs-toggle="modal" data-bs-target="#discountmodel">
        add discount
    </button>

    <a href="{{ route('order.summery') }}" id="checkout_button" style="display: none" class="btn btn-primary btn-block">Pay Now</a>
    <!-- Modal -->
    <div class="modal fade" id="discountmodel" tabindex="-1" aria-labelledby="discountmodelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discountmodelLabel">Discount Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table" id="copencodesTable">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Coupon Code</th>
                                <th>Discount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>
                                        <input type="radio" name="selected_discount" data-code="{{ $discount->code }}"
                                            data-id="{{ $discount->id }}" data-discount="{{ $discount->discount }}"
                                            class="rowradio">
                                    </td>
                                    <td>{{ $discount->code }}</td>
                                    <td>{{ $discount->discount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSelectedCopencodes">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- <!-- Include Razorpay script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": "{{ $totalAmount * 100 }}",
            "name": "Aroma Mart.",
            "description": "Product Purchase",
            "image": "{{ asset('logo_img/2920771699511860.png') }}",
            "prefill": {
                "name": "Hemil Kumar",
                "email": "gaurav.kumar@example.com",
                "contact": "+919876543210"
            },
            "notes": {
                "note_key_1": "Tea. Earl Grey. Hot",
                "note_key_2": "Make it so."
            },
            "theme": {
                "color": "#3399ca"
            },
            "handler": function(response) {
                // Handle the successful payment response here
                console.log(response);
    
                // Include the CSRF token in the headers
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                // Use AJAX to make a POST request to the success route
                $.ajax({
                    type: 'POST',
                    url: "{{ route('success.razorpay') }}",
                    data: {
                        razorpay_payment_id: response.razorpay_payment_id,

                        // Include any additional data you want to send
                        // response data or other relevant information
                    },
                    success: function(data) {
                        // Handle success if needed
                        console.log(data);
                        // Redirect or perform any other actions as needed
                        // window.location.href = "{{ route('success.razorpay') }}";
                    },
                    error: function(error) {
                        // Handle error if needed
                        console.error(error);
                    }
                });
            }
        };
    
        var razorpay = new Razorpay(options);
    
        document.getElementById('razorpay-btn').onclick = function(e) {
            // Set CSRF token in the options before opening Razorpay
            options.prefill.csrf_token = $('meta[name="csrf-token"]').attr('content');
    
            razorpay.open();
            e.preventDefault();
        };
    </script>
     --}}

    <script>
        $(document).ready(function() {
            var defaultTotalAmount = {{ $totalAmount }};
            var originalTotalAmount = {{ $totalAmount }};
            var discountCount = {{ $discounts->count() }};
            var selectedDiscounts = [];

            if (discountCount !== 0) {
                $("#discountmodel").on("change", ".rowradio", function() {
                    var code = $(this).data('code');
                    var discount = $(this).data('discount');
                    var id = $(this).data('id');

                    // Restore original total amount before applying discount for the new selection
                    restoreOriginalTotal();

                    if ($(this).is(":checked")) {
                        originalTotalAmount -= discount;
                        selectedDiscounts = discount;
                    }

                    // Update the displayed total amount
                    updateTotalAmount();
                });

                $("#saveSelectedCopencodes").on("click", function() {
                    saveSelectedCopencodes(selectedDiscounts, originalTotalAmount, defaultTotalAmount);
                });

                $('#discountmodel').on('hidden.bs.modal', function() {
                    resetModal();
                    $('#checkout-button, #discount-button').prop('disabled', false);

                    setTimeout(function() {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }, 300);
                });

                function resetModal() {
                    $('#copencodesTable .rowradio').prop('checked', false);
                    selectedDiscounts = [];
                }

                function restoreOriginalTotal() {
                    // Restore original total amount
                    originalTotalAmount = defaultTotalAmount;
                }

                function updateTotalAmount() {
                    // Update the displayed total amount
                    $("#totalAmount").text('₹ ' + originalTotalAmount);
                }

                function saveSelectedCopencodes(selectedDiscounts, updatedTotalAmount, defaultTotalAmount) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    console.log(updatedTotalAmount);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('discount.amount') }}",
                        data: JSON.stringify({
                            discounts: selectedDiscounts,
                            updatedTotalAmount: updatedTotalAmount,
                            defaultTotalAmount: defaultTotalAmount
                        }),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log("Data sent successfully:",
                            response); // Log a success message with the response data to the console
                            $("#discount_button").css('display','none'); // Hide the element with the id 'discount_button'
                            $("#checkout_button").css('display','block'); // Show the element with the id 'checkout_button'
                            $("#discountmodel").modal('hide'); // Hide the modal with the id 'discountmodel'
                        },

                        error: function(error) {
                            console.error("Error sending data:", error);
                        }
                    });
                }

            } else {
                $('#discount-button').hide();
                $('#checkout-button').show();
            }
        });
    </script>
@endpush
