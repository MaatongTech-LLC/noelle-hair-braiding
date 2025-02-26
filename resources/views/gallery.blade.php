@extends("layouts.main")
@section("title", "Gallery")

@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)">
                            <div class="line" style="display: block; text-align: start; width: 100%;">
                                <div class="line" style="display: inline-block; text-align: start; width: 100%; position: relative;">
                                    <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px); position: relative;">
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">O</div>
                                            </div>
                                        </div>
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">u</div>
                                            </div>
                                        </div>
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">r</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px); position: relative;">
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">W</div>
                                            </div>
                                        </div>
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">o</div>
                                            </div>
                                        </div>
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">r</div>
                                            </div>
                                        </div>
                                        <div class="char" style="display: inline-block; position: relative;">
                                            <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                                <div class="char" style="display: inline-block;">k</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Work</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset('assets/images/icon-services.svg') }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Gallery Section Start -->
    <div class="photo-gallery">
        @php
            $directory = public_path('assets/images/test-gallery');
            $images = array_map(function($file) {
                return [
                    'path' => 'assets/images/test-gallery/'. basename($file),
                    'name' => pathinfo($file, PATHINFO_FILENAME)
                    ];
            }, glob($directory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE));

        @endphp
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Photo Gallery</h3>
                        <h2 class="text-anime">Look At Our Works</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="photo-gallery-ticker">
                        <!-- Photo Gallery Images Start -->
                        <div class="photo-gallery-content">
                            @foreach($images as $image)
                                <div class="photo-gallery-item">
                                    <figure class="hover-anime">
                                        <img src="{{ $image['path'] }}" height="500px;" style="object-fit: cover;" alt="">
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                        <div class="photo-gallery-content">
                            @foreach($images as $image)
                                <div class="photo-gallery-item">
                                    <figure class="hover-anime">
                                        <img src="{{ $image['path'] }}" height="500px;" style="object-fit: cover;" alt="">
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                        <!-- Photo Gallery Images End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Photo Gallery Section End -->
@endsection
