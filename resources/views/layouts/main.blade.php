
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Awaiken">
    <!-- Page Title -->
    <title>{{ config('app.name', 'Noelle Professional Hair Braiding') }} - @yield('title')</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
    <!-- Google Fonts css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
    <!-- SlickNav css -->
    <link href="{{ asset('assets/css/slicknav.min.css')}}" rel="stylesheet">
    <!-- Swiper css -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css')}}">
    <!-- Font Awesome icon css-->
    <link href="{{ asset('assets/css/all.min.css')}}" rel="stylesheet" media="screen">
    <!-- Animated css -->
    <link href="{{ asset('assets/css/animate.css')}}" rel="stylesheet">
    <!-- Magnific css -->
    <link href="{{ asset('assets/css/magnific-popup.css')}}" rel="stylesheet">
    <!-- Main custom css -->
    <link href="{{ asset('assets/css/custom.css')}}" rel="stylesheet" media="screen">

    @stack('styles')
</head>

<body class="tt-magic-cursor">

<!-- Preloader Start -->
<div class="preloader">
    <div class="loading-container">
        <div class="loading"></div>
        <div id="loading-icon"><img style="150px; object-fit: cover;" src="{{ asset('assets/images/logo.png') }}" alt=""></div>
    </div>
</div>
<!-- Preloader End -->

<!-- Magic Cursor Start -->
<div id="magic-cursor">
    <div id="ball"></div>
</div>
<!-- Magic Cursor End -->

<div class="features-ticker">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p><i class="fa fa-location-dot"></i> Cincinnati 45240 Springdale, OH, United States</p>
            </div>
            <div class="col-md-3">
                <p><i class="fa fa-envelope"></i> info@noellehairbraiding.com </p>
            </div>
            <div class="col-md-3">
                <p><i class="fa fa-phone-alt"></i> +1 630-280-1143</p>
            </div>
            <div class="col-md-2">
                <div class="footer-menu">
                    <ul class="d-flex list-none">
                        <li><a href="https://www.facebook.com/share/1B8xbkxmfi/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.tiktok.com/t/ZP8Y4E6R5/"><i class="fab fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Header Start -->
<header class="main-header">
    <div class="header-sticky">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img height="135px" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                </a>
                <!-- Logo End -->

                <!-- Main Menu start -->
                <div class="collapse navbar-collapse main-menu">
                    <ul class="navbar-nav mr-auto" id="menu">
                        <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('about') }}">About us</a></li>
                        <li class="nav-item {{ request()->routeIs('services') || request()->routeIs('service.show') ? 'active' : '' }}"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                        <li class="nav-item {{ request()->routeIs('gallery') ? 'active' : '' }}"><a class="nav-link" href="{{ route('gallery') }}">Our Work</a></li>
                        <li class="nav-item {{ request()->routeIs('shop') ? 'active' : '' }}"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                        <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
{{--
                        <li class="nav-item {{ request()->routeIs('booking.post') ? 'active' : '' }} highlighted-menu"><a class="nav-link" href="#">Book Now</a></li>
--}}

                        @auth
                            <li class="nav-item  highlighted-menu"><a class="nav-link" href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('customer.dashboard')}}">My Account</a></li>
                        @endauth
                        @guest
                            <li class="nav-item {{ request()->routeIs('login') || request()->routeIs('register') ? 'active' : '' }} highlighted-menu"><a class="nav-link" href="{{ route('login') }}">Login / Register</a></li>
                        @endguest
                        @php
                            $subTotal = 0;
                            if(Auth::check()) {
                                $items = auth()->user()->cart()->with('product')->get();
                            } else {
                                $items = collect(Session::get('cart', []));
                            }
                        @endphp
                        <li class="nav-item submenu"><a class="nav-link" href="#"><img src="{{ asset('assets/images/icon-shopping-cart.svg') }}" height="15px" alt=""><sup style="font-weight: bold;">{{count($items)}}</sup></a>
                            <ul style="width: 250px;">

                                @forelse($items as $item)
                                    @php
                                        if(is_array($item)) {
                                             $item = (object) $item;
                                        }
                                        $subTotal += ($item->product->price * $item->quantity);
                                    @endphp
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center justify-content-between px-2" href="javascript:void(0)">
                                            <img src="{{ $item->product->getImage() }}" height="35px" alt="">
                                            <div class="text d-flex align-items-center g-1 px-2">
                                               <div class="mx-2">
                                                   <span class="text-capitalize">{{ $item->product->name }}</span><br>
                                                   <span class="price">Price: ${{ $item->product->price }}</span> <br>
                                                   <span class="quantity">Qty: {{ $item->quantity }}</span><br>
                                               </div>
                                                <form action="{{ route('cart.delete', $item->product_id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" style="color: white; background-color: var(--color-pink);" class="close border-0 btn btn-sm btn-danger delete-item" data-name="{{ $item->product->name }}">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="mx-auto text-center"><strong>Your Cart Is Empty</strong></li>
                                @endforelse
                                @if(count($items) > 0)
                                        <div class="px-2 mt-2 d-flex justify-content-between align-items-center">
                                            <a class="btn-default" style="background-color: #0a0c0d; color: #FFF;" href="{{ route('checkout', ['checkout_type' => 'products_order']) }}">Checkout</a>
                                            <a class="btn-default" style="background-color: #0a0c0d; color: #FFF;" href="{{ route('cart') }}">Cart</a>
                                        </div>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Main Menu End -->

                <div class="navbar-toggle"></div>
            </div>
        </nav>

        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->

