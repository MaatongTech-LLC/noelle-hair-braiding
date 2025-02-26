@extends("layouts.main")
@section("title", "Forgot Password")
@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime" style="color: var(--color-pink)"><div class="line" style="display: block; text-align: start; width: 100%;">
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">F</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                    <div class="char" style="display: inline-block;">g</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">t</div>
                                </div>

                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">P</div>
                                    <div class="char" style="display: inline-block;">a</div>
                                    <div class="char" style="display: inline-block;">s</div>
                                    <div class="char" style="display: inline-block;">s</div>
                                    <div class="char" style="display: inline-block;">w</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                    <div class="char" style="display: inline-block;">d</div>
                                </div>
                            </div>
                        </h1><ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset("assets/images/icon-email.svg") }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>

    <div class="get-in-touch bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Forgot Password</h3>

                        <h2 class="text-anime">
                            <div class="line" style="display: block; text-align: center; width: 100%;">
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">C</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">n</div>
                                    <div class="char" style="display: inline-block;">n</div>
                                    <div class="char" style="display: inline-block;">e</div>
                                    <div class="char" style="display: inline-block;">c</div>
                                    <div class="char" style="display: inline-block;">t</div>

                                </div>

                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">T</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                </div>

                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">Y</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">u</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                </div>
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">A</div>
                                    <div class="char" style="display: inline-block;">c</div>
                                    <div class="char" style="display: inline-block;">c</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">u</div>
                                    <div class="char" style="display: inline-block;">n</div>
                                    <div class="char" style="display: inline-block;">t</div>

                                </div>
                            </div>
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <!-- Login Form start -->
                    <div class="auth-content wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                        <form id="loginForm" action="{{ route("forgot-password.post") }}" method="POST" data-toggle="validator" novalidate="true">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required="">
                                    @error('email')
                                    <div class="help-block with-errors">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-default">Send Link</button>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-5">
                                    <p>We will send you a link to your email address!</p>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- Login Form end -->
                </div>
            </div>
        </div>
    </div>

@endsection
