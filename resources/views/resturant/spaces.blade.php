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
        <h1 class="display-3 mb-3 animated slideInDown">Dining Spacess</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Dining Spaces</li>
            </ol>
        </nav>
    </div>
    </div>

    <div class="container my-5">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Our Dining Spaces</h1>

        </div>
        <div class="row">
            @forelse ($spaces as $space)
                <div class="col-lg-4 col md-3 col-sm-12">
                    <div class="card bg-primary border-0">
                        <a href=""> <img src="{{ asset('uploads/' . $space->files->img) }}" class="card-img-top"
                                alt="..." height="300px" style="object-fit: cover"></a>
                        <div class="card-body">
                            <h5 class="card-title text-white">{{ $space->title }}</h5>
                            <div class=" text-white ">
                                {{ Illuminate\Support\Str::words(strip_tags($space->description), 100) }}
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-light btn-md my-3 w-100" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $space->id }}">
                                Know more
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $space->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{ asset('uploads/' . $space->files->img) }}" alt=""
                                                    height="300px" width="100%" style="object-fit: cover">
                                                <h2 class="text-primary mt-3"> {{ $space->title }}</h2>
                                            </div>
                                            <hr>
                                            <div class="container">

                                                <div class="my-2">
                                                    <h2 class="text-primary">About this Dining Space</h2>
                                                    <style>
                                                        .description-container {
                                                            max-width: 100%;
                                                            /* Makes it responsive */
                                                            overflow: hidden;
                                                            /* Prevents scrollbars */
                                                            word-wrap: break-word;
                                                            /* Ensures text doesn't overflow */
                                                            display: block;
                                                            color: black;
                                                        }

                                                        img {
                                                            max-width: 100%;
                                                            /* Makes images responsive */
                                                            height: auto;
                                                            /* Maintains image aspect ratio */
                                                            display: block;
                                                        }
                                                    </style>
                                                    <div class="description-container">
                                                        {!! $space->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @empty
                <div class="fs-1 text-dark text-center">No Spaces</div>
            @endforelse
            <div class="container-fluid bg-primary bg-icon mt-5 py-5">
                <div class="container">

                    <div class="p-5 wow fadeInUp text-center " style="background: rgba(0, 0, 0, 0.403)"
                        data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Reservation</h5>
                        <h1 class="text-white mb-4">Book A Table </h1>
                        <p>Do you want to Book a table now</p>
                        <a href="/booking" class="btn btn-primary">Book a Table</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
@endsection
