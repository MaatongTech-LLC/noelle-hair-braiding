@extends('layouts.main')
@section('title', 'Shop')
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
                                    <div class="char" style="display: inline-block;">S</div>
                                    <div class="char" style="display: inline-block;">h</div>
                                    <div class="char" style="display: inline-block;">o</div>
                                    <div class="char" style="display: inline-block;">p</div>
                                </div>

                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
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
    <div class="services-lists">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <!-- Service Sidebar Start -->
                    <div class="service-sidebar">
                        <!-- Service List Box Start -->
                        <div class="service-list-box wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                            <h3>Categories</h3>
                            <div class="service-list-entry">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a @if(request('category_id') == $category->id) style="color: var(--color-pink);" @endif href="{{ route("shop", ['category_id' => $category->id]) }}">{{ ucwords($category->name) }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Service List Box End -->

                    </div>
                    <!-- Service Sidebar End -->
                </div>
                <div class="col-lg-9">
                    <div class="row row-gap-1">

                        @forelse($products as $product)

                            <div class="col-md-6">
                                <!-- Product Item Start -->
                                <div class="post-item wow fadeInUp my-2" style="visibility: visible; animation-name: fadeInUp;">
                                    <!-- Post Featured Image Start -->
                                    <div class="post-featured-image">
                                        <a href="#">
                                            <figure class="hover-anime">
                                                <img src="{{ $product->getImage() }}" alt="">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- Post Featured Image End -->

                                    <!-- Post Header Start -->
                                    <div class="post-header">
                                        <h3><a href="{{ route('product', $product->id) }}">{{ ucwords($product->name) }}</a></h3>
                                        <div class="post-meta">
                                            <ul>
                                                <li><a style="color: var(--color-pink); font-weight: 500;" href="{{ route('product', $product->id) }}">${{ $product->price }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Post Header End -->

                                    <!-- Post Read More Button Start -->
                                    <div class="post-readmore">
                                        <a href="{{ route('product', $product->id) }}"><img src="{{ asset('assets/images/icon-shopping-cart.svg') }}" height="20px" alt=""></a>
                                    </div>
                                    <!-- Post Read More Button End -->
                                </div>
                                <!-- Product Item End -->
                            </div>
                        @empty
                            <h4 class="text-center">No product yet</h4>
                        @endforelse
                    </div>
                </div>

            </div>
            {{ $products->links('vendor.pagination.default', ['elements' => $products]) }}
        </div>
    </div>
    <!-- Products List End -->


@endsection
