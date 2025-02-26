@extends("layouts.main")
@section("title", "Terms and conditions")

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
                                    <div class="char" style="display: inline-block;">Terms</div>
                                    <div class="char" style="display: inline-block;">And </div>
                                    <div class="char" style="display: inline-block;">Conditions</div>

                                </div>
                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Terms and conditions</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset('assets/images/icon-faq.svg') }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>


    <div class="blog-single-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Post Content Start -->
                    <div class="post-content wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <!-- Post Entry Start -->
                        <div class="post-entry">

                            <h2>BOOKING POLICY</h2>
                            <h6>Please Kindly Read Carefully Before Booking</h6>
                            <h6 class="mt-1">This policy applies to everyone! NO EXCEPTION!!!!.</h6>

                            <p>
                                For Every Style, a <strong>$20 NON-REFUNDABLE Deposit</strong> is Required Before Booking, which Goes Towards Your hairstyle and the Remaining  Balance is Due By Zelle Or In Cash right after service.
                                If You have to Cancel Your Appointment Within 24 hours, Deposit Will Not Be REFUNDABLE to you.
                                <br>
                                NO Call and No Shows will Be Banned From Booking In the Future.
                                Rescheduling your appointment must be done one time and must be done 48 hours before the appointment.
                                PLEASE arrive on time for your scheduled appointment.  Late appointment after 30 minutes WILL be canceled or rescheduled.
                                <br>
                                If on our behalf we have to cancel, your full deposit will be fully refunded to you or can be used if you choose to reschedule. Let’s do our best to respect each other time.
                                If this is your first time being serviced and you have trouble locating the area or finding parking, please contact us by phone for directions before the appointment time.
                                NO EXTRA guest for your scheduled appointment. Space is limited, and there are no children. Extra guests are only permitted if the client is getting serviced after you.

                            </p>

                            <h2>PRICE & FEES</h2>
                            <ul>
                                <li>Very short hair</li>
                                <li>Complex braiding styles</li>
                                <li>Hair washing or blow drying if not done beforehand</li>
                            </ul>

                            <h2>RECOMMENDED HAIR BRAND</h2>
                            <h6>Please read the description down below to see what hair to buy for your selected style as we do not provide these hair at the moment.</h6>

                            <ul>
                                <li> For Marley or kinky twist style and Faux Locs, please buy the CUBAN TWIST BRAIDS.</li>
                                <li>For passion twists and any goddess or bohemian style, please buy the brand: FREETRESS BRAID CROCHET IN WATER WAVE OR DEEP TWIST</li>
                            </ul>



                            Pictures will be provided for each service to guide you in making a choice that is perfect for you as well as RECOMMENDED hair to be purchased for certain particular services with hair not included.

                            <h2 class="text-uppercase">Communication is very important!! </h2>
                            You will receive or be sent a text a day before your appointment as a reminder.

                            <h2> PREPARING YOUR HAIR FOR YOUR APPOINTMENT</h2>

                            To provide the best result, all hair must be washed, blow out from the root, and product free for all braiding services. A $10 extra fee will be charged to blow dry your hair if not done properly before your appointment.

                            Please be advised that all synthetic hair may cause an allergic reaction to certain people. If you have any allergies to any braiding hair, please let us know prior to your appointment date to help prevent that.

                           <h2 class="text-uppercase">Caution!!</h2>
                            <h5>Short hair: </h5>
                            <ul>
                                <li>Clients with short hair : should contact us with pictures before setting up an appointment.</li>
                                <li>An extra fee will be charged on top of the service you select for short hair.</li>
                                <li>To ensure a smooth and quick service, please avoid any forms of hair products or oils.</li>
                                <li> In the event of your scheduled appointment, and we are unable to grip it, your deposit will be refunded to you.</li>
                            </ul>



                            <ul>
                                <li>We believe that hair braiding is a fashionable accessory and form of art.</li>
                                <li>Braids allow people to express their styles to connect to the world. Our experienced hairdressers provide neat, gorgeous,
                                    and stunning styles to make our clients feel confident and beautiful with a long- lasting trend at affordable prices.</li>
                            </ul>

                            <h6>BY BOOKING AN APPOINTMENT YOU AGREE THAT YOU HAVE READ AND UNDERSTAND ALL OUR POLICIES AND READY TO PROCEED.</h6>

                            If the information provided hasn’t answered your question, feel free to message us, or you can use the
                            <a style="color: var(--color-pink)" href="{{ route('faq') }}">Q & A section</a>.

                            THANK YOU FOR CHOOSING NOELLE PROFESSIONAL HAIR BRAIDING

                            CAN’T WAIT TO SEE YOU QUEENS!!!!


                        </div>
                        <!-- Post Entry End -->

                        <!-- Post Extra Info Start -->
                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Post Tags Start -->
                                <div class="post-tags">
                                    Links :
                                    <a href="{{ route('home') }}">Home</a>
                                    <a href="{{ route('about') }}">About Us</a>
                                    <a href="{{ route('services') }}">Services</a>

                                </div>
                                <!-- Post Tags End -->
                            </div>

                            <div class="col-lg-4">
                                <!-- Post Sharing Links Start -->
                                <div class="post-social-sharing">
                                    <ul>
                                        <li><a href="https://www.facebook.com/share/1B8xbkxmfi/"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.tiktok.com/t/ZP8Y4E6R5/"><i class="fab fa-tiktok"></i></a></li>
                                    </ul>
                                </div>
                                <!-- Post Sharing Links End -->
                            </div>
                        </div>
                        <!-- Post Extra Info End -->
                    </div>
                    <!-- Post Content End -->
                </div>
            </div>
        </div>
    </div>
@endsection
