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
                                    <form action="{{ route('pickup.store') }}" method="POST">
                                        @csrf
                                        <div class="row shadow p-4">
                                            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Pickup
                                            </h5>
                                            <h1 class="text-dark text-center mb-4">Book A Pickup</h1>

                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label text-primary">Name</label>
                                                    <input type="text" class="form-control text-dark" name="name"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Your Full Name" />
                                                    @error('name')
                                                        <small class="bg-danger p-2 rounded my-5">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label text-primary">Email</label>
                                                    <input type="email" class="form-control text-dark" name="email"
                                                        id="" aria-describedby="helpId" placeholder="Your Email" />
                                                    @error('email')
                                                        <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label text-primary">Phone</label>
                                                    <input type="tel" class="form-control text-dark" name="phone"
                                                        id="" aria-describedby="helpId"
                                                        placeholder="Your Number" />
                                                    @error('phone')
                                                        <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label text-primary">Location</label>
                                                    <input type="text" class="form-control text-dark" name="location"
                                                        id="" aria-describedby="helpId" placeholder="" />
                                                    @error('location')
                                                        <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                                                    @enderror
                                                    <small id="helpId" class="form-text text-muted">Location must be
                                                        inside Pokhara</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label text-primary">No of
                                                        People</label>
                                                    <input type="number" class="form-control text-dark" name="noofpeople"
                                                        id="" aria-describedby="helpId" placeholder=""
                                                        min="1" max="100" value="1" />
                                                    @error('noofpeople')
                                                        <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="" class="form-label text-primary">Pickup
                                                        Time</label>
                                                    <input type="datetime-local" class="form-control text-dark"
                                                        name="pickuptime" id="pickupTime" aria-describedby="helpId"
                                                        placeholder="" />
                                                    @error('pickuptime')
                                                        <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary w-50">Pick Me Up <i
                                                        class="fa fa-smile-o" aria-hidden="true"></i> </button>
                                            </div>
                                        </div>
                                        <script>
                                            // Get the current date and time
                                            const now = new Date();

                                            // Format the date to match the "datetime-local" input format
                                            const formattedDate = now.toISOString().slice(0, 16); // "YYYY-MM-DDTHH:MM"

                                            // Set the min attribute dynamically
                                            document.getElementById('pickupTime').min = formattedDate;
                                        </script>
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
