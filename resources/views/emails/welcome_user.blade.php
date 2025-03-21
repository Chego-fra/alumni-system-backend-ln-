<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Alumni Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #C3EBFA;
            margin: 0;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: purple;
        }
        p {
            color: #333;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🎉 Welcome, {{ $user->name }}!</h2>
        <p>We are excited to have you as a member of our alumni community.</p>
        <p>Explore our platform, connect with fellow alumni, and stay updated with upcoming events and career opportunities.</p>
        
    </div>
</body>
</html>
