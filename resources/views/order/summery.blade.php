@extends('layouts.app')

@push('links')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@500;700;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        /* .container {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                max-width: 450px;
                background: white;
                border-radius: 20px;
                overflow: hidden;
            } */

        .text-content {
            padding: 7%;
            text-align: center;
        }

        .title {
            color: hsl(223, 47%, 23%);
            font-weight: 900;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .text-content p.subtitle {
            color: #8a8a8a;
            margin-bottom: 25px;
        }

        .plan-box {
            background-color: hsl(225, 100%, 98%);
            border-radius: 12px;
            display: flex;
            padding: 25px;
            align-items: center;
            justify-content: space-between;
        }

        .plan-box-left {
            display: flex;
            align-items: center;
            text-align: left;
        }

        .plan-box-left div {
            margin-left: 20px;
        }

        .plan-box-left div h5 {
            font-weight: 900;
            font-size: 15px;
            color: hsl(223, 47%, 23%);
        }

        .plan-box h4 {
            font-weight: 900;
            font-size: 15px;
            color: hsl(223, 47%, 23%);
        }

        .plan-box-left div p {
            font-size: 14px;
            color: #8a8a8a;
        }

        .plan-box a {
            font-weight: 900;
            color: hsl(223, 47%, 23%);
            transition: color .3s ease;
        }

        .plan-box a:hover {
            text-decoration: none;
            color: hsl(245, 75%, 52%);
        }

        a.proceed-btn {
            display: block;
            text-decoration: none;
            color: white;
            background-color: hsl(245, 75%, 52%);
            padding: 20px 0;
            border-radius: 12px;
            margin: 30px 0;
            transition: background-color .3s ease;
        }

        a.proceed-btn:hover {
            background-color: hsl(224, 23%, 55%);
        }

        a.cancel-btn {
            color: hsl(224, 23%, 55%);
            text-decoration: none;
            font-weight: 900;
            transition: color .3s ease;
        }

        a.cancel-btn:hover {
            color: hsl(223, 47%, 23%);
        }

        @media only screen and (max-width: 425px) {
            body {
                background-image: url(https://www.digitshack.com/codepen/mentor1/pattern-background-mobile.svg);
                font-size: 14px;
            }

            .container {
                max-width: 87%;
            }

            .title {
                font-size: 23px;
            }

            div.plan-box {
                padding: 12px;
            }

            .plan-box-left div {
                margin-left: 10px;
            }

            a.proceed-btn,
            a.cancel-btn,
            .plan-box a {
                font-size: 13px;
            }

            .text-content {
                padding: 9% 7%;
            }
        }
    </style>
@endPush
@section('content')
    <a href="{{ route('product.all') }}" class="btn btn-primary"><i class="fa fa-long-arrow-left"></i> Back</a>

    {{-- <!-- Add Stripe payment button -->
        <a href="{{ route('stripe', ['totalamount' => $totalAmount]) }}" class="btn btn-primary btn-block mt-3">
            Pay with Stripe <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </a> --}}

    <!-- Add Razorpay payment button -->
    <button id="razorpay-btn" class="btn btn-primary btn-block mt-3">
        Pay with Razorpay <i class="fa fa-arrow-right" aria-hidden="true"></i></button>

    <div class="container">
        <div class="text-content">
            <h2 class="title">
                Order Summary
            </h2>
            <p class="subtitle">
                You can now listen to millions of songs, audiobooks, and podcasts on any
                device anywhere you like!
            </p>
            <div class="plan-box">
                <div class="plan-box-left">
                    <div>
                        <h5>Amount</h5>
                    </div>
                </div>
                <h4>₹.{{ $order->total_amount }}</h4>
            </div>
            <div class="plan-box">
                <div class="plan-box-left">
                    <div>
                        <h5>Discount</h5>
                    </div>
                </div>
                <h4 style="color: green"><i class="fa fa-minus" aria-hidden="true"></i> ₹.{{ $order->discount }}</h4>
            </div>

            <div class="plan-box">
                <div class="plan-box-left">
                    <div>
                        <h5>Delivery Fee</h5>
                    </div>
                </div>
                <h4 style="color: red"><i class="fa fa-plus" aria-hidden="true"></i> ₹.{{ $order->delivery_fee }}</h4>
            </div>

            <hr width="100%" size="7">
            
            <div class="plan-box">
                <div class="plan-box-left">
                    <div>
                        <h5>Delivery Fee</h5>
                    </div>
                </div>
                {{ $totalAmount = $order->delivery_fee + $order->total_amount - $order->discount }}
                <h4 style="color: green"> ₹.{{ $totalAmount }}</h4>
            </div>

            <a  href="{{ route('stripe', ['totalamount' => $totalAmount]) }}" class="proceed-btn">
                Proceed to Payment ( Pay with Stripe )</a>
            <a href="#" class="cancel-btn">Cancel Order</a>
        </div>
    </div>
@endsection
@push('script')
    <!-- Include Razorpay script -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "name": "Aroma Mart.",
            "description": "Product Purchase",
            "amount": "{{ $totalAmount }}" * 100, // Add a comma here
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
    
    @endpush
