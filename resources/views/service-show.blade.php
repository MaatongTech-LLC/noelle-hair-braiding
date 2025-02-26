@extends("layouts.main")
@section("title", "Service $service->name")
@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)">
                            <div class="line" style="display: block; text-align: start; width: 100%;">
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    @foreach(explode(" ", $service->name) as $char)
                                        <div class="char" style="display: inline-block;">{{ $char }}</div>
                                    @endforeach

                                </div>
                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route("services") }}">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset('assets/images/icon-service-single.svg') }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>

    <div class="page-service-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Service Sidebar Start -->
                    <div class="service-sidebar">
                        <!-- Service List Box Start -->
                        <div class="service-list-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <h3>Other Services</h3>
                            <div class="service-list-entry">
                                <ul>
                                    @foreach($services as $s)
                                        <li><a @if($s->id == $service->id) style="color: var(--color-pink);" @endif href="{{ route("service.show", $s->id) }}">{{ $s->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Service List Box End -->

                    </div>
                    <!-- Service Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Service Content Start -->
                    <div class="service-content">
                        <div class="service-image">
                            <figure class="hover-anime">
                                <img style="max-height: 700px; width: 700px; object-fit: cover;" src="{{ $service->getImage() }}" alt="{{ $service->name }}">
                            </figure>
                        </div>

                        <div class="service-entry">
                            <h2>  {{ ucwords($service->name) }}</h2>
                            <h4>Price: <sup style="color: var(--color-pink)">${{ $service->price }}</sup></h4>
                            <h4>Deposit Price <small>(Not refundable)</small>: <sup style="color: var(--color-pink)">${{ $service->deposit_price }}</sup></h4>
                            @if($service->type !== "any")
                                <h6>{{ ucwords($service->type) }}</h6>
                            @else
                                <h6>Women, Men, Kids</h6>
                            @endif
                            <div>
                                {!! $service->description !!}
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn-default">Book Now</button>

                        </div>
                    </div>
                    <!-- Service Content End -->

                    <!-- Service Photo Gallery Start -->
                   {{-- <div class="service-photo-gallery">
                        <div class="service-photo-gallery-header">
                            <h2>Cutting &amp; Styles Photo Gallery</h2>
                        </div>

                        <div class="service-photo-gallery-entry service-gallery">
                            <div class="service-photo-item">
                                <a href="images/post-1.jpg">
                                    <figure class="hover-anime">
                                        <img src="images/post-1.jpg" alt="">
                                    </figure>
                                </a>
                            </div>

                            <div class="service-photo-item">
                                <a href="images/post-2.jpg">
                                    <figure class="hover-anime">
                                        <img src="images/post-2.jpg" alt="">
                                    </figure>
                                </a>
                            </div>

                            <div class="service-photo-item">
                                <a href="images/post-3.jpg">
                                    <figure class="hover-anime">
                                        <img src="images/post-3.jpg" alt="">
                                    </figure>
                                </a>
                            </div>

                            <div class="service-photo-item">
                                <a href="images/post-4.jpg">
                                    <figure class="hover-anime">
                                        <img src="images/post-4.jpg" alt="">
                                    </figure>
                                </a>
                            </div>
                        </div>
                    </div>--}}
                    <!-- Service Photo Gallery End -->

                </div>
            </div>
        </div>
    </div>

@endsection
