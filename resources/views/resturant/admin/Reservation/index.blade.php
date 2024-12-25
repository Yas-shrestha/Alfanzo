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
                            <h1>Manage reservation</h1>
                            <a href="{{ route('reservation.create') }}" class="btn btn-primary">Add</a>
                        </div>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">Manage-reservation</li>
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
                                                <th scope="col">Room</th>
                                                <th scope="col">Dining space</th>
                                                <th scope="col">pickup</th>
                                                <th scope="col">Date</th>
                                                {{-- <th scope="col">Reservation status</th> --}}
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $reservation->name }}</td>
                                                    <td>{{ $reservation->phone }}</td>
                                                    <td>{{ $reservation->room }}</td>
                                                    <td>{{ $reservation->spaces }}</td>
                                                    <td>{{ $reservation->pickup }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($reservation->pickuptime)->format('F j, Y, g:i a') }}
                                                    </td>
                                                    {{-- @if (Auth::user() && Auth::user()->role == 'user')
                                                        <td>
                                                            <span
                                                                class="badge rounded-pill 
                                                {{ $reservation->reservation_status == 'canceled' ? 'bg-warning' : '' }}
                                                {{ $reservation->reservation_status == 'pending' ? 'bg-primary' : '' }}
                                                {{ $reservation->reservation_status == 'booked' ? 'bg-success' : '' }}">
                                                                {{ $reservation->reservation_status }}
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <form
                                                                action="{{ route('update.reservation', $reservation->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <select class="form-select" name="status"
                                                                    aria-label="Reservation Status">
                                                                    <option>Select status</option>
                                                                    <option value="pending"
                                                                        {{ $reservation->reservation_status == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="booked"
                                                                        {{ $reservation->reservation_status == 'booked' ? 'selected' : '' }}>
                                                                        Booked</option>
                                                                    <option value="canceled"
                                                                        {{ $reservation->reservation_status == 'canceled' ? 'selected' : '' }}>
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
                                                            data-bs-target="#modal-cancel-Id{{ $reservation->id }}">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modal-cancel-Id{{ $reservation->id }}"
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
                                                                        <a href="{{ route('reservation.cancel', $reservation->id) }}"
                                                                            class="btn btn-danger">Yes</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <a href="{{ route('reservation.show', $reservation->id) }}"
                                                            class="btn btn-md btn-secondary"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>
                                                        <!-- Modal trigger button -->
                                                        <button type="button" class="btn btn-danger btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalId{{ $reservation->id }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modalId{{ $reservation->id }}"
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
                                                                            action="{{ route('reservation.destroy', $reservation->id) }}"
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
                                        {{ $reservations->links() }}
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
