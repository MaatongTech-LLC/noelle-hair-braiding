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
                            <h4>Duration: <sup style="color: var(--color-pink)">{{ $service->duration }}</sup></h4>
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
                            <button class="btn-default"  type="button" data-bs-toggle="modal" data-bs-target="#bookingModal">Book Now</button>

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

    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Book Your Service <strong>"{{ $service->name }}"</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="auth-content" >
                        <form id="bookingForm" action="{{ route("checkout.appointment.post") }}" method="POST">
                            @csrf
                            <div class="row">

                                <input type="hidden" value="{{ $service->id }}" name="service_id">
                                <div class="form-group col-12 mb-2">
                                    <label class="mb-2" for="name">Full name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter your name" @auth value="{{ auth()->user()->name }}" @endauth required autocomplete="off"/>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <label class="mb-2" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Enter your email" @auth value="{{ auth()->user()->email }}" @endauth required autocomplete="off"/>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <label class="mb-2" for="datepicker">Date</label>
                                    <input type="text" class="date-pick form-control" name="date" id="datepicker"
                                           placeholder="Select Date" required autocomplete="off"/>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <label class="mb-2" for="timepicker">Time</label>
                                    <input type="text" class="time-pick form-control" name="time" id="timepicker"
                                           placeholder="Select Time" required autocomplete="off"/>
                                </div>

                               <div class="col-12 mt-4 d-flex align-items-center justify-content-between">
                                   <div class="wc_payment_method payment_method_cod">
                                       <input id="price" type="radio" class="input-radio" value="full_price" name="payment_type" required> <label
                                           for="price">Pay full amount <strong>(${{ $service->price }})</strong></label>
                                       <div class="payment_box payment_method_cod"><p>Pay the service full amount.</p></div>
                                   </div>
                                   <div class="wc_payment_method payment_method_cod">
                                       <input id="deposit_price" type="radio" class="input-radio" value="deposit" name="payment_type" required> <label
                                           for="deposit_price">Pay deposit <strong>(${{ $service->deposit_price }})</strong></label>
                                       <div class="payment_box payment_method_cod"><p>Pay for the booking deposit (Not Refundable).</p></div>
                                   </div>
                               </div>

                                <div class="row my-3">
                                    <h5>Payment Method</h5>

                                    <div class="form-group col-md-6">
                                        <label for="paypal">PayPal <img height="35px" src="{{ asset('assets/images/gateway/paypal.jpg') }}" alt=""></label>
                                        <input type="radio" name="gateway" id="paypal" value="paypal">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="stripe">Credit / Debit Card <img height="35px" src="{{ asset('assets/images/gateway/stripe.jpg') }}" alt=""></label>
                                        <input type="radio" name="gateway" id="stripe" value="stripe">
                                    </div>
                                </div>

                                <div id="stripeCard" class="d-none py-3">
                                    <!-- Stripe Card Element container -->
                                    <div class="form-group" id="card-element"></div>
                                    <!-- Error Message -->
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-default">Checkout</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">
    <style>
        .xdsoft_datetimepicker {
            z-index: 9999 !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('#datepicker').datetimepicker({
            timepicker: !1,
            datepicker: !0,
            format: "Y-m-d",
            startDate: new Date(),
            maxDate: new Date().setDate(new Date().getDate() +30),
            minDate: 0,
            step: 10
        });

        $("#timepicker").datetimepicker({
            datepicker: !1,
            timepicker: !0,
            format: "H:i",
            step: 30,
            minTime: '9:00',
            maxTime: '18:00'
        });
    </script>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Stripe and Elements
            const stripe = Stripe('{{ env('STRIPE_KEY') }}');
            const elements = stripe.elements();
            const card = elements.create('card');
            card.mount('#card-element');

            // Handle real-time validation errors on the card Element.
            card.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Listen for the payment method form submission
            $('#bookingForm').on('submit', function(e) {

                e.preventDefault();

                const method = $('input[name="gateway"]:checked').val();
                if (method === 'stripe') {
                    // Open the Stripe modal
                    $('#stripeCard').removeClass('d-none');

                } else if (method === 'paypal') {
                    // Process other payment methods (e.g. redirect to PayPal)
                    $('#stripeCard').addClass('d-none');
                    $('#bookingForm')[0].submit();
                }
            });

            // Handle the Stripe payment form submission inside the modal
            const stripeForm = document.getElementById('bookingForm');
            stripeForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                // Create a Stripe token
                const {token, error} = await stripe.createToken(card);
                if (error) {
                    // Display error in the card-errors element
                    document.getElementById('card-errors').textContent = error.message;
                } else {
                    // Append the token to the form and submit to Laravel
                    let hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    stripeForm.appendChild(hiddenInput);
                    stripeForm.submit();
                }
            });
        });
    </script>
@endpush
