<!DOCTYPE html>
<html>

<head>
    <title>Booking Status Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .details {
            margin-top: 20px;
        }

        .details ul {
            list-style-type: none;
            padding: 0;
        }

        .details ul li {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <h1>Booking Status Notification</h1>
    <div class="details">
        <h2>Booking Details:</h2>
        <ul>
            <li><strong>Pickup:</strong> {{ $booking->pickup }}</li>
            <h2> Details</h2>
            <li><strong>Name:</strong> {{ $booking->name }}</li>
            <li><strong>Email:</strong> {{ $booking->email }}</li>
            <li><strong>Phone:</strong> {{ $booking->phone }}</li>
            <li><strong>Spaces:</strong> {{ $booking->spaces }}</li>
            <li><strong>Room:</strong> {{ $booking->room }}</li>
            <li><strong>Date:</strong> {{ $booking->date }}</li>
            <li><strong>Number of People:</strong> {{ $booking->noofpeople }}</li>
            <li><strong>Booking Time:</strong>
                {{ \Carbon\Carbon::parse($booking->date)->format('F j, Y') }}
            </li>
            <li><strong>Specialrequest:</strong> {{ $booking->specialrequest }}</li>
        </ul>
    </div>
</body>

</html>
