@extends('layouts.main')

@section('container')
    <!--Banner -->
    <!-- Page Header Start -->
    @foreach ($settings as $set)
        @if ($set->siteKey == 'Banner')
            <div class="container-fluid page-header mb-5 wow fadeIn"
                style="background: url({{ asset('uploads/' . ($set->siteValue != '' ? $set->siteValue : 'hero.jpg')) }}) center no-repeat;width:100%;background-size:cover;"
                data-wow-delay="0.1s">
        @endif
    @endforeach
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown  text-white">Payment Success</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Home</a></li>
                <li class="breadcrumb-item text-light active" aria-current="page">Payment Success</li>
            </ol>
        </nav>
    </div>
    </div>
    <!-- Page Header End -->
    {{-- success box --}}
    <div class="container">
        <div class="card bg-success text-white p-5 mb-5">
            <div class="card-body ">
                <div class="text-center">
                    <h1 class="card-title text-white fs1 mb-3">Payment Successful</h1>
                    <h3 class="card-subtitle mb-2 text-white ">Thanks for choosing us</h3>
                </div>
                <hr class="my-3">
                <div class="text-center">

                    <h3 class="card-subtitle mb-2 text-white">Payment details</h3>
                </div>
                <div class="details text-center">
                    <div class="table-responsive">
                        <table class="table table-white">
                            <thead>
                                <tr>
                                    <th scope="col">S.No</th>
                                    <th scope="col">Food name</th>
                                    <th scope="col">Food quantity</th>
                                    <th scope="col">Food Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $data->foods->name }}</td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>{{ $data->foods->price }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- success box --}}
@endsection
