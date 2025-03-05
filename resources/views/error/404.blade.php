<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 100px;
            color: #6366F1;
            margin-bottom: 10px;
        }
        p {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }
        a {
            padding: 10px 20px;
            background-color: #6366F1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .illustration {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>The page you are looking for doesn't exist.</p>
    <a href="{{ route('home') }}">Back to home</a>
</body>
</html>
