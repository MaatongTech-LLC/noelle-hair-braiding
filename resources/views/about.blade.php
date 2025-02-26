@extends("layouts.main")
@section("title", "About Us")
@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)"><div class="line" style="display: block; text-align: start; width: 100%;"><div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">A</div><div class="char" style="display: inline-block;">b</div><div class="char" style="display: inline-block;">o</div><div class="char" style="display: inline-block;">u</div><div class="char" style="display: inline-block;">t</div></div> <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">U</div><div class="char" style="display: inline-block;">s</div></div></div></h1><ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About us</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.50s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset('assets/images/icon-about.svg') }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>

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
                                        <h4 class="counter">2019</h4>
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
                            At <strong style="color: var(--primary-color)">Noelle</strong>
                            <span style="color: var(--color-pink); font-weight: bold;">Professional Hair Braiding</span>,
                            we specialize in creating stunning, custom braided hairstyles
                            that reflect your personality and style. Our skilled stylists are passionate about hair
                            artistry   and dedicated to providing you with a comfortable, luxurious experience.
                            Whether you're looking for classic box braids, intricate cornrows, or trendy twists,
                            we’re here to bring your vision to life.
                        </p>
                    </div>
                    <!-- About Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- About us Section End -->
    {{--    Our Goal Section Start --}}
    <div class="our-goal">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Our Goal</h3>

                        <h2 class="text-anime"><div class="line" style="display: block; text-align: center; width: 100%;"><div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">C</div><div class="char" style="display: inline-block;">o</div><div class="char" style="display: inline-block;">m</div><div class="char" style="display: inline-block;">p</div><div class="char" style="display: inline-block;">a</div><div class="char" style="display: inline-block;">n</div><div class="char" style="display: inline-block;">y</div></div> <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">G</div><div class="char" style="display: inline-block;">o</div><div class="char" style="display: inline-block;">a</div><div class="char" style="display: inline-block;">l</div></div></div></h2></div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <!-- Goal Item Start -->
                    <div class="goal-item wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="goal-image">
                            <figure class="hover-anime">
                                <img src="{{ asset('assets/images/photo-1.jpg') }}" alt="">
                            </figure>
                        </div>

                        <div class="goal-content">
                            <div class="goal-icon">
                                <img src="{{ asset('assets/images/icon-mission.svg') }}" alt="">
                            </div>

                            <h3>Our Mission</h3>
                            <p>
                                To provide exceptional braiding services that enhance our clients' natural beauty while
                                promoting healthy hair care practices. We strive to create a welcoming and inclusive space
                                where everyone feels valued and confident.
                            </p>
                        </div>
                    </div>
                    <!-- Goal Item End -->
                </div>

                <div class="col-lg-4">
                    <!-- Goal Item Start -->
                    <div class="goal-item wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                        <div class="goal-image">
                            <figure class="hover-anime">
                                <img src="{{ asset('assets/images/photo-2.jpg') }}" alt="">
                            </figure>
                        </div>

                        <div class="goal-content">
                            <div class="goal-icon">
                                <img src="{{ asset('assets/images/icon-vision.svg') }}" alt="">
                            </div>

                            <h3>Our Vision</h3>
                            <p>
                                To be the leading hair braiding salon where creativity, quality, and client
                                satisfaction come together to redefine beauty and self-expression.
                            </p>
                        </div>
                    </div>
                    <!-- Goal Item End -->
                </div>

                <div class="col-lg-4">
                    <!-- Goal Item Start -->
                    <div class="goal-item wow fadeInUp" data-wow-delay="1.0s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                        <div class="goal-image">
                            <figure class="hover-anime">
                                <img src="{{ asset('assets/images/photo-3.jpg') }}" alt="">
                            </figure>
                        </div>

                        <div class="goal-content">
                            <div class="goal-icon">
                                <img src="{{ asset('assets/images/icon-approach.svg') }}" alt="">
                            </div>
                            <h3>Our Approach</h3>
                            <p>
                                We combine personalized care, expert techniques, and high-quality products to
                                create stunning braided styles that enhance your natural beauty.
                            </p>
                        </div>
                    </div>
                    <!-- Goal Item End -->
                </div>
            </div>
        </div>
    </div>
{{--    Our Goal Section End --}}
@endsection
