@extends("layouts.main")
@section("title", "FAQ")

@section("content")
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-md-1 order-2">
                    <!-- Page Heading Start -->
                    <div class="page-header-box">

                        <h1 class="text-anime" style="color: var(--color-pink)"><div class="line" style="display: block; text-align: start; width: 100%;"><div class="word" style="display: inline-block; opacity: 1; visibility: inherit; transform: translate(0px, 0px);"><div class="char" style="display: inline-block;">F</div><div class="char" style="display: inline-block;">A</div><div class="char" style="display: inline-block;">Q</div><div class="char" style="display: inline-block;">'</div><div class="char" style="display: inline-block;">s</div></div></div></h1><ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQs</li>
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


    <div class="page-faqs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <!-- FAQ Accordion Start -->
                    <div class="faq-accordion">
                        <div class="accordion" id="faq_accordion">
                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                                <h2 class="accordion-header" id="heading1"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">How can I book an appointment at your salon?</button></h2>

                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faq_accordion">
                                    <div class="accordion-body">
                                        <p>Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">
                                <h2 class="accordion-header" id="heading4"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">Do you offer any discounts or promotions?</button></h2>

                                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faq_accordion">
                                    <div class="accordion-body">
                                        <p>Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="1.0s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                                <h2 class="accordion-header" id="heading5"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">Do you offer hair consultations?</button></h2>

                                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faq_accordion">
                                    <div class="accordion-body">
                                        <p>Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="1.25s" style="visibility: visible; animation-delay: 1.25s; animation-name: fadeInUp;">
                                <h2 class="accordion-header" id="heading6"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">How often should I get my hair cut?</button></h2>

                                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faq_accordion">
                                    <div class="accordion-body">
                                        <p>Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.</p>
                                    </div>
                                </div></div>
                            <!-- FAQ Item End -->

                            <!-- FAQ Item Start -->
                            <div class="accordion-item wow fadeInUp" data-wow-delay="1.75s" style="visibility: visible; animation-delay: 1.75s; animation-name: fadeInUp;">
                                <h2 class="accordion-header" id="heading8"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">What services do you offer at your salon?</button></h2>

                                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#faq_accordion">
                                    <div class="accordion-body">
                                        <p>Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- FAQ Item End -->
                        </div>
                    </div>
                    <!-- FAQ Accordion End -->
                </div>
            </div>
        </div>
    </div>

@endsection
