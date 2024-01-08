<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Created Successfully</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333;
        }

        p {
            color: #555555;
        }

        .signature {
            margin-top: 20px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">

        <h2>Subscription Created Successfully!</h2>

        <p>Dear {{ Auth::user()->name }},</p>
 
        <p>We are excited to inform you that your subscription to Aroma Mart has been successfully created. Welcome to our community!</p>

        <p><strong>Here's what you can look forward to:</strong></p>
        <ul>
            <li>Access to exclusive content and updates</li>
            <li>Engagement in community discussions and events</li>
            <li>Special offers and discounts reserved for our subscribers</li>
        </ul>

        <p>If you have any questions or need assistance, feel free to reach out to us. We're here to make your experience with Aroma Mart enjoyable and rewarding.</p>

        <p>We appreciate your subscription and look forward to providing you with valuable insights and updates.</p>

        <p class="signature">Best regards,<br>
        Aroma Mart<br>
        +91 96225 63225</p>

    </div>
</body>
</html>
