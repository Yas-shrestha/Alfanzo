@extends('layouts.main')
@section('container')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($carousels as $key => $carousel)
                    <div class="carousel-item  {{ $key == 0 ? 'active' : '' }}">
                        <div class="image-container"
                            style="position: relative; width: 100%; height: 100vh; overflow: hidden;">
                            <img class="w-100" src="{{ asset('uploads/' . $carousel->files->img) }}" alt="Image"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="overlay"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5);">
                            </div>
                        </div>
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7">
                                        <h1 class="display-2 mb-5 animated slideInDown text-white">{{ $carousel->title }}
                                        </h1>
                                        <a href="#pickup" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Book
                                            Pickup</a>
                                        <a href="{{ route('booking') }}"
                                            class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Book a Table</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100"
                            src="{{ asset('uploads/' . ($about->files->img != '' ? $about->files->img : 'hero.jpg')) }}">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn text-dark" data-wow-delay="0.5s">
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
                                aria-describedby="helpId" placeholder="" min="1" max="100"
                                value="1" />
                            @error('noofpeople')
                                <small class="bg-danger p-2 rounded my-3">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="mb-3">
                            <label for="" class="form-label text-primary">Pickup Time</label>
                            <input type="datetime-local" class="form-control text-dark" name="pickuptime"
                                id="pickupTime" aria-describedby="helpId" placeholder="" />
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

    <!-- Team Start -->
    @if (count($teams))
        <div class="container-fluid bg-light bg-icon py-6">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Team Members</h5>
                    <h1 class="mb-5">Our Master Chefs</h1>
                </div>
                <div class="row g-4">
                    @foreach ($teams as $team)
                        <div class="col-lg-3 col-md-6 wow fadeInUp  rounded " data-wow-delay="0.1s"
                            style="border-radius: 25px">
                            <div class="team-item text-center rounded bg-white overflow-hidden pb-2">
                                <div class="rounded overflow-hidden m-4 ">
                                    <img class="img-fluid rounded" src="{{ asset('uploads/' . $team->files->img) }}"
                                        alt="" data-bs-toggle="modal"
                                        data-bs-target="#teamID{{ $team->id }}"
                                        style="cursor: pointer;
                            height:10rem;">
                                </div>
                                <h5 class="mb-0" data-bs-toggle="modal" data-bs-target="#teamID{{ $team->id }}"
                                    style="cursor: pointer">{{ $team->name }}</h5>
                                <small>{{ $team->post }}</small>
                                <div class="d-flex justify-content-center mt-3">
                                    <a class="btn btn-square btn-primary mx-1" href="{{ $team->facebook }}"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href="{{ $team->twitter }}"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary mx-1" href="{{ $team->instagram }}"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="teamID{{ $team->id }}" tabindex="-1" data-bs-backdrop="static"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">About {{ $team->name }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6"><img class="img-fluid w-100"
                                                    src="{{ asset('uploads/' . $team->files->img) }}" alt="">
                                            </div>
                                            <div class="col-6">
                                                <div class="border border-primary p-2 rounded-3">
                                                    <h3>Name: <span>{{ $team->name }} </span></h3>
                                                    <h3>Qualification: <span>{{ $team->qualification }} </span></h3>
                                                    <h3>Post: <span>{{ $team->post }} </span></h3>
                                                </div>
                                                <div>
                                                    <p class=" text-justify fs-5 text-dark">{{ $team->description }}</p>
                                                    <p class="text-justify fs-5 text-dark">{{ $team->sub_description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Team End -->

    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show w-50 m-auto" role="alert">
            {{ Session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Product Start -->

    @if (count($foods))
        <div class="container py-5">
            <div class="container">

                <div class="row g-0 gx-5 align-items-end">
                    <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
                        style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Our Foods</h1>

                    </div>
                </div>
                <div class="tab-content">
                    <div id="Foods" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($foods as $food)
                                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="product-item rounded-3">
                                        <div class="position-relative bg-light overflow-hidden">
                                            <img class="img-fluid w-100 rounded-3"
                                                src="{{ asset('uploads/' . $food->files->img) }}" alt=""
                                                style="height: 200px ; object-fit:cover ">
                                        </div>
                                        <div class="text-center p-4">
                                            <a class="d-block h5 mb-2" href="">{{ $food->name }}</a>
                                            <span class="text-primary me-1">Rs{{ $food->price }}</span>

                                        </div>

                                        <div class=" border-top text-center">
                                            <small class="w-50   border-en py-2" data-bs-toggle="modal"
                                                data-bs-target="#foodModallId{{ $food->id }}">
                                                <a class="text-primary " href="" data-bs-toggle="modal"
                                                    data-bs-target="#foodModallId{{ $food->id }}"><i
                                                        class="fa fa-eye text-primary me-2"></i>View detail</a>
                                            </small>

                                        </div>
                                    </div>
                                </div>
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="foodModallId{{ $food->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">About {{ $food->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6"><img class="img-fluid w-100"
                                                            src="{{ asset('uploads/' . $food->files->img) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="border border-primary p-2 rounded-3">
                                                            <h3>Name: <span>{{ $food->name }} </span></h3>
                                                            <h3>Type: <span>{{ $food->type }} </span></h3>
                                                            <h3>Price: <span>{{ $food->price }} </span></h3>
                                                        </div>
                                                        <div>
                                                            <p class=" text-justify fs-5 text-dark">
                                                                {{ $food->description }}
                                                            </p>
                                                            <p class="text-justify fs-5 text-dark">
                                                                {{ $food->sub_description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 text-center wow fadeInUp mt-3" data-wow-delay="0.1s">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('menu') }}">See Our Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Booking Start -->
    <div class=" bg-icon mt-5 ">
        <div class="container  bg-primary p-5 my-3">

            <div class="p-5 wow fadeInUp text-center " style="background: rgba(0, 0, 0, 0.403)" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Reservation</h5>
                <h1 class="text-white mb-4">Book Online</h1>
                <p>Do you want to Book Room Or Table Or would you like to see our dining space</p>
                <a href="/booking" class="btn btn-primary my-2">Book </a>
                <a href="/spaces" class="btn btn-primary my-2">See our dining Spaces</a>
                <a href="#pickup" class="btn btn-primary my-2">Pickup</a>
            </div>

        </div>
    </div>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        @foreach ($settings as $set)
                            @if ($set->siteKey == 'BookinVideo')
                                <iframe class="embed-responsive-item" src="{{ $set->siteValue }}" id="video"
                                    allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->


    <!-- Testimonial Start -->
    @php
        $testimonialsCount = count($testimonials);
    @endphp

    <!-- Testimonial Start -->
    @if ($testimonialsCount >= 3)
        <div class="container-fluid bg-light bg-icon py-6 ">
            <div class="container">
                <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s"
                    style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Customer Review</h1>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-item position-relative bg-white text-dark p-5 mt-4">
                            <i class="fa fa-quote-left fa-3x text-primary position-absolute top-0 start-0 mt-n4 ms-5"></i>
                            <p class="mb-4">{{ $testimonial->description }}</p>
                            <div class="d-flex align-items-center">
                                <img class="flex-shrink-0 rounded-circle"
                                    src="{{ asset('uploads/' . $testimonial->files->img) }}" alt="">
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $testimonial->name }}</h5>
                                    <span>{{ $testimonial->profession }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Testimonial End -->
@endsection
