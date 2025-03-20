<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Event</title>
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
            color: #CFCEFF;
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
        <h2>📢 New Event: {{ $event->title }}</h2>
        <p><strong>Date:</strong> <span class="highlight">{{ $event->date }}</span></p>
        <p><strong>Location:</strong> <span class="highlight">{{ $event->location }}</span></p>
        <p>{{ $event->description }}</p>
        <p>Don't miss out on this exciting event!</p>
    </div>
</body>
</html>
