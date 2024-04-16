@extends('layouts.main')
@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="card">
            <div class="card-header">Setting List</div>
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
                    <div class="button-container text-right mb-2">
                        <a href="{{ route('create.setting') }}"><button type="button" class="btn btn-primary btn-sm mt-1">Add
                                Setting</button></a>
                    </div>
                    {{-- <h3 class="text-right mt-4"></h3> --}}
                </div>
                <div class="table-responsive mt-2">
                    <table class="table table-striped jambo_table bulk_action" id="table">
                        <thead>
                            <tr class="">
                                <th>No</th>
                                <th class="">UPI ID</th>
                                <th class="">Setting</th>
                                <th class=""><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($settings as $index => $setting)
                                <tr class="">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $setting->upiid }}</td>
                                    <td>{{ $setting->pixel_code }}</td>
                                    <td>
                                        <a href="{{ route('edit.setting', $setting->id) }}"
                                            class="btn btn-info btn-sm">Edit</a>

                                        <a href="{{ route('destroy.setting', $setting->id) }}"
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
             $('#table').DataTable();

            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
        });
    </script>
@endpush
