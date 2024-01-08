<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Subscription Cancellation Confirmation</h2>
        <p>Dear , {{ Auth::user()->name }}</p>

        <p>We hope this email finds you well.</p>

        <p>This is to confirm that your subscription with Aroma Mart has been canceled as per your request.</p>

        <strong>Cancellation Details:</strong>
        <ul>
            <li>Subscription ID: {{ $cancellationDetails['subscription_id'] }}</li>
            <li>Cancellation Date: {{ $cancellationDetails['date'] }}</li>
        </ul>

        <p>If you have any questions or if there's anything we can assist you with, please do not hesitate to reach out to our customer support team at <a href="{{ route('user.index') }}">Customer Support</a>&nbsp;/ +91 93625 25622</p>

        <p>We appreciate your time with us and hope to serve you again in the future.</p>

        <p>Thank you for choosing Aroma Mart.</p>

        <footer>
            <p>Best regards, <br><a href="{{ route("user.index") }}">Aroma Mart</a></p>
        </footer>
    </div>
</body>
</html>
