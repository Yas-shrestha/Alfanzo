@extends('resturant.admin.inc.main')
@section('main-container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">
                    <div class="pagetitle">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <h1>Manage pickup</h1>
                            <a href="{{ route('pickups.create') }}" class="btn btn-primary">Add</a>
                        </div>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">Manage-pickup</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->
                    <section class="section">
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <table
                                        class="table table-striped overflow-hidden table-hover table-bordered table-lg table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                {{-- <th scope="col">email</th> --}}
                                                <th scope="col">location</th>
                                                <th scope="col">no of people</th>
                                                <th scope="col">pickup time</th>
                                                {{-- <th scope="col">Pickup status</th> --}}
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pickups as $pickup)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $pickup->name }}</td>
                                                    <td>{{ $pickup->phone }}</td>
                                                    {{-- <td>{{ $pickup->email }}</td> --}}
                                                    <td>{{ $pickup->location }}</td>
                                                    <td>{{ $pickup->noofpeople }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($pickup->pickuptime)->format('F j, Y, g:i a') }}
                                                    </td>
                                                    {{-- @if (Auth::user() && Auth::user()->role == 'user')
                                                        <td>
                                                            <span
                                                                class="badge rounded-pill 
                                                {{ $pickup->pickup_status == 'canceled' ? 'bg-warning' : '' }}
                                                {{ $pickup->pickup_status == 'pending' ? 'bg-primary' : '' }}
                                                {{ $pickup->pickup_status == 'booked' ? 'bg-success' : '' }}">
                                                                {{ $pickup->pickup_status }}
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <form action="{{ route('update.pickup', $pickup->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <select class="form-select" name="status"
                                                                    aria-label="Pickup Status">
                                                                    <option>Select status</option>
                                                                    <option value="pending"
                                                                        {{ $pickup->pickup_status == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="booked"
                                                                        {{ $pickup->pickup_status == 'booked' ? 'selected' : '' }}>
                                                                        Booked</option>
                                                                    <option value="canceled"
                                                                        {{ $pickup->pickup_status == 'canceled' ? 'selected' : '' }}>
                                                                        Canceled</option>
                                                                </select>
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary my-1">Change</button>
                                                            </form>
                                                        </td>
                                                    @endif --}}
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-cancel-Id{{ $pickup->id }}">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modal-cancel-Id{{ $pickup->id }}"
                                                            tabindex="-1" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" role="dialog"
                                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalTitleId">Cancel
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to cancel
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ route('pickups.cancel', $pickup->id) }}"
                                                                            class="btn btn-danger">Yes</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <a href="{{ route('pickups.show', $pickup->id) }}"
                                                            class="btn btn-md btn-secondary"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>
                                                        <!-- Modal trigger button -->
                                                        <button type="button" class="btn btn-danger btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalId{{ $pickup->id }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modalId{{ $pickup->id }}"
                                                            tabindex="-1" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" role="dialog"
                                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalTitleId">Delete
                                                                            ??
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('pickups.destroy', $pickup->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" name="submit"
                                                                                class="btn btn-danger"><i
                                                                                    class="fa-solid fa-trash-can"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Optional: Place to the bottom of scripts -->
                                                        <script>
                                                            const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                                        </script>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $pickups->links() }}
                                    </div>
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
