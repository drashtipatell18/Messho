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
                    <h3 class="text-center title-2">{{ isset($products) ? 'Edit Product' : 'Add Product' }}</h3>
                </div>
                <hr>
                <form action="{{ isset($products) ? '/admin/product/update/' . $products->id : '/admin/product/insert' }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="control-label mb-1">Name*</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $products->name ?? '') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Color</label>
                        <input id="color" name="color" type="text"
                            value="{{ old('color', $products->color ?? '') }}"
                            class="form-control @error('color') is-invalid @enderror">
                        @error('color')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Size</label>
                        <input id="size" name="size" type="text" value="{{ old('size', $products->size ?? '') }}"
                            class="form-control @error('size') is-invalid @enderror">
                        @error('size')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label mb-1">Price</label>
                        <input id="price" name="price" type="number"
                            value="{{ old('price', $products->price ?? '') }}"
                            class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mrp" class="control-label mb-1">MRP</label>
                        <input id="mrp" name="mrp" type="number" value="{{ old('mrp', $products->mrp ?? '') }}"
                            class="form-control @error('mrp') is-invalid @enderror">
                        @error('mrp')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label mb-1">Category</label>
                        <input id="category" name="category" type="text"
                            value="{{ old('category', $products->category ?? '') }}"
                            class="form-control @error('category') is-invalid @enderror">
                        @error('category')
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                            rows="5">{{ old('description', $products->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" id="imageLabel" class="control-label mb-1">Old Main Image</label>
                        @if (isset($products) && $products->main_image)
                            <img id="oldImage" src="{{ asset('images/' . $products->main_image) }}"
                                alt="Uploaded Document" width="100">
                            <input type="hidden" class="form-control" name="oldimage" value="{{ $products->main_image }}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="main_image" class="control-label mb-1">Main Image </label>
                        <input type="file" name="main_image">
                    </div>
                    <div class="form-group">
                        <label for="image" id="imageLabel" class="control-label mb-1">Old Sub Image</label>
                        @if (isset($products) && $products->sub_image)
                            @php
                                // Decode the JSON string into an array
                                $subImages = json_decode($products->sub_image, true);
                                if (is_null($subImages)) {
                                    // Handle possible JSON decode failure or non-array data
                                    $subImages = [];
                                }
                            @endphp

                            @foreach ($subImages as $image)
                                <img id="oldImage" src="{{ asset('images/' . $image) }}" alt="Uploaded Document"
                                    width="100">
                                <input type="hidden" class="form-control" name="old_images[]"
                                    value="{{ $image }}">
                            @endforeach
                        @endif


                    </div>
                    <div class="form-group">
                        <label for="sub_image" class="control-label mb-1">Sub Images </label>
                        <input type="file" name="sub_images[]" multiple>
                    </div>

                    <div class="item form-group">
                        <button type="submit" class="btn btn-lg btn-info btn-block">
                            @if (isset($products))
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
