@extends("layouts.main")
@section("title", "Contact")

@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)"><div class="line" style="display: block; text-align: start; width: 100%;">
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">C</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">n</div>
                                    <div class="char" style="display: inline-block;">t</div>
                                    <div class="char" style="display: inline-block;">a</div>
                                    <div class="char" style="display: inline-block;">c</div>
                                    <div class="char" style="display: inline-block;">t</div>
                                </div>
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">U</div>
                                    <div class="char" style="display: inline-block;">s</div>
                                </div>
                            </div>
                        </h1><ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset("assets/images/icon-contact.svg") }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>

    <div class="contact-information">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Contact Box Start -->
                    <div class="contact-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="icon-box">
                            <img src="{{ asset("assets/images/icon-address.svg") }}" alt="">
                        </div>

                        <h3>Address</h3>
                        <p>Cincinnati Ohio 45240<br> Springdale, OH, United States</p>
                    </div>
                    <!-- Contact Box End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Contact Box Start -->
                    <div class="contact-box wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                        <div class="icon-box">
                            <img src="{{ asset("assets/images/icon-phone.svg") }}" alt="">
                        </div>

                        <h3>Phone</h3>
                        <p>+1 630-280-1143</p>
                    </div>
                    <!-- Contact Box End -->
                </div>


                <div class="col-lg-4 col-md-6">
                    <!-- Contact Box Start -->
                    <div class="contact-box wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                        <div class="icon-box">
                            <img src="{{ asset("assets/images/icon-email.svg") }}" alt="">
                        </div>

                        <h3>Email</h3>
                        <p>contact@noellehairbraiding.com</p>
                    </div>
                    <!-- Contact Box End -->
                </div>
            </div>
        </div>
    </div>

    <div class="get-in-touch">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Contact Form</h3>

                        <h2 class="text-anime">
                            <div class="line" style="display: block; text-align: center; width: 100%;">
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">G</div>
                                    <div class="char" style="display: inline-block;">e</div>
                                    <div class="char" style="display: inline-block;">t</div>
                                </div>
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">I</div>
                                    <div class="char" style="display: inline-block;">n</div>
                                </div>
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">T</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">u</div>
                                    <div class="char" style="display: inline-block;">c</div>
                                    <div class="char" style="display: inline-block;">h</div>
                                </div>
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">W</div>
                                    <div class="char" style="display: inline-block;">i</div>
                                    <div class="char" style="display: inline-block;">t</div>
                                    <div class="char" style="display: inline-block;">h</div>
                                </div>
                                <div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);">
                                    <div class="char" style="display: inline-block;">U</div>
                                    <div class="char" style="display: inline-block;">s</div>
                                </div>
                            </div>
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <!-- Contact Form start -->
                    <div class="contact-form wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                        <form id="contactForm" action="{{ route("contact.post") }}" method="POST" data-toggle="validator" novalidate="true">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" required="">
                                    @error('name')
                                        <div class="help-block with-errors">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" required="">
                                    @error('email')
                                        <div class="help-block with-errors">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="">
                                    @error('phone')
                                        <div class="help-block with-errors">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6 mb-4">
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required="">
                                    @error('subject')
                                        <div class="help-block with-errors">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 mb-4">
                                    <textarea name="message" class="form-control" id="msg" rows="4" placeholder="Write a Message" required=""></textarea>
                                    @error('message')
                                        <div class="help-block with-errors">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-default">Submit Now</button>
                                    <div id="msgSubmit" class="h3 text-left hidden"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form end -->
                </div>
            </div>
        </div>
    </div>

    <div class="google-map">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="google-map-iframe">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3089.9041698457067!2d-84.6058727!3d39.245047!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88404a7ebec4ab21%3A0x64051f5e6a33aa85!2sSpringdale%20Rd%2C%20Ohio%2C%20USA!5e0!3m2!1sen!2scm!4v1740500970694!5m2!1sen!2scm" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
            </div>
        </div>
    </div>

@endsection
