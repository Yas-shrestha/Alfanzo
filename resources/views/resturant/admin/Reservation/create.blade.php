@extends('resturant.admin.inc.main')
@section('main-container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="pagetitle">
                        <div class="d-flex justify-content-between">
                            <h1>Create</h1>
                            <a href="{{ route('reservation.index') }}" class="btn btn-primary btn-md "><i class="fa fa-bars"
                                    aria-hidden="true"></i></a>
                        </div>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">Add-reservation</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <section class="section">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('booking.book') }}" id="bookingForm" method="POST"
                                        class="row g-3 needs-validation " novalidate>
                                        @csrf
                                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Booking
                                        </h5>
                                        <h1 class="text-dark text-center mb-4">Book A Room or a Table</h1>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom01" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                name="name" placeholder="Your Full Name" required>
                                            @error('name')
                                                <small>{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom02" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control" id="validationCustom02"
                                                name="phone" placeholder="Your Phone Number" required>
                                            @error('phone')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom02" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="validationCustom02"
                                                name="email" placeholder="Your Email" required>
                                            @error('email')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="validationCustom02" class="form-label">No of People</label>
                                            <input type="number" class="form-control" id="validationCustom02"
                                                name="noofpeople" placeholder="Your Email" required>
                                            @error('noofpeople')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="spaces">Dining Space / Table</label>
                                            <select class="form-select" name="spaces" id="spaces"
                                                aria-label="Default select example">

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
                                            <select class="form-select" name="room" id="room"
                                                aria-label="Default select example">

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
                                            <input type="date" name="date" class="form-control" id="date"
                                                placeholder="Booking Date" required
                                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                max="{{ date('Y-m-d', strtotime('+21 days')) }}">
                                            @error('date')
                                                <small>{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="exampleFormControlTextarea1" class="form-label">Special
                                                Request</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="specialrequest" rows="2"></textarea>
                                            @error('specialrequest')
                                                <small>{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <label class="form-check-label d-block mb-2" for="pickup">
                                                    Did they want pick up?
                                                </label>

                                                <!-- Yes Option -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pickup"
                                                        id="pickupYes" value="yes" required>
                                                    <label class="form-check-label" for="pickupYes">
                                                        Yes
                                                    </label>
                                                </div>

                                                <!-- No Option -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="pickup"
                                                        id="pickupNo" value="no">
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
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </main>
    <script>
        function firstFunction() {
            var x = document.querySelector('input[name=img]:checked').value;
            document.getElementById('imagebox').value = x;
        }
    </script>
@endsection
