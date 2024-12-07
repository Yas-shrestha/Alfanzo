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
            <div class="col-lg-4 col md-3 col-sm-12">
                <div class="card bg-primary border-0">
                    <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60"
                        class="card-img-top" alt="..." height="300px" style="object-fit: cover">
                    <div class="card-body">
                        <h5 class="card-title text-white">Double Bed Room</h5>
                        <h6 class="card-subtitle mb-2 text-muted text-white ">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        b5
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
