@extends('layouts.main')
@section('title', 'Product ' . $product->name)
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
                                    @foreach(explode(" ", ucwords($product->name)) as $char)
                                        <div class="char" style="display: inline-block;">{{ $char }}</div>
                                    @endforeach
                                </div>

                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product: {{$product->name}}</li>
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
    <div class="page-service-single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Service Content Start -->
                    <form action="{{ route('cart.post') }}" method="POST" id="productForm">
                        @csrf
                        <div class="service-content d-flex justify-content-between g-2">
                            <div class="service-image">
                                <figure class="hover-anime">
                                    <img style="max-height: 700px; width: 700px; object-fit: cover;" src="{{ $product->getImage() }}" alt="{{ $product->name }}">
                                </figure>
                            </div>

                           <div>
                               <div class="service-entry">
                                   <h2>  {{ ucwords($product->name) }}</h2>
                                   <h4>Price: <sup style="color: var(--color-pink)">${{ $product->price }}</sup></h4>

                                   <div class="w-50">
                                       {!! $product->description !!}
                                   </div>
                                   <div class="d-flex my-4 btn-group">
                                       <button type="button" onclick="decrement()" class="btn-default">-</button>
                                       <span id="counting" class="p-2">1</span>
                                       <button type="button" onclick="increment()" class="btn-default">+</button>
                                   </div>
                               </div>
                               <div class="mt-3">
                                   <input type="hidden" name="quantity" id="productQty">
                                   <input type="hidden" name="product_id" value="{{ $product->id }}">
                                   <button type="submit" class="btn-default">Add To Cart</button>
                               </div>
                           </div>
                        </div>
                    </form>
                    <!-- Service Content End -->

                </div>
            </div>
        </div>
    </div>
    <!-- Products List End -->

@endsection

@push('scripts')
    <script>
        'use script';
        var data = 1;
        var stockQty = {{ $product->stock }};
        document.getElementById("counting").innerText = data;

        function increment() {

            if (data <= stockQty) {
                data = parseInt(data + 1);
                document.getElementById("counting").innerText = data;
            }

        }

        function decrement() {
            if (data > 1) {
                data = data - 1;
                document.getElementById("counting").innerText = data;
            }

        }

        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();

            $('#productQty').val(data);

            e.target.submit();

        });


    </script>
@endpush
