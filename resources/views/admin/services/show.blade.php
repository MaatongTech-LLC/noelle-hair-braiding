@extends('admin.layouts.main')

@section('title')
    Service {{ $service->name }}
@endsection
@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Service {{ $service->name }}</h4>
                        </div>
                        <a class="btn btn-primary" href="{{ route('admin.services.index') }}">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile">
                                <img src="{{ $service->getImage() }}" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                            </div>
                            <div class="mt-3">
                                <h3 class="d-inline-block">{{ $service->name }}</h3>
                                <p>{{ ucwords($service->type) }}</p>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">About Service</h4>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="mt-2">
                            <h6 class="mb-1">Category:</h6>
                            <p>{{ $service->category->name }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Created:</h6>
                            <p>{{ $service->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Price ($):</h6>
                            <p>{{ $service->price }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Deposit Price ($):</h6>
                            <p>{{ $service->deposit_price }}</p>
                        </div>

                        <div class="mt-2">
                            <h6 class="mb-1">Description:</h6>
                            <div class="w-75">
                                {{ $service->description }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
