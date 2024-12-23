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
        <h1 class="display-3 mb-3 animated slideInDown">Notice</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="text-body" href="#">Pages</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Notice</li>
            </ol>
        </nav>
    </div>
    </div>
    <div class="container p-5 my-3">
        <div class="row">
            @foreach ($notices as $notice)
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <!-- Button trigger modal -->
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal{{ $notice->id }}">
                        <img src="{{ asset('uploads/' . $notice->files->img) }}" alt="" width="100%">
                        <h3>{{ $notice->title }}</h3>
                        <h3>{{ $notice->sub_title }}</h3>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $notice->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg      ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary" id="exampleModalLabel">{{ $notice->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('uploads/' . $notice->files->img) }}" alt="" width="100%">
                                    <div class="border-top">
                                        <h1 class="text-primary"></h1>

                                    </div>
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
                                        {!! $notice->description !!}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
