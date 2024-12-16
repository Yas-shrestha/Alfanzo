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
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible fade show w-50 m-auto" role="alert">
            {{ Session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-end">
                {!! QrCode::size(200)->generate(route('qr-page')) !!}
            </div>
            @foreach ($categories as $category)
                <h1 class="text-primary text-center">{{ $category->title }}</h1>
                <div class="row">
                    @foreach ($foods as $food)
                        @if ($category->id == $food->category_id)
                            <div class="col-lg-4 col-sm-6 col-12 py-2 px-4">
                                <div class="d-flex align-items-center">
                                    <a href="{{ asset('uploads/' . $food->files->img) }}" target="_blank"> <img
                                            class="flex-shrink-0 img-fluid rounded"
                                            src="{{ asset('uploads/' . $food->files->img) }}" alt=""
                                            style="width: 150px;height:80px;object-fit:cover"></a>
                                    <div class="w-100 d-flex flex-column text-start ps-4">
                                        <h6 class="d-flex justify-content-between border-bottom pb-2">
                                            <span>{{ $food->name }}</span>
                                            <span class="text-primary">Rs{{ $food->price }}</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach

        </div>
    </div>
    <!-- Product End -->


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
                            <div class="team-item text-center rounded bg-white overflow-hidden">
                                <div class="rounded overflow-hidden m-4">
                                    <img class="img-fluid rounded" src="{{ asset('uploads/' . $team->files->img) }}"
                                        alt="" data-bs-toggle="modal" data-bs-target="#teamID{{ $team->id }}"
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
@endsection
