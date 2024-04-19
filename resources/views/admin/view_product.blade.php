@extends('layouts.main')
@section('content')
    <style>
        .modal-backdrop {
            position: unset !important;
        }
    </style>
    <div class="col-md-12 col-sm-12 ">
        <div class="card">
            <div class="card-header">Product List</div>
            <div class="card-body">
                <div class="card-title">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="button-container-add" style="display: flex; justify-content: space-between;">

                        <div>
                            <a href="#" id="csvUploadButton">
                                <button type="button" class="btn btn-dark btn-sm mb-2">CSV Upload</button>
                            </a>

                            <!-- Modal -->
                            <!-- Modal for CSV Upload -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Upload CSV</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- CSV Upload Form -->
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form action="{{ route('import') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="file" accept=".csv">
                                                <button type="submit" class="btn btn-primary btn-sm">Import CSV</button>
                                            </form>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="button-container text-right mb-2">
                    <a href="{{ route('create.product') }}"><button type="button" class="btn btn-primary btn-sm mt-1">Add
                            Product</button></a>
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-striped jambo_table bulk_action" id="table">
                        <thead>
                            <tr class="">
                                <th>Image</th>
                                <th>Name</th>
                                <th><span class="nobr">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $pro)
                                <tr class="">
                                    <td>
                                        @if ($pro->main_image)
                                            <img src="{{ asset('images/' . $pro->main_image) }}"
                                                alt="Product Main Image" width="100">
                                        @else
                                            No Photo Available
                                        @endif
                                    </td>

                                    <td>{{ $pro->name }}</td>
                                    <td>
                                        <a href="{{ route('edit.product', $pro->id) }}" class="btn btn-info btn-sm">Edit</a>

                                        <a href="{{ route('destroy.product', $pro->id) }}"
                                            class="btn btn-danger btn-sm"onclick="return confirm('Are you sure you want to delete this ?');">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();

            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
        });

        // jQuery to open modal when button is clicked
        $('#csvUploadButton').click(function() {
            $('#myModal').modal('show');
        });
    </script>
@endpush
