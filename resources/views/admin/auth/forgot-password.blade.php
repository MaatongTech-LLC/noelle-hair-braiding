@extends('admin.layouts.auth')
@section('title')
    Forgot Password
@endsection

{{--Forgot Password Content--}}
@section('content')
    <div class="card-body">
        <a href="#" class="mb-3 d-flex justify-content-center">
            <!--Logo start-->
            <img src="{{ asset('assets/img/logo.png') }}" height="150" width="150" alt="">
            <!--logo End-->
        </a>
        <h2 class="mb-2 text-center">Forgot password?</h2>
        <p class="text-center">Enter your email address and we'll send you an email with instructions to reset your password.</p>
        <form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="floating-label form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="email" placeholder=" ">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Reset</button>
        </form>
    </div>
@endsection
