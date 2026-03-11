<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: sans-serif;
            text-align: center;
        }
        .error-box {
            border: 1px solid #333;
            padding: 40px;
            background: #111;
            border-radius: 10px;
        }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="error-box">
        <h2>⚠️ Stream Unavailable</h2>
        <p>The streaming server is not responding right now.</p>
        <p>Please try again in a few minutes.</p>
        <p><a href="javascript:window.location.reload(true)">Retry Connection</a></p>
    </div>
</body>
</html>