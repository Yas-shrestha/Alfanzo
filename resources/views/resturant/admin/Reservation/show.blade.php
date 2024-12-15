@extends('resturant.admin.inc.main')
@section('main-container')
    <style>
        .col-sm-12.fs-3 span {
            color: #c19a6b;
            width: 200px
        }
    </style>
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="pagetitle">
                        <div class="d-flex justify-content-between">
                            <h1>View</h1>
                            <a href="{{ route('reservation.index') }}" class="btn btn-primary btn-md ">Back</a>
                        </div>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">View-reservation</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <section class="section">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> Name:</span> {{ $reservation->name }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Phone:</span> {{ $reservation->phone }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Email:</span> {{ $reservation->email }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> No Of People:</span>
                                            {{ $reservation->noofpeople }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Spaces:</span>
                                            {{ $reservation->spaces }} </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> Room:</span> {{ $reservation->room }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> Date:</span> {{ $reservation->date }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Pickup:</span>
                                            {{ $reservation->pickup }} </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Reservation Status:</span>
                                            {{ $reservation->reservation_status }} </div>
                                        <div class="col-sm-12 fs-3"> <span> Special Request:</span>
                                            {{ $reservation->specialRequest }} </div>
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
