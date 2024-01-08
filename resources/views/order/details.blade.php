@extends('layouts.app')
@push('links')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif
        }

        #order-heading {
            background-color: #edf4f7;
            position: relative;
            border-top-left-radius: 25px;
            max-width: 800px;
            padding-top: 20px;
            margin: 30px auto 0px
        }

        #order-heading .text-uppercase {
            font-size: 0.9rem;
            color: #777;
            font-weight: 600
        }

        #order-heading .h4 {
            font-weight: 600
        }

        #order-heading .h4+div p {
            font-size: 0.8rem;
            color: #777
        }

        .close {
            padding: 10px 15px;
            background-color: #777;
            border-radius: 50%;
            position: absolute;
            right: -15px;
            top: -20px
        }

        .wrapper {
            padding: 0px 50px 50px;
            max-width: 800px;
            margin: 0px auto 40px;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px
        }

        .table th {
            border-top: none
        }

        .table thead tr.text-uppercase th {
            font-size: 0.8rem;
            padding-left: 0px;
            padding-right: 0px
        }

        .table tbody tr th,
        .table tbody tr td {
            font-size: 0.9rem;
            padding-left: 0px;
            padding-right: 0px;
            padding-bottom: 5px
        }

        .table-responsive {
            height: 100px
        }

        .list div b {
            font-size: 0.8rem
        }

        .list .order-item {
            font-weight: 600;
            color: #6db3ec
        }

        .list:hover {
            background-color: #f4f4f4;
            cursor: pointer;
            border-radius: 5px
        }

        label {
            margin-bottom: 0;
            padding: 0;
            font-weight: 900
        }

        button.css {
            font-size: 0.9rem;
            background-color: #66cdaa
        }

        .price {
            color: #5cb99a;
            font-weight: 700
        }

        p.text-justify {
            font-size: 0.9rem;
            margin: 0
        }

        .row {
            margin: 0px
        }

        .subscriptions {
            border: 1px solid #ddd;
            border-left: 5px solid #ffa500;
            padding: 10px
        }

        .subscriptions div {
            font-size: 0.9rem
        }

        @media(max-width: 425px) {
            .wrapper {
                padding: 20px
            }

            body {
                font-size: 0.85rem
            }

            .subscriptions div {
                padding-left: 5px
            }

            img+label {
                font-size: 0.75rem
            }
        }
    </style>
@endpush

@section('content')
    <div>
        <?php
        $totaldiscount = 0;
        $startDate = \Carbon\Carbon::now(); // Initialize a Carbon instance with the current date
        
        foreach ($orders as $order) {
            $totaldiscount += $order->discount;
            $startDate->addDays($order->created_at->diffInDays()); // Add the number of days from the created_at date
        }
        ?>

        <div class="d-flex flex-column justify-content-center align-items-center" id="order-heading">
            <div class="text-uppercase">
                <p>Order detail</p>
            </div>
            <div class="h4">{{ $startDate->format('l, F d, Y') }}
            </div>
            <div class="pt-1">
                {{-- <p>Order #{{ $order->id }} is currently<b class="text-dark"> Completed</b></p> --}}
            </div>
            <div class="btn close text-white"> &times; </div>
        </div>
        <div class="wrapper bg-white">
            <div class="d-flex justify-content-start align-items-center pl-3">
                <div class="text-muted">Payment Method</div>
                <div class="ml-auto"> <img
                        src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png"
                        alt="" width="30" height="30"> <label>Mastercard ******5342</label> </div>
            </div>
            <div class="d-flex justify-content-start align-items-center py-1 pl-3">
                <div class="text-muted">Shipping</div>
                <div class="ml-auto"> &nbsp;<label>Free</label> </div>
            </div>

            <?php $totalquantity = 0; ?>
            <?php $grandTotal = 0; ?>

            @foreach ($order_details as $order_detail)
                <div class="d-flex justify-content-start align-items-center list py-1">
                    <div><b>{{ $order_detail->qauntity }}Px</b></div>
                    <div class="mx-3">
                        <img src="{{ asset('product_img/' . $order_detail->image) }}" alt="apple" class="rounded-circle"
                            width="30" height="30">
                    </div>
                    <div class="order-item">{{ $order_detail->name }}</div>

                    <?php
                    // Multiply quantity with price for each item and add to the grandTotal
                    $totalForProduct = $order_detail->price * $order_detail->qauntity;
                    $grandTotal += $totalForProduct;

                    ?>
                     <?php $totalquantity += $order_detail->qauntity; ?>
                    <div class="ml-auto ">&nbsp;&nbsp;&nbsp;-₹ {{ $totalForProduct }}</div>
                </div>
            @endforeach
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr class="text-uppercase text-muted">
                            <th scope="col">product</th>
                            <th scope="col" class="text-right">total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">total amount</th>
                            <td class="text-right"><b>₹ {{ $grandTotal }}</b></td>
                        </tr>
                        <tr>
                            <th scope="row">total discount</th>
                            <td class="text-right "><b><div class="ml-auto "> - ₹ {{ $totaldiscount }}</div></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pt-2 border-bottom mb-3"></div>
            <div class="d-flex justify-content-start align-items-center pl-3 py-3 mb-4 border-bottom">
                <div class="text-muted"> Today's Total :</div>
                <div class="ml-auto h5 price"> &nbsp;&nbsp;₹. {{ $grandTotal-$totaldiscount }} </div>
            </div>
            <div class="row border rounded p-1 my-3">
                <div class="col-md-6 py-3">
                    <div class="d-flex flex-column align-items start"> <b>Billing Address</b>
                        <p class="text-justify pt-2">{{ $user->name }} {{ $user->surname }} , {{ $user->address }}</p>
                        <p class="text-justify">{{ $user->country }}</p>
                    </div>
                </div>
                <div class="col-md-6 py-3">
                    <div class="d-flex flex-column align-items start"> <b>Shipping Address</b>
                        <p class="text-justify pt-2">{{ $user->name }} {{ $user->surname }} , {{ $user->address }}</p>
                        <p class="text-justify">{{ $user->country }}</p>
                    </div>
                </div>
            </div>
            <div class="pl-3 font-weight-bold">Related Subsriptions</div>
            <div class="d-sm-flex justify-content-between rounded my-3 subscriptions">
                <div> <b>#9632</b> </div>
                <div>{{ $startDate->format('l, F d, Y') }}
                </div>
                <div>Status: Completed</div>
                <div> Total: <b> ${{ $grandTotal }} for {{ $totalquantity }} item</b> </div>
            </div>
        </div>
    </div>
@endsection
