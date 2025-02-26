@extends('admin.layouts.auth')
@section('title')
    Login
@endsection

{{--Reset Password Content--}}
@section('content')
    <div class="card-body">
        <a href="#" class="mb-3 d-flex justify-content-center">
            <!--Logo start-->
            <img src="{{ asset('assets/img/logo.png') }}" height="150" width="150" alt="">
            <!--logo End-->
        </a>
        <h2 class="mb-2 text-center">Reset your password</h2>
        <p class="text-center">Enter your new password in order to access your account.</p>
        <form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email" placeholder=" ">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder=" ">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password-confirmation" class="form-label">Confirm Password</label>
                        <input type="password-confirmation" name="password-confirmation" class="form-control" id="password-confirmation" aria-describedby="password-confirmation" placeholder=" ">
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>

        </form>
    </div>
@endsection
