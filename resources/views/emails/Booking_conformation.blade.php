<html>

<head>
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #3490dc;
        }

        .booking-details {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .booking-details ul {
            list-style-type: none;
            padding: 0;
        }

        .booking-details li {
            margin: 8px 0;
        }

        .booking-details li strong {
            color: #333;
        }

        .confirmation-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .confirmation-button:hover {
            background-color: #2779bd;
        }
    </style>
</head>

<body>
    <h1>Booking Confirmation</h1>
    <p>Dear {{ $booking->name }},</p>
    <p>Thank you for booking with us. Below are the details of your booking:</p>

    <div class="booking-details">
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
            </li>
        </ul>
    </div>

    <!-- Confirmation Button -->
    <p>If you have any questions or need to make changes, feel free to contact us.</p>
    <p>Best regards,<br>Alfanzo Resort Booking Service Team</p>
</body>

</html>
