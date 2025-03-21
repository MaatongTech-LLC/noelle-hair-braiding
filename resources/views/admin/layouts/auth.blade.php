<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Caro Hair Braiding Admin |  @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/core/libs.min.css') }}" />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/aos/dist/aos.css') }}" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/hope-ui.min.css') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.min.css') }}" />
</head>
<body class="">
<!-- loader Start -->
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
<!-- loader END -->
<div class="wrapper">
    <section class="login-content">
        <div class="row m-0 align-items-center bg-white vh-100">
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-bottom alert-danger alert-dismissible fade show" role="alert">
                                        <span>{{ $error }}</span>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endforeach
                            @endif
                            @yield('content')
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 d-md-block d-none  p-0 mt-n1 vh-100 overflow-hidden">
                <img src="{{ asset('assets/img/hero/hero_bg_1_2.png') }}" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
        </div>
    </section>
</div>
<!-- Library Bundle Script -->
<script src="{{ asset('admin/assets/js/core/libs.min.js')}}"></script>

<!-- External Library Bundle Script -->
<script src="{{ asset('admin/assets/js/core/external.min.js')}}"></script>

<!-- Widgetchart Script -->
<script src="{{ asset('admin/assets/js/charts/widgetcharts.js')}}"></script>

<!-- mapchart Script -->
<script src="{{ asset('admin/assets/js/charts/vectore-chart.js')}}"></script>
<script src="{{ asset('admin/assets/js/charts/dashboard.js')}}" ></script>

<!-- fslightbox Script -->
<script src="{{asset('admin/assets/js/plugins/fslightbox.js')}}"></script>

<!-- Settings Script -->
<script src="{{ asset('admin/assets/js/plugins/setting.js')}}"></script>

<!-- Slider-tab Script -->
<script src="{{ asset('admin/assets/js/plugins/slider-tabs.js')}}"></script>

<!-- Form Wizard Script -->
<script src="{{ asset('admin/assets/js/plugins/form-wizard.js')}}"></script>

<!-- AOS Animation Plugin-->
<script src="{{ asset('admin/assets/vendor/aos/dist/aos.js')}}"></script>

<!-- App Script -->
<script src="{{ asset('admin/assets/js/hope-ui.js')}}" defer></script>

</body>
</html>
