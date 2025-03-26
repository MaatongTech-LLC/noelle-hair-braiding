@extends('layouts.main')
@section('title', 'Checkout')
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
                                    <div class="char" style="display: inline-block;">C</div>
                                    <div class="char" style="display: inline-block;">h</div>
                                    <div class="char" style="display: inline-block;">e</div>
                                    <div class="char" style="display: inline-block;">c</div>
                                    <div class="char" style="display: inline-block;">k</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">u</div>
                                    <div class="char" style="display: inline-block;">t</div>

                                </div>

                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </div>
                    <!-- Page Heading End -->
                </div>

                <div class="col-md-4 order-md-2 order-1">
                    <!-- Page Header Right Icon Start -->
                    <div class="page-header-icon-box wow fadeInUp" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                        <div class="page-header-icon">
                            <img src="{{ asset('assets/images/icon-shopping-cart.svg') }}" alt="">
                        </div>
                    </div>
                    <!-- Page Header Right Icon End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header Section End -->

    <!-- Products List Start -->
    <div class="get-in-touch">
        @if(request('checkout_type') == 'products_order')
            @php
                if(Auth::check()) {
                    $items = auth()->user()->cart()->with('product')->get();
                } else {
                    $items = collect(Session::get('cart', []));
                }
                $subTotal = 0;
            @endphp
           <div class="container">
               <div class="section_header mb-5 mt-3">
                   <h2>Billing / Shipping Information</h2>
               </div>
               <div class="contact-form wow fadeInUp" data-wow-delay="0.75s" style="visibility: visible; animation-delay: 0.75s; animation-name: fadeInUp;">

                   <form id="checkoutForm" action="{{ route('checkout.order.post') }}" method="POST">
                       @csrf
                       <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                       <input type="hidden" name="total_price" value="{{ $subTotal }}">
                      <div class="row">
                          <div class="col-lg-4 product_checkout_summary bg-white pt-5">
                              <div class="section_right aos-init aos-animate" data-aos="fade-right">
                                  <div class="billing_information">
                                      <ul class="billing_list_area mb-20" style="list-style: none;">
                                          <li><h4>Product Total</h4></li>
                                          @foreach($items as $item)
                                              @php
                                                  if(is_array($item)) {
                                                      $item = (object) $item;
                                                  }
                                                  $subTotal += ($item->product->price * $item->quantity);
                                              @endphp
                                              <div class="product_info">
                                                  <li class="d-flex align-items-center">
                                                      <a style="color: var(--color-pink)" href="{{ route('product', $item->product->id) }}">
                                                          <img src="{{ $item->product->getImage() }}" height="90px" width="90px" alt="">
                                                          <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                                      </a> <br>
                                                      <span class="ml-2">${{ ($item->product->price) * $item->quantity }}</span>
                                                  </li>
                                              </div>
                                          @endforeach
                                          <li>
                                              <h6>Cart Subtotal</h6>
                                              <h6>$<span class="total">{{ $subTotal }}</span></h6>
                                          </li>

                                          <li>
                                              <h5>Total</h5>
                                              <h5>$<span class="">{{ $subTotal }}</span></h5>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                         <div class="col-lg-8">
                             <div class="row">
                                 <h3>Client Information</h3>
                                 <div class="form-group col-md-6 mb-4">
                                     <input type="text" name="name" class="form-control" id="name" value="@auth {{ auth()->user()->name }} @endauth" placeholder="Name" required="">
                                 </div>

                                 <div class="form-group col-md-6 mb-4">
                                     <input type="email" name="email" class="form-control" id="email" value="@auth {{ auth()->user()->email }} @endauth" placeholder="Email" required="">
                                 </div>

                                 <div class="form-group col-md-6 mb-4">
                                     <input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone" required value="@auth {{ auth()->user()->phone }} @endauth">
                                 </div>

                                 <div class="form-group col-md-6 mb-4">
                                     <input type="text" name="state" class="form-control" id="state" placeholder="State" required>
                                 </div>

                                 <div class="form-group mb-4 col-md-6">
                                    <input id="city" class="form-control" name="city" placeholder="City / Town*" required>

                                </div>
                                <div class="form-group mb-4 col-md-6">
                                    <input id="street_address" class="form-control" name="street_address" placeholder="Street Address*" required>

                                </div>

                                 <div class="form-group col-md-6 mb-4">
                                     <input type="text" name="zipcode" id="zipcode" placeholder="ZIP Code" class="form-control">
                                 </div>

                                 <div class="row">
                                     <h3>Payment Method</h3>

                                     <div class="form-group col-md-6">
                                         <label for="paypal">PayPal <img height="35px" src="{{ asset('assets/images/gateway/paypal.jpg') }}" alt=""></label>
                                         <input type="radio" name="gateway" id="paypal" value="paypal" required>
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="stripe">Credit / Debit Card <img height="35px" src="{{ asset('assets/images/gateway/stripe.jpg') }}" alt=""></label>
                                         <input type="radio" name="gateway" id="stripe" value="stripe" required>
                                     </div>
                                 </div>
                                 <div class="col-md-12 mt-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required />
                                        <label class="form-check-label" for="">You agree to our <a href="{{ route('terms-and-conditions') }}" target="_blank" style="color: var(--color-pink);">Terms and Conditions</a> </label>
                                    </div>
                                   
                                </div>

                                 <div class="col-md-12 my-3">
                                     <button type="submit" class="btn-default">Pay Now</button>
                                 </div>

                             </div>
                         </div>
                      </div>
                   </form>
               </div>
           </div>
        @elseif(request('checkout_type') == 'appointment')

            @php
                $appointment = \App\Models\Appointment::with(['service'])->find(request('appointment_id'));
            @endphp
            <form action="{{ route('checkout.appointment.post') }}" method="post">
                @csrf
                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <div class="section_left aos-init aos-animate" data-aos="fade-left">
                                <div class="section_header">
                                    <h2>Billing Information</h2>
                                </div>
                                <div class="billing_form_area">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="full_name" value="@auth {{auth()->user()->name}} @endauth"
                                                   placeholder="First Name" required>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="email" value="@auth {{auth()->user()->email}} @endauth"
                                                   placeholder="Email Address*" required>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="phone" value="@auth {{auth()->user()->phone}} @endauth"
                                                   placeholder="Phone Number*" required>
                                        </div>
                                        <div class="col-md-12">
                                            <select id="inputState" class="form-select" name="country" required>
                                                <option selected="" disabled="">Your Country</option>
                                                <option value="USA">USA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <input id="city" class="form-control" name="city" placeholder="City / Town*" required>

                                        </div>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="state" value=""
                                                   placeholder="State*" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="zipcode" value=""
                                                   placeholder="Zip / Postcode*" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 product_checkout_summary">
                            <div class="section_right aos-init aos-animate" data-aos="fade-right">
                                <div class="billing_information">
                                    <ul class="billing_list_area mb-20">
                                        <li><span>Service Name</span> <span>Amount to pay</span></li>
                                        <div class="product_info">
                                            <li class="d-flex align-items-center"><a href="{{ route('service.show', $appointment->service->id) }}">
                                                    <img src="{{ $appointment->service->getImage() }}" height="80px" width="80px" alt="">
                                                    <span>{{ $appointment->service->name }}</span>
                                                </a> <span>${{ $appointment->payment_type == 'deposit' ? $appointment->service->deposit_price :  $appointment->service->price}}</span></li>
                                        </div>


                                        <li>
                                            <h5>Total</h5>
                                            <h5>$<span class="">{{ $appointment->payment_type == 'deposit' ? $appointment->service->deposit_price :  $appointment->service->price}}</span></h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container payment_section">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <div class="payment-methods mt-40">
                                <div class="row gy-4 gx-3">
                                    <div class="col-12">
                                        <h4 class=" mb-20">Select Payment Method</h4>
                                        <div class="payment-box mb-4">
                                            <div class="payment-options">
                                                <div class="row g-2">
                                                    <input type="hidden" name="gateway" value="">
                                                    <div class="col-4 col-md-3 col-xl-2">
                                                        <label class="paymentCheck" id="0" data-gateway="paypal" data-payment="1"
                                                               data-plan="" for="option1">
                                                            <img class="img-fluid custom___img"
                                                                 src="{{ asset('assets/images/gateway/paypal.jpg') }}"
                                                                 alt="gateway image">
                                                            <i class="fa-solid fa-check check custom___check tag d-none"
                                                               id="circle0"></i>
                                                        </label>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-xl-2">
                                                        <label class="paymentCheck" id="1" data-gateway="stripe" data-payment="2" data-plan="" for="option2">
                                                            <img class="img-fluid custom___img" src="{{ asset('assets/images/gateway/stripe.jpg') }}" alt="gateway image">
                                                            <i class="fa-solid fa-check check custom___check tag d-none" id="circle1"></i>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="common_btn">PAY NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        @endif

    </div>
    <!-- Products List End -->

    <div class="modal fade" id="stripeModal" tabindex="-1" aria-labelledby="stripeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="stripe-payment-form" action="{{ route('checkout.order.post') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="stripeModalLabel">Pay with Credit/Debit Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Stripe Card Element container -->
                        <div id="card-element"></div>
                        <!-- Error Message -->
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        <input type="hidden" name="name" value="@auth {{ auth()->user()->name }} @endauth">
                        <input type="hidden" name="email" value="@auth {{ auth()->user()->email }} @endauth">
                        <input type="hidden" name="total_price" value="{{ $subTotal }}">
                        <input type="hidden" name="city" value="">
                        <input type="hidden" name="state" value="">
                        <input type="hidden" name="zipcode" value="">
                        <input type="hidden" name="street_address" value="">
                        <input type="hidden" name="gateway" value="stripe">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

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
            $('#checkoutForm').on('submit', function(e) {

                e.preventDefault();

                const method = $('input[name="gateway"]:checked').val();
                if (method === 'stripe') {
                    // Open the Stripe modal
                    var stripeModal = new bootstrap.Modal(document.getElementById('stripeModal'));
                    stripeModal.show();

                } else if (method === 'paypal') {
                    // Process other payment methods (e.g. redirect to PayPal)
                    $('#checkoutForm')[0].submit();
                }
            });

            // Handle the Stripe payment form submission inside the modal
            const stripeForm = document.getElementById('stripe-payment-form');
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
    <script>
        $(document).ready(function(){
            $('#checkoutForm').on('submit', function(e) {

                $("#checkoutForm").find("input, select, textarea").each(function() {
                    let name = $(this).attr("name")
                    $(`#stripe-payment-form input[name="${name}"]`).val($(this).val());
                });

            });

        });
    </script>
@endpush


