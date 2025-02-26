@extends("layouts.main")
@section("title", "Services")
@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)"><div class="line" style="display: block; text-align: start; width: 100%;"><div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">O</div><div class="char" style="display: inline-block;">u</div><div class="char" style="display: inline-block;">r</div></div> <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">S</div><div class="char" style="display: inline-block;">e</div><div class="char" style="display: inline-block;">r</div><div class="char" style="display: inline-block;">v</div><div class="char" style="display: inline-block;">i</div><div class="char" style="display: inline-block;">c</div><div class="char" style="display: inline-block;">e</div><div class="char" style="display: inline-block;">s</div></div></div></h1><ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
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
    <!-- Page Header Section End -->

    <!-- Services Lists Start -->
    <div class="services-lists">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Service Sidebar Start -->
                    <div class="service-sidebar">
                        <!-- Service List Box Start -->
                        <div class="service-list-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <h3>Categories</h3>
                            <div class="service-list-entry">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a @if(request('category_id') == $category->id) style="color: var(--color-pink);" @endif href="{{ route("services", ['category_id' => $category->id]) }}">{{ ucwords($category->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Service List Box End -->

                    </div>
                    <!-- Service Sidebar End -->
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @forelse($services as $service)
                            <div class="col-md-6">
                                <!-- Service Item Start -->
                                <div class="service-item-layout2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                    <a href="{{ route('service.show', $service->id) }}">
                                        <div class="service-image">
                                            <figure class="hover-anime">
                                                <img style="max-height: 500px; object-fit: cover;" src="{{ $service->getImage() }}" alt="">
                                            </figure>
                                        </div>
                                    </a>
                                    <div class="service-content">
                                        <h3>{{ ucwords($service->name) }}</h3>
                                        <p>{{ substr($service->description, 0, 100) }}...</p>
                                        <a href="{{ route("service.show", $service->id) }}" class="service-readmore">Read More</a>
                                    </div>
                                </div>
                                <!-- Service Item End -->
                            </div>
                        @empty
                            <h4 class="text-center">No service yet</h4>
                        @endforelse
                    </div>
                </div>

            </div>
            {{ $services->links('vendor.pagination.default', ['elements' => $services]) }}
        </div>
    </div>
    <!-- Services Lists End -->

    <!-- Testimonials Section Start -->
    <div class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Client Testimonials</h3>
                        <h2 class="text-anime">What Our Clients Say</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Testimonial Carousel Start -->
                    <div class="testimonial-carousel">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-slide">
                                        <div class="testimonial-header">
                                            <div class="author-img">
                                                <img src="{{ asset('assets/images/testimonial-user.png') }}" alt="">
                                            </div>

                                            <div class="author-info">
                                                <h3>Emma Johnson</h3>
                                                <div class="rating-star">
                                                    <img src="{{ asset('assets/images/icon-rating.svg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="testimonial-content">
                                            <p>
                                                Absolutely love the braids I got from Noelle! The stylists are so talented and took their time to make sure everything was perfect. My hair felt healthy and looked amazing. I’ll definitely be coming back for my next style!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-slide">
                                        <div class="testimonial-header">
                                            <div class="author-img">
                                                <img src="{{ asset('assets/images/testimonial-user.png') }}" alt="">
                                            </div>

                                            <div class="author-info">
                                                <h3>Olivia Davis</h3>
                                                <div class="rating-star">
                                                    <img src="{{ asset('assets/images/icon-rating.svg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="testimonial-content">
                                            <p>
                                                I’ve been to a lot of braiding salons, but none compare to the level of care and attention I received here. My cornrows were flawless, and the atmosphere was so welcoming. Highly recommend this place to anyone looking for quality braiding!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-slide">
                                        <div class="testimonial-header">
                                            <div class="author-img">
                                                <img src="{{ asset('assets/images/testimonial-user.png') }}" alt="">
                                            </div>

                                            <div class="author-info">
                                                <h3>Emma Johnson</h3>
                                                <div class="rating-star">
                                                    <img src="{{ asset('assets/images/icon-rating.svg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="testimonial-content">
                                            <p>
                                                From the moment I walked in, I knew I was in good hands. The stylist listened to what I wanted and gave me the most beautiful box braids I’ve ever had. My friends keep asking where I got my hair done—thank you, Noelle!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-slide">
                                        <div class="testimonial-header">
                                            <div class="author-img">
                                                <img src="{{ asset('assets/images/testimonial-user.png') }}" alt="">
                                            </div>

                                            <div class="author-info">
                                                <h3>Olivia Davis</h3>
                                                <div class="rating-star">
                                                    <img src="{{ asset('assets/images/icon-rating.svg') }}" alt="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="testimonial-content">
                                            <p>
                                                I was nervous about getting my hair braided because my hair is thin, but the stylist was so gentle and knowledgeable. They gave me tips on how to care for my hair, and the braids turned out stunning. I’m a customer for life!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->
                            </div>

                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <!-- Testimonial Carousel End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials Section End -->

@endsection
