@extends('layouts.main')
<style>
    .button-container {
        display: flex;
        justify-content: flex-end;
    }

    .card-header {
        display: none;
    }

    .formdata {
        margin-left: 23% !important;
    }
</style>
@section('content')
    <div class="col-md-6 col-sm-6 formdata">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">{{ isset($settings) ? 'Edit Setting' : 'Add Setting' }}</h3>
                </div>
                <hr>
                <form action="{{ isset($settings) ? '/admin/setting/update/' . $settings->id : '/admin/setting/insert' }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="upiid" class="control-label mb-1">UPI ID</label>
                        <input id="upiid" name="upiid" type="number"
                            value="{{ old('upiid', $settings->upiid ?? '') }}"
                            class="form-control @error('upiid') is-invalid @enderror">
                        @error('upiid')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group has-success">
                        <label for="pixel_code" class="control-label mb-1">Pixel Code</label>
                        <textarea id="pixel_code" name="pixel_code" class="form-control @error('pixel_code') is-invalid @enderror" rows="4">{{ old('pixel_code', $settings->pixel_code ?? '') }}</textarea>
                        @error('pixel_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="item form-group">
                        <button type="submit" class="btn btn-lg btn-info btn-block">
                            @if (isset($settings))
                                Update
                            @else
                                Save
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#profilepicInput').change(function(e) {
                var fileName = e.target.files[0];
                if (fileName) {
                    $('#imageLabel').text('New Image'); // Change the label text

                    // Display the new image in the img tag
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#oldImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(fileName);
                }
            });
        });
    </script>
@endpush
