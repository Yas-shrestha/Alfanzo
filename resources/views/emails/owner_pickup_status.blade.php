<!DOCTYPE html>
<html>

<head>
    <title>Pickup Status Notification</title>
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
    <h1>Pickup Status Notification</h1>
    <p>The pickup request has been <strong>{{ $status }}</strong>.</p>
    <div class="details">
        <h2>Pickup Details:</h2>
        <ul>
            <li><strong>Name:</strong> {{ $pickup->name }}</li>
            <li><strong>Email:</strong> {{ $pickup->email }}</li>
            <li><strong>Phone:</strong> {{ $pickup->phone }}</li>
            <li><strong>Location:</strong> {{ $pickup->location }}</li>
            <li><strong>Number of People:</strong> {{ $pickup->noofpeople }}</li>
            <li><strong>Pickup Time:</strong> {{ \Carbon\Carbon::parse($pickup->pickuptime)->format('F j, Y, g:i a') }}
            </li>
            <li><strong>Status:</strong> {{ $status }}</li>
        </ul>
    </div>
    <p>Please Pick up on {{ \Carbon\Carbon::parse($pickup->pickuptime)->format('F j, Y, g:i a') }} </p>
</body>

</html>
