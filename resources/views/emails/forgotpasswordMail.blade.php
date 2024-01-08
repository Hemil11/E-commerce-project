<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #555555;
        }
        .btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-align: center;
    text-decoration: none;
    background-color: #007bff;
    color: #ffffff;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

        
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ asset('logo_img/1076461699509923.png') }}" alt="Company Logo" width="150">
        <h1>Password Reset</h1>
        <p>We noticed that you recently requested to reset your password for your Aroma Mart account.</p>
        <p>To complete the process, please use the following verification link:</p>
        <a href="{{ route('change.password.page',['email'=>$details['email']]) }}" class="btn">Reset Your Password Now</a>
        <p>If you didn't request a password reset, please ignore this email or contact our support team at <a href="mailto:[Your Support Email]">xyz@gmail.com</a> immediately.</p>
        <p>Thank you for choosing Aroma Mart!</p>
    </div>
</body>

</html>
