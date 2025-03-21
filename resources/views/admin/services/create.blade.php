@extends('admin.layouts.main')

@section('title')
    Add Service
@endsection
@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add A Service</h4>
                        </div>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Ex: Braid Locks" required>
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
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    <input type="number" name="price" id="price" class="form-control" placeholder="Ex: 89" required>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="deposit_price">Deposit Price($)</label>
                                    <input type="number" name="deposit_price" id="deposit_price" class="form-control" placeholder="Ex: 20" required>
                                    @error('deposit_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="duration">Duration</label>
                                    <input type="text" name="duration" id="duration"  class="form-control html-duration-picker" data-hide-seconds placeholder="Ex: 2:30" required>
                                    @error('duration')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="type">Type</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option selected="" disabled="">Select service type</option>
                                        <option value="women">Women</option>
                                        <option value="men">Men</option>
                                        <option value="kids">Kids</option>
                                        <option value="any">Any</option>

                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="image" class="form-label custom-file-input">Choose service image showcase</label>
                                    <input class="form-control" type="file" name="image_url" id="image" required>
                                    @error('image_url')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    
@endpush
