<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Alumni Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F1F0FF;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #EDF9FD;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #CFCEFF;
        }
        p {
            color: #333;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            background-color: #C3EBFA;
            padding: 10px 20px;
            text-align: center;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
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
