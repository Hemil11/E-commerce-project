<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>

    <!-- Add some basic styling for better presentation -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 20px;
        }

        h1, h2, p {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order. We appreciate your business!</p>

    @if(isset($orderDetails) && is_array($orderDetails) && count($orderDetails) > 0)
        <h2>Order Details:</h2>
        <ul>
            @foreach($orderDetails as $order)
                <li>
                    <strong>Product:</strong> {{ $order['product_name'] }}<br>
                    <strong>Quantity:</strong> {{ $order['quantity'] }}<br>
                    <!-- Add more fields as needed -->
                </li>
            @endforeach
        </ul>
    @else
        <p>No order details available.</p>
    @endif

    <p>For any questions or concerns, please contact our customer support.</p>

    <hr>

    <p>This is an automated email. Please do not reply.</p>
</body>
</html>
