@extends('admin.layouts.main')

@section('title')
    Client {{ $client->name }}
@endsection
@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Client Profile</h4>
                        </div>
                        <a class="btn btn-primary" href="{{ route('admin.clients.index') }}">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile">
                                <img src="{{ asset('admin/assets/images/avatars/01.png') }}" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                            </div>
                            <div class="mt-3">
                                <h3 class="d-inline-block">{{ $client->name }}</h3>
                                <p class="d-inline-block pl-3"></p>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="header-title">
                            <h4 class="card-title">About Client</h4>
                        </div>

                    </div>
                    <div class="card-body">

                        <div class="mt-2">
                            <h6 class="mb-1">Joined:</h6>
                            <p>{{ $client->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Lives:</h6>
                            <p>United States of America</p>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-1">Email:</h6>
                            <p><a href="#" class="text-body">{{ $client->email }}</a></p>
                        </div>

                        <div class="mt-2">
                            <h6 class="mb-1">Phone:</h6>
                            <p><a href="tel:1{{$client->phone}}" class="text-body">{{ $client->getPhone() ?? $client->phone }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
