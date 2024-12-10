<html>

<head>
    <title>Pickup Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #3490dc;
        }

        .pickup-details {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .pickup-details ul {
            list-style-type: none;
            padding: 0;
        }

        .pickup-details li {
            margin: 8px 0;
        }

        .pickup-details li strong {
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
    <h1>Pickup Confirmation</h1>
    <p>Dear {{ $pickup->name }},</p>
    <p>Thank you for booking a pickup with us. Below are the details of your booking:</p>

    <div class="pickup-details">
        <ul>
            <li><strong>Name:</strong> {{ $pickup->name }}</li>
            <li><strong>Email:</strong> {{ $pickup->email }}</li>
            <li><strong>Phone:</strong> {{ $pickup->phone }}</li>
            <li><strong>Location:</strong> {{ $pickup->location }}</li>
            <li><strong>Number of People:</strong> {{ $pickup->noofpeople }}</li>
            <li><strong>Pickup Time:</strong> {{ \Carbon\Carbon::parse($pickup->pickuptime)->format('F j, Y, g:i a') }}
            </li>
        </ul>
    </div>

    <p>We look forward to serving you. To confirm your booking, please click the button below:</p>
    <p>This expire within 10 min so Please request again if extra time is taken</p>

    <!-- Confirmation Button -->
    <p>Do you accept or reject the pickup request?</p>

    <p>
        <a href="{{ $acceptUrl }}"
            style="padding: 10px; background-color: green; color: white; text-decoration: none;">Accept</a>
        <a href="{{ $rejectUrl }}"
            style="padding: 10px; background-color: red; color: white; text-decoration: none;">Reject</a>
    </p>

    <p>If you have any questions or need to make changes, feel free to contact us.</p>
    <p>Best regards,<br>Alfanzo Resort Pickup Service Team</p>
</body>

</html>
