<!DOCTYPE html>
<html>
<head>
    <title>New Job Opportunity</title>
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
        }
        h2 {
            color: black;
            text-align: center;
        }
        p {
            color: #333;
            line-height: 1.5;
        }
        .highlight {
            background-color: #FAE27C;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .button {
            display: block;
            width: max-content;
            background-color: #C3EBFA;
            padding: 10px 20px;
            text-align: center;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>💼 New Job Available: {{ $career->title }}</h2>
        <p><strong>Company:</strong> <span class="highlight">{{ $career->company }}</span></p>
        <p><strong>Location:</strong> <span class="highlight">{{ $career->location }}</span></p>
        <p>{{ $career->description }}</p>
        <p><strong>Requirements:</strong></p>
        <p>{{ $career->requirements }}</p>
        <p>📅 Posted on: <span class="highlight">{{ $career->date_posted }}</span></p>
    </div>
</body>
</html>
