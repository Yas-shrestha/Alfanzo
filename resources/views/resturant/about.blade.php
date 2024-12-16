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
        <h1 class="display-3 mb-3 animated slideInDown">About Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">About Us</li>
            </ol>
        </nav>
    </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class=" container py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100"
                            src="{{ asset('uploads/' . ($about->files->img != '' ? $about->files->img : 'hero.jpg')) }}">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">{{ $about->title }}</h1>
                    <p class="mb-4">{{ $about->description }}</p>
                    @foreach ($aboutFeature as $feature)
                        <p><i class="fa fa-check text-primary me-3"></i>{{ $feature->feature }}</p>
                    @endforeach
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    <div id="pickup">
        <div class="container p-3">
            <form action="{{ route('pickup.store') }}" method="POST">
                @csrf
                <div class="row shadow p-4">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Pickup</h5>
                    <h1 class="text-dark text-center mb-4">Book A Pickup</h1>

                    <div class=" col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">Name</label>
                            <input type="text" class="form-control text-dark" name="name" id=""
                                aria-describedby="helpId" placeholder="Your Full Name" />
                            @error('name')
                                <small class="bg-danger p-2 rounded my-5">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">Email</label>
                            <input type="email" class="form-control text-dark" name="email" id=""
                                aria-describedby="helpId" placeholder="Your Email" />
                            @error('email')
                                <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">Phone</label>
                            <input type="tel" class="form-control text-dark" name="phone" id=""
                                aria-describedby="helpId" placeholder="Your Number" />
                            @error('phone')
                                <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">Location</label>
                            <input type="text" class="form-control text-dark" name="location" id=""
                                aria-describedby="helpId" placeholder="" />
                            @error('location')
                                <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                            @enderror
                            <small id="helpId" class="form-text text-muted">Location must be inside Pokhara</small>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">No of People</label>
                            <input type="number" class="form-control text-dark" name="noofpeople" id=""
                                aria-describedby="helpId" placeholder="" min="1" max="100" value="1" />
                            @error('noofpeople')
                                <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">Pickup Time</label>
                            <input type="datetime-local" class="form-control text-dark" name="pickuptime" id="pickupTime"
                                aria-describedby="helpId" placeholder="" />
                            @error('pickuptime')
                                <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">Pick Me Up <i class="fa fa-smile-o"
                                aria-hidden="true"></i> </button>
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
    <!-- Booking Start -->
    <div class=" bg-icon mt-5 ">
        <div class="container  bg-primary p-5 my-3">

            <div class="p-5 wow fadeInUp text-center " style="background: rgba(0, 0, 0, 0.403)" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Reservation</h5>
                <h1 class="text-white mb-4">Book A Table Online</h1>
                <p>Do you want to Book a table Or would you like to see our dining space or Are You willing For a Pickup</p>
                <a href="/booking" class="btn btn-primary my-2">Book a Table</a>
                <a href="/spaces" class="btn btn-primary my-2">See our dining Spaces</a>
                <a href="#pickups" class="btn btn-primary my-2">Pickup</a>
            </div>

        </div>
    </div>
@endsection
