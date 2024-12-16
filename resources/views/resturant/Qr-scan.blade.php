<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<body style="background-color: #FF6701">
    <div class="p-3">
        <div class="card text-white"
            style="
                    width: 100%;
                    background: linear-gradient(
                        rgba(15, 23, 43, 0.9),
                        rgba(15, 23, 43, 0.9)
                    );
                ">
            <div class="card-body">
                <div class="text-center">
                    <h2>
                        @foreach ($settings as $set)
                            @if ($set->siteKey == 'ResturantName')
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <a href="{{ route('/') }}"
                                    style="text-decoration: none;color:#FF6701;">{{ $set->siteValue }}</a>
                            @endif
                        @endforeach
                    </h2>
                    <h3>Menu</h3>
                    <h6>Take your time and Order</h6>
                </div>
                <hr class="mx-2">
                <div class="row pb-3">
                    @foreach ($categories as $category)
                        <h1 class="text-primary text-center">{{ $category->title }}</h1>
                        <div class="row">
                            @foreach ($foods as $food)
                                @if ($category->id == $food->category_id)
                                    <div class="col-lg-4 col-sm-6 py-2 px-4">
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
                    <hr class="mx-3">
                </div>
                <div class="px-5" style="text-align: center">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    @foreach ($settings as $set)
                        @if ($set->siteKey == 'Phone')
                            <a href="tel:{{ $set->siteValue }}"
                                style="text-decoration: none;color:white;">{{ $set->siteValue }}</a>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
