@extends('admin.layouts.auth')
@section('title')
    Login
@endsection

{{--Login Content--}}
@section('content')
    <div class="card-body">
        <a href="#" class="mb-3 d-flex justify-content-center">
            <!--Logo start-->
            <img src="{{ asset('assets/img/logo.png') }}" height="150" width="150" alt="">
            <!--logo End-->
        </a>
        <h2 class="mb-2 text-center">Sign In</h2>
        <p class="text-center">Login to stay connected.</p>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" aria-describedby="email" placeholder=" ">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder=" ">
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-between">
                    <div class="form-check mb-3">
                        <input type="checkbox" name="remember" class="form-check-input" id="customCheck1">
                        <label class="form-check-label" for="customCheck1">Remember Me</label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>

        </form>
    </div>
@endsection
