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
                            <h1>Manage Foods</h1>
                            <a href="{{ route('foods.create') }}" class="btn btn-primary btn-md p-3">Add Foods</a>
                        </div>
                        <form action="{{ route('food-category.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Add Food Category</label>
                                <div class="row">
                                    <div class="col-sm-8 col-12 mb-2"> <input type="text" class="form-control"
                                            name="title" id="category" aria-describedby="helpId"
                                            placeholder="Add Food Category" /></div>
                                    <div class="col-sm-4 col-12"><button type="submit" class="btn btn-primary w-100">Add
                                            Category</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">Foods</li>
                            </ol>
                        </nav>
                    </div><!-- End Page Title -->

                    <section class="section">
                        <div class="row">
                            <div class="card">

                                <div class="card-body">
                                    <table
                                        class="table table-striped table-hover table-bordered table-lg table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($foods as $food)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $food->name }}</td>
                                                    <td>{{ $food->category->title }}
                                                    </td>
                                                    <td>Rs {{ $food->price }}</td>
                                                    <td>
                                                        <a target="_blank"
                                                            href="{{ url('uploads/' . $food->files->img) }}"><img
                                                                src="{{ asset('uploads/' . $food->files->img) }}"
                                                                width="50px" height="50px" alt="no"></a>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('foods.edit', $food->id) }}"
                                                            class="btn btn-md btn-primary"><i class="fa fa-pencil"
                                                                aria-hidden="true"></i></a>
                                                        <a href="{{ route('foods.show', $food->id) }}"
                                                            class="btn btn-md btn-secondary"><i class="fa fa-eye"
                                                                aria-hidden="true"></i></a>
                                                        <!-- Modal trigger button -->
                                                        <button type="button" class="btn btn-danger btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalId{{ $food->id }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>

                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modalId{{ $food->id }}"
                                                            tabindex="-1" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" role="dialog"
                                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalTitleId">Delete ??
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('foods.destroy', $food->id) }}"
                                                                            method="POST">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger"><i
                                                                                    class="fa-solid fa-trash-can"></i>
                                                                                Delete</button>
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
                                        {{ $foods->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class=" Food-category my-2 section">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">Food Category</li>
                            </ol>
                        </nav>
                        <div class="row">
                            <div class="card">

                                <div class="card-body">
                                    <table
                                        class="table table-striped table-hover table-bordered table-lg table-responsive-lg">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.N</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($foodCategories as $category)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $category->title }}</td>

                                                    <td>


                                                        <!-- Modal trigger button -->
                                                        <button type="button" class="btn btn-danger btn-md"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalId{{ $category->id }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>

                                                        <!-- Modal Body -->
                                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                        <div class="modal fade" id="modalId{{ $category->id }}"
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
                                                                        Are you sure you want to delete?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form
                                                                            action="{{ route('food-category.destroy', $category->id) }}"
                                                                            method="POST">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-danger"><i
                                                                                    class="fa-solid fa-trash-can"></i>
                                                                                Delete</button>
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
                                        {{ $foods->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </main>
@endsection
