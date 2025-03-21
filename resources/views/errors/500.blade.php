@extends('layouts.main')
@section('title', '500 Error')
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)">
                            <div class="line" style="display: block; text-align: start; width: 100%;">
                                <div class="word"
                                    style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">S</div>
                                    <div class="char" style="display: inline-block;">e</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                    <div class="char" style="display: inline-block;">v</div>
                                    <div class="char" style="display: inline-block;">e</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                </div>
                                <div class="word"
                                    style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">E</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                </div>
                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s"
                            style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">500 Error</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset('assets/images/icon-notfound.svg') }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>

    <div class="page-not-found">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Page Not Found Box Start -->
                    <div class="page-not-found-box wow fadeInUp" data-wow-delay="0.25s"
                        style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                        <div class="not-found-image">

                        </div>

                        <h3>Server Error</h3>
                        <p>Server encoutered an error,<br> or is temporarily unavailable.</p>

                        <a href="{{ route('home') }}" class="btn-default">Back To Home</a>
                    </div>
                    <!-- Page Not Found Box End -->
                </div>
            </div>
        </div>
    </div>
@endsection
