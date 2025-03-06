@extends('layouts.main')
@section('title', 'Cart')
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
                                    <div class="char" style="display: inline-block;">a</div>
                                    <div class="char" style="display: inline-block;">r</div>
                                    <div class="char" style="display: inline-block;">t</div>
                                </div>

                            </div>
                        </h1>
                        <ol class="breadcrumb wow fadeInUp" data-wow-delay="0.25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="{{ route("home") }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-2">
                                <div class="section_header">
                                    Image
                                </div>
                            </th>
                            <th class="col-2">
                                <div class="section_header">
                                    Product Name
                                </div>
                            </th>
                            <th class="col-2">
                                <div class="section_header">
                                    Price
                                </div>
                            </th>

                            <th class="col-2">
                                <div class="section_header">
                                    Quantity
                                </div>
                            </th>
                            <th class="col-2">
                                <div class="section_header">
                                    Total
                                </div>
                            </th>
                            <th class="col-2">
                                <div class="section_header">
                                    Remove
                                </div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $subtotal = 0;
                            if(Auth::check()) {
                                $items = auth()->user()->cart()->with('product')->get();
                            } else {
                                $items = collect(Session::get('cart', []));
                            }
                        @endphp
                        @foreach($items as $item)
                            @php
                                if(is_array($item)) {
                                         $item = (object) $item;
                                }
                            @endphp
                            <tr data-item="product" data-stock="{{ $item->product->stock }}" data-total="{{ floatval($item->product->price * $item->quantity) }}" data-price="{{ $item->product->price }}">
                                <th scope="row">
                                    <div class="image_area"><img
                                            src="{{ $item->product->getImage() }}"
                                            alt=""></div>
                                </th>
                                <td>
                                    <div class="table_data">
                                        {{ $item->product->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="table_data">
                                        ${{ $item->product->price }}
                                    </div>
                                </td>
                                <td>
                                    <div class="in_de_counter_area d-flex">
                                        <button class="btn btn-secondary" data-item="minus">-</button>
                                        <span id="counting" class="px-2" data-item="quantity">{{ $item->quantity }}</span>
                                        <button class="btn btn-secondary" data-item="plus">+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="table_data" data-total-value="{{ number_format(floatval($item->product->price * $item->quantity), 2) }}">
                                        ${{ number_format(floatval($item->product->price * $item->quantity), 2) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="bin_area">
                                        <form action="{{ route('cart.delete', $item->product->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa-regular fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="coupon_area">
                <div class="row g-lg-4 g-3 coupon_inner">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="contineu_shopping_btn"><a href="{{ route('shop') }}"
                                                              class="btn-default d-flex align-items-center justify-content-center">CONTINUE
                                SHOPPING</a></div>
                        <div class="update_cart_btn">
                            <form action="{{ route('cart.clear') }}" method="post">
                                @csrf
                                @method('DELETE')
                                @if (count($items) > 0)
                                    <button class="btn-default d-flex align-items-center justify-content-center"
                                            type="submit">CLEAR CART
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart_total_area mt-40">
                <div class="row">
                    <div class="col-sm-6 ms-sm-auto">
                        <div class="cart_table">
                            <ul>
                                <li><h4>Cart Total</h4></li>
                                <li><h5>Sub Total</h5><h5 id="subtotal">{{number_format((float)$subtotal, 2, '.', '')}}</h5></li>
                            </ul>
                            <div class="btn_area d-flex justify-content-end">
                                @if (count($items) > 0)
                                    @auth
                                        <a href="{{ route('checkout', ['checkout_type' => 'products_order']) }}"
                                           class="btn-default">Checkout</a>

                                    @endauth
                                    @guest
                                        <a href="{{ route('login') . '?next='. urlencode(route('checkout', ['checkout_type' => 'products_order'])) }}" class="btn  d-flex justify-content-center align-items-center common_btn_checkout ">PROCEED CHECKOUT</a>
                                    @endguest
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products List End -->
@endsection

@push('scripts')
    <script>

        var subtotal = 0;

        $('[data-item="product"]').each(function() {
            var el = $(this);
            var quantity = parseInt(el.find('[data-item="quantity"]').text());
            var stock = el.data('stock');
            var total = el.data('total');
            var price = parseFloat(el.data('price'));
            var currentTotal

            subtotal+= total;

            console.log(total);

            $(this).find('[data-item="minus"]').click(function() {
                if (quantity > 1) {
                    quantity--;
                    subtotal-= (price);
                    $('#subtotal').text(`$${subtotal}`)
                    el.find(`[data-total-value="${total}"]`).text('$' + parseFloat(price * quantity).toFixed(2))
                }
                el.find('[data-item="quantity"]').html(quantity);
            });

            $(this).find('[data-item="plus"]').click(function() {

                if (quantity === parseInt(stock) || quantity > parseInt(stock)) {
                    $.notify("Product stock limit reached", "error");
                }
                if (quantity > parseInt(stock)) {
                } else {
                    quantity++;
                    subtotal += (price);
                    $('#subtotal').text(`$${subtotal}`)
                    el.find(`[data-total-value="${total}"]`).text('$' + parseFloat(price * quantity).toFixed(2))
                }
                el.find('[data-item="quantity"]').html(quantity);
            });
        });

        $('#subtotal').text(`$${parseFloat(subtotal).toFixed(2)}`);


    </script>
@endpush

