@extends("layouts.main")
@section("title", "Home")
@section("content")
    <!-- Hero Section Start -->
    <div class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Hero Left Content Start -->
                    <div class="hero-content">
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Welcome to</h3>
                            <h1 class="text-anime">Noelle<br><span style="color: var(--color-pink);">Professional Hair Braiding</span></h1>
                        </div>
                        <div class="hero-content-body wow fadeInUp" data-wow-delay="0.5s">
                            <p>Expert braiding services tailored to your unique look. Book your appointment today!</p>
                        </div>

                        <div class="hero-content-footer wow fadeInUp" data-wow-delay="0.75s">
                            <a href="{{ route('services') }}" class="btn-default dark-bg">Book Now</a>
                            <a href="{{ route('contact') }}" class="btn-default dark-bg">Contact Now</a>
                        </div>
                    </div>
                    <!-- Hero Left Content End -->
                </div>

                <div class="col-lg-6">
                    <!-- Hero Image Start -->
                    <div class="hero-image wow fadeInUp" data-wow-delay="0.75s">
                        <figure class="hover-anime">
                            <img src="{{ asset('assets/images/hero-img.jpg') }}" alt="">
                        </figure>
                    </div>
                    <!-- Hero Image End -->
                </div>
            </div>

            <!-- Hero Scroll Down Arrow Start -->
            <div class="row">
                <div class="col-md-12 scrollsp">
                    <a href="#aboutus" class="scroll-down"><span></span></a>
                </div>
            </div>
            <!-- Hero Scroll Down Arrow End -->
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- Features Ticker Section Start -->
    <div class="features-ticker">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Features Ticker Start -->
                    <div class="feature-ticker-box">
                        <div class="feature-ticker-content">
                            <ul>
                                @foreach(App\Models\ServiceCategory::all()->take(15) as $category)
                                    <li><img src="{{ asset('assets/images/ticker-icon.svg') }}" alt="{{ $category->name }}"> {{ ucwords($category->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="feature-ticker-content">
                            <ul>
                                @foreach(App\Models\ServiceCategory::all()->take(15) as $category)
                                    <li><img src="{{ asset('assets/images/ticker-icon.svg') }}" alt="{{ $category->name }}"> {{ ucwords($category->name) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- Features Ticker End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Features Ticker Section End -->

    <!-- About us Section Start -->
    <div class="about-us-section" id="aboutus">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Left Image Start -->
                    <div class="about-image">
                        <div class="row">
                            <div class="col-7">
                                <div class="about-img right-shape">
                                    <figure class="reveal hover-anime">
                                        <img style="height: 380px !important;" src="{{ asset('assets/images/about-img-2.jpg') }}" alt="">
                                    </figure>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="about-year-image">
                                    <div class="about-year">
                                        <p>Since</p>
                                        <h4 class="counter">2014</h4>
                                    </div>

                                    <div class="about-img left-shape">
                                        <figure class="reveal hover-anime">
                                            <img style="height: 250px!important;" src="{{ asset('assets/images/about-img-1.jpg') }}" alt="">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- About Left Image End -->
                </div>

                <div class="col-lg-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">About Noelle Professional Hair Braiding</h3>
                        <h2 class="text-anime">Where Art Meets Hair</h2>
                    </div>
                    <!-- Section Title End -->

                    <!-- About Content Start -->
                    <div class="about-content wow fadeInUp" data-wow-delay="0.75s">
                        <p>
                            At <strong style="color: var(--primary-color)">Noelle</strong> <span style="color: var(--color-pink); font-weight: bold;">Professional Hair Braiding</span>, we specialize in creating stunning, custom braided hairstyles
                            that reflect your personality and style. Our skilled stylists are passionate about hair
                            artistry and dedicated to providing you with a comfortable, luxurious experience.
                            Whether you're looking for classic box braids, intricate cornrows, or trendy twists,
                            we’re here to bring your vision to life.
                        </p>


                        <a href="{{ route('about') }}" class="btn-default">Read More</a>
                    </div>
                    <!-- About Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About us Section End -->

    <!-- Homer Services Section Start -->
    <div class="home-services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Professional Services</h3>
                        <h2 class="text-anime">We are Expert in</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">


                <div class="col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item-layout1 wow fadeInUp" data-wow-delay="0.75s">
                        <div class="service-icon">
                            <img src="{{ asset('assets/images/service-3.svg') }}" alt="">
                        </div>

                        <h3>Hair Braiding</h3>
                        <p>Transform Your Look with Expert Braiding</p>
                    </div>
                    <!-- Service Item End -->
                </div>

                <div class="col-md-6">
                    <!-- Service Item Start -->
                    <div class="service-item-layout1 wow fadeInUp" data-wow-delay="1.0s">
                        <div class="service-icon">
                            <img src="{{ asset('assets/images/service-2.svg') }}" alt="">
                        </div>

                        <h3>Hair Care</h3>
                        <p>Healthy Hair, Beautiful Styles</p>
                    </div>
                    <!-- Service Item End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Homer Services Section End -->

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

    <!-- Pricing Section Start -->
    <div class="pricing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Price List</h3>
                        <h2 class="text-anime">Our Best Prices</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                @php
                    $step = 50;
                @endphp
                @foreach($services as $service)

                    <div class="col-lg-4 col-md-6">
                        <!-- Pricing Item Start -->
                        <a href="{{ route('service.show', $service->id) }}" class="text">
                            <div class="pricing-item wow fadeInUp" data-wow-delay="0.{{$step}}s">
                                <div class="pricing-info">
                                    <h3>{{ ucwords($service->name) }}</h3>
                                    <p>{{ substr($service->description, 0, 100) }}...</p>
                                </div>

                                <div class="pricing-price">
                                    <p>${{ $service->price }}</p>
                                </div>
                            </div>
                        </a>
                        <!-- Pricing Item End -->
                    </div>
                    @php
                        $step+=10;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
    <!-- Pricing Section End -->

@endsection

@push("scripts")

@endpush
