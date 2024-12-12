@extends('layouts.main')
@section('container')
    <!-- Page Header Start -->
    @foreach ($settings as $set)
        @if ($set->siteKey == 'Banner')
            <div class="container-fluid page-header mb-5 wow fadeIn"
                style="background: url({{ asset('uploads/' . ($set->siteValue != '' ? $set->siteValue : 'hero.jpg')) }}) top right no-repeat;"
                data-wow-delay="0.1s">
        @endif
    @endforeach
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Bookings</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Bookings</li>
            </ol>
        </nav>
    </div>
    </div>
    <!-- Page Header End -->
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show w-50 m-auto" role="alert">
            {{ Session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <style>
        label,
        input,
        option,
        .form-select,
        textarea {
            color: black !important
        }

        label,
        option {
            text-transform: uppercase
        }
    </style>
    <div class="container">
        <form action="{{ route('booking.book') }}" id="bookingForm" method="POST"
            class="row g-3 needs-validation shadow p-5 my-3" novalidate>
            @csrf
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Booking</h5>
            <h1 class="text-dark text-center mb-4">Book A Room or a Table</h1>
            <div class="col-md-6 col-12">
                <label for="validationCustom01" class="form-label">Name</label>
                <input type="text" class="form-control" id="validationCustom01" name="name"
                    placeholder="Your Full Name" required>
                @error('name')
                    <small>{{ $message }}</small>
                @enderror

            </div>
            <div class="col-md-6 col-12">
                <label for="validationCustom02" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="validationCustom02" name="phone"
                    placeholder="Your Phone Number" required>
                @error('phone')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="validationCustom02" class="form-label">Email</label>
                <input type="email" class="form-control" id="validationCustom02" name="email" placeholder="Your Email"
                    required>
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="validationCustom02" class="form-label">No of People</label>
                <input type="number" class="form-control" id="validationCustom02" name="noofpeople"
                    placeholder="Your Email" required>
                @error('noofpeople')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="spaces">Dining Space / Table</label>
                <select class="form-select" name="spaces" id="spaces" aria-label="Default select example">

                    <option selected value="none">None</option>
                    <option value="Any">Any</option>
                    @foreach ($spaces as $space)
                        <option value="{{ $space->title }}">{{ $space->title }}</option>
                    @endforeach
                </select>
                @error('spaces')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="">Rooms</label>
                <select class="form-select" name="room" id="room" aria-label="Default select example">

                    <option selected value="none">none</option>
                    <option value="Any">Any</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->title }}">{{ $room->title }}</option>
                    @endforeach
                </select>
                @error('room')
                    <small>{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" id="date" placeholder="Booking Date" required
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" max="{{ date('Y-m-d', strtotime('+21 days')) }}">
                @error('date')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">


                <label for="exampleFormControlTextarea1" class="form-label">Special Request</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="specialrequest" rows="2"></textarea>
                @error('specialrequest')
                    <small>{{ $message }}</small>
                @enderror

            </div>
            <div class="col-12">
                <div class="form-check">
                    <label class="form-check-label d-block mb-2" for="pickup">
                        Do you want us to pick you up?
                    </label>

                    <!-- Yes Option -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pickup" id="pickupYes" value="yes"
                            required>
                        <label class="form-check-label" for="pickupYes">
                            Yes
                        </label>
                    </div>

                    <!-- No Option -->
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pickup" id="pickupNo" value="no">
                        <label class="form-check-label" for="pickupNo">
                            No
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>

    </div>
    <!-- Firm Visit Start -->

    <script>
        // Get the datetime input field
        // Get the date input field
        var dateField = document.getElementById('date');

        // Get today's date
        var currentDate = new Date();

        // Calculate minimum and maximum dates
        var minDate = new Date(currentDate);
        minDate.setDate(currentDate.getDate() + 1); // Tomorrow
        var maxDate = new Date(currentDate);
        maxDate.setDate(currentDate.getDate() + 21); // Day after tomorrow

        // Format dates for the 'min' and 'max' attributes (YYYY-MM-DD)
        var minDateString = minDate.toISOString().split('T')[0];
        var maxDateString = maxDate.toISOString().split('T')[0];

        // Set 'min' and 'max' attributes
        dateField.setAttribute('min', minDateString);
        dateField.setAttribute('max', maxDateString);


        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            // Get values of the dropdowns
            const spaces = document.getElementById('spaces').value;
            const room = document.getElementById('room').value;

            // Error elements
            const spacesError = document.getElementById('spacesError');
            const roomError = document.getElementById('roomError');

            // Reset error messages
            spacesError.classList.add('d-none');
            roomError.classList.add('d-none');

            // Validate if both are "none"
            if (spaces == 'none' && room == 'none') {
                e.preventDefault(); // Prevent form submission
                spacesError.classList.remove('d-none');
                roomError.classList.remove('d-none');
            }
        });
    </script>
@endsection
