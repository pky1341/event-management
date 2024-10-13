<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3490dc;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Event Reminder</h1>
        </div>
        <div class="content">
            <p>Dear {{ $guest->name }},</p>
            <p>This is a friendly reminder about the upcoming event:</p>
            <h2>{{ $event->title }}</h2>
            <p><strong>Date:</strong> {{ $event->date->format('F j, Y g:i A') }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p>We look forward to seeing you there!</p>
            <p>Best regards,<br>Event Management Team</p>
        </div>
    </div>
</body>
</html>