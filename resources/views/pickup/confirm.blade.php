@extends('layouts.main')
@section('container')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Pickup Confirmation</h3>
            </div>
            <div class="card-body">
                <p class="mb-3"><strong>Pickup Request Details:</strong></p>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Name:</strong> {{ $pickup->name }}</li>
                    <li class="list-group-item"><strong>Location:</strong> {{ $pickup->location }}</li>
                    <li class="list-group-item"><strong>Pickup Time:</strong> {{ $pickup->pickuptime }}</li>
                    <li class="list-group-item"><strong>Number of People:</strong> {{ $pickup->noofpeople }}</li>
                    <li class="list-group-item"><strong>Phone:</strong> {{ $pickup->phone }}</li>
                </ul>

                <p class="mb-4">Do you want to confirm or reject this pickup request?</p>

                <div class="d-flex justify-content-between">
                    <!-- Accept Button -->
                    <form action="{{ route('pickup.confirm', ['id' => $pickup->id, 'action' => 'accept']) }}"
                        method="get">
                        <button type="submit" class="btn btn-success btn-lg">Accept</button>
                    </form>

                    <!-- Reject Button -->
                    <form action="{{ route('pickup.confirm', ['id' => $pickup->id, 'action' => 'reject']) }}"
                        method="get">
                        <button type="submit" class="btn btn-danger btn-lg">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
