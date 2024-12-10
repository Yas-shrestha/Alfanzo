@extends('layouts.main')

@section('container')
    @foreach ($settings as $set)
        @if ($set->siteKey == 'Banner')
            <div class="container-fluid page-header mb-5 wow fadeIn"
                style="background: url({{ asset('uploads/' . ($set->siteValue != '' ? $set->siteValue : 'hero.jpg')) }}) top right no-repeat;"
                data-wow-delay="0.1s">
        @endif
    @endforeach
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Room</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="/">Home</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Room</li>
            </ol>
        </nav>
    </div>
    </div>
    <div class="container my-3">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Our Rooms</h5>
            <h1 class="mb-5">Rooms With Comfort</h1>
        </div>
        <div class="row">
            @forelse ($rooms as $room)
                <div class="col-lg-4 col md-3 col-sm-12">
                    <div class="card bg-primary border-0">
                        <img src="{{ asset('uploads/' . $room->files->img) }}" class="card-img-top" alt="..."
                            height="300px" style="object-fit: cover">
                        <div class="card-body">
                            <h5 class="card-title text-white">{{ $room->name }}</h5>
                            <h6 class="card-subtitle text-muted text-white ">
                                @if ($room->noofbed == 1)
                                    Single Bed
                                @elseif ($room->noofbed == 2)
                                    Double Bed
                                @else
                                    {{ $room->noofbed }} Beds
                                @endif
                            </h6>
                            <div class="row my-2">
                                <div class="col-sm-6 text-white col-12"><i class="fa fa-bars" aria-hidden="true"> </i>
                                    No
                                    of Window : {{ $room->noofwindow }}</div>
                                <div class="col-sm-6 text-white col-12"> <i class="fa fa-bed" aria-hidden="true"></i> No
                                    of
                                    Beds : {{ $room->noofbed }}</div>
                            </div>
                            <div class=" text-white ">
                                <p>{{ $room->special_feature }}</p>
                            </div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-light btn-md my-3 w-100" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $room->id }}">
                                Know more
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $room->id }}" tabindex="-1"
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
                                                <img src="{{ asset('uploads/' . $room->files->img) }}" alt=""
                                                    height="300px" width="300px" style="object-fit: cover">
                                                <h2 class="text-primary mt-3">{{ $room->name }}</h2>
                                            </div>
                                            <hr>
                                            <div class="container">

                                                <div class="row">
                                                    <div class="col-sm-6 text-dark col-12"><i class="fa fa-bars"
                                                            aria-hidden="true"> </i>
                                                        No
                                                        of Window : {{ $room->noofwindow }}</div>
                                                    <div class="col-sm-6 text-dark col-12 text-end"> <i class="fa fa-bed"
                                                            aria-hidden="true"></i> No
                                                        of
                                                        Beds : {{ $room->noofbed }}</div>
                                                </div>
                                                <hr>
                                                <div>
                                                    <h2 class="text-primary">Special Feature</h2>
                                                    <p class="text-dark">{{ $room->special_feature }}</p>
                                                </div>
                                                <hr>
                                                <div class="my-2">
                                                    <h2 class="text-primary">About Room</h2>
                                                    <div class="text-dark">
                                                        {!! $room->description !!}
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
                <div class="fs-1 text-dark text-center">No Rooms</div>
            @endforelse
        </div>
    </div>
@endsection