@yield('content')


<!-- Footer Start -->
<footer class="footer">
    <!-- Footer Contact Information Section Start -->
    <div class="footer-contact-information">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Footer Contact Info Box Start -->
                    <div class="contact-info-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-location.svg') }}" alt="">
                        </div>

                        <h3>Our Location</h3>
                        <p>Noelle Professional Hair Braiding, <br>Cincinnati Ohio 45240<br> Springdale, OH, United States</p>
                    </div>
                    <!-- Footer Contact Info Box End -->
                </div>

                <div class="col-md-4">
                    <!-- Footer Contact Info Box Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.25s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-email-phone.svg') }}" alt="">
                        </div>

                        <h3>Get in Touch</h3>
                        <p>Phone: +1 630-280-1143 <br>Email: info@noellehairbraiding.com</p>
                    </div>
                    <!-- Footer Contact Info Box End -->
                </div>

                <div class="col-md-4">
                    <!-- Footer Contact Info Box Start -->
                    <div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
                        <div class="icon-box">
                            <img src="{{ asset('assets/images/icon-working-hours.svg') }}" alt="">
                        </div>

                        <h3>Working Hours</h3>
                        <p>Mon-Fri: 9:00 AM - 6:00 PM <br>Sat-Sun: 9:00 AM - 7:00 PM</p>
                    </div>
                    <!-- Footer Contact Info Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Contact Information Section End -->

    <!-- Main Footer Start -->
    <div class="footer-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <!-- Footer Logo Start -->
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/logo.png') }}" height="135px" alt="">
                    </div>
                    <!-- Footer Logo End -->

                    <!-- Footer Social Icons Start -->
                    <div class="footer-social">
                        <ul>
                            <li><a href="https://www.facebook.com/share/1B8xbkxmfi/"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="https://www.tiktok.com/t/ZP8Y4E6R5/"><i class="fab fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                    <!-- Footer Social Icons End -->
                </div>

                <div class="col-lg-8">
                    <!-- Footer Menu Start -->
                    <div class="footer-menu">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('services') }}">Services</a></li>
                            <li><a href="{{ route('gallery') }}">Our Work</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            <li><a href="{{ route('faq') }}">FAQs</a></li>
                            <li><a href="{{ route('terms-and-conditions') }}">Terms and conditions</a></li>

                        </ul>
                    </div>
                    <!-- Footer Menu End -->

                    <!-- Footer Copyright Start -->
                    <div class="copyright">
                        <p>Copyright &copy; {{ date('Y') . ' ' . config('app.name')}}. All Rights Reserved | Powered by <a href="https://maatonggroup.com/usa" target="_blank" style="color: var(--color-pink);">MaatongTech USA LLC</a></p>
                    </div>
                    <!-- Footer Copyright End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Main Footer End -->
</footer>
<!-- Footer End -->

<!-- Jquery Library File -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap js file -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- Validator js file -->
<script src="{{ asset('assets/js/validator.min.js') }}"></script>
<!-- SlickNav js file -->
<script src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
<!-- Swiper js file -->
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<!-- Counter js file -->
<script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<!-- Magnific js file -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- SmoothScroll -->
<script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
<!-- MagicCursor js file -->
<script src="{{ asset('assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/magiccursor.js') }}"></script>
<!-- Text Effect js file -->
<script src="{{ asset('assets/js/splitType.js') }}"></script>
<script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
<!-- Wow js file -->
<script src="{{ asset('assets/js/wow.js') }}"></script>
<!-- Main Custom js file -->
<script src="{{ asset('assets/js/function.js') }}"></script>
<script src="{{ asset('assets/js/jquery.datetimepicker.min.js') }}"></script>


<script src="{{ asset('assets/js/notify.min.js') }}"></script>

@stack("scripts")

<script>
    @if(Session::has('success'))
        $.notify("{{ session('success') }}", "success");
    @elseif(Session::has('error'))
        $.notify("{{ session('error') }}", "error");
    @endif
</script>
</body>
</html>
