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
                            <a href="{{ route('pickups.index') }}" class="btn btn-primary btn-md ">Back</a>
                        </div>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">View-pickup</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <section class="section">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> Name:</span> {{ $pickup->name }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Phone:</span> {{ $pickup->phone }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Email:</span> {{ $pickup->email }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> No Of People:</span>
                                            {{ $pickup->noofpeople }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> Location:</span>
                                            {{ $pickup->location }}
                                        </div>
                                        <div class="col-md-6 col-sm-12 fs-3"> <span> Date:</span>
                                            {{ \Carbon\Carbon::parse($pickup->pickuptime)->format('F j, Y, g:i a') }}
                                        </div>

                                        <div class="col-md-6 col-sm-12 fs-3"> <span>Pickup Status:</span>
                                            {{ $pickup->pickup_status }} </div>

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
