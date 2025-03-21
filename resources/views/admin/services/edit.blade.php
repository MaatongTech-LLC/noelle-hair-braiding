@extends('admin.layouts.main')

@section('title')
    Edit Service
@endsection
@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Service</h4>
                        </div>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $service->name }}" name="name" id="name" class="form-control" placeholder="Ex: Braid Locks" required>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="type">Category</label>
                                    <select class="form-select" id="type" name="service_category_id" required>
                                        <option selected="" disabled="">Select service category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if($service->category && $service->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('service_category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="price">Price($)</label>
                                    <input type="number" value="{{ $service->price }}" name="price" id="price" class="form-control" placeholder="Ex: 89" required>
                                    @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="deposit_price">Deposit Price($)</label>
                                    <input type="number" value="{{ $service->deposit_price }}" name="deposit_price" id="deposit_price" class="form-control" placeholder="Ex: 20" required>
                                    @error('deposit_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="duration">Duration</label>
                                    <input type="text" name="duration" id="duration" class="form-control html-duration-picker" data-hide-seconds data-duration="{{ '00:'.$service->duration }}" placeholder="{{ $service->duration }}" required>
                                    @error('duration')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="type">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option  disabled="">Select service type</option>
                                        <option {{ $service->type === 'women' ? 'selected' : '' }} value="women">Women</option>
                                        <option {{ $service->type === 'men' ? 'selected' : '' }} value="men">Men</option>
                                        <option {{ $service->type === 'kids' ? 'selected' : '' }} value="kids">Kids</option>
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="image_url" class="form-label custom-file-input">Choose service image showcase</label>
                                    <input class="form-control" type="file" name="image_url" id="image_url">
                                    @error('image_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ $service->description }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/html-duration-picker@latest/dist/html-duration-picker.min.js"></script>
    <script>

        $(document).ready(function() {
            $('#duration').val('{{ \Illuminate\Support\Carbon::parse($service->duration)->format('H:i') }}');
        });

    </script>
@endpush
