@extends('admin.layouts.main')

@section('title')
Order {{ '' }}
@endsection
@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Order {{ '' }}</h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="btn btn-primary mx-2"
                            href="{{ route('customer.orders.index') }}">Back</a>
                    </div>
                </div>
                <div class="card-body">

                </div>

            </div>
        </div>
    </div>

    <div class="row g-4">
        <!--Main Invoice-->
        <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
            <div class="card mb-4" id="section-1">
                <div class="card-body">
                    <!--Order Detail-->
                    <div class="row justify-content-between align-items-center g-3 mb-4">
                        <div class="col-auto flex-grow-1">
                            <img src="{{ asset('assets/images/logo-2.png') }}"
                                alt="logo" class="img-fluid" width="200">
                        </div>
                        <div class="col-auto text-end">
                            <h5 class="mb-0">Invoice
                                <span class="text-accent"># - Order{{ $order->id }}
                                </span>
                            </h5>
                            <span class="text-muted">Order Date:
                                {{ $order->created_at->format('d M, Y') }}
                            </span>
                            <br>
                            {{-- <span class="text-muted">Delivery Date:
                                07 Feb, 2025
                            </span> --}}
                            <div>
                                <span class="text-muted">
                                    <i class="las la-map-marker"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-md-between justify-content-center g-3">
                        <div class="col-md-3">
                            <!--Customer Detail-->
                            <div class="welcome-message">
                                <h5 class="mb-2">Client Info</h5>
                                <p class="mb-0">Name: <strong>{{ $order->user->name }}</strong></p>
                                <p class="mb-0">Email: <strong>{{ $order->user->email }}</strong></p>
                                <p class="mb-0">Phone: <strong>{{ $order->user->getPhone() }}</strong></p>
                            </div>
                            <div class="col-auto mt-3">
                                <h6 class="d-inline-block">Payment Method: </h6>
                                <span class="badge bg-primary text-capitalize">{{ $order->payment->payment_method }}</span>
                            </div>
                            <h6 class="col-auto d-inline-block">Status: </h6> <span>Order Placed</span>
                        </div>
                        <div class="col">
                            <div class="shipping-address d-flex justify-content-md-end gap-3 mb-3">
                                <div class="border-end w-25">
                                    <h5 class="mb-2">Shipping Address</h5>

                                    <p class="mb-0 text-wrap">{{ $order->shipping_address ?? 'Unknown' }}</p>
                                </div>
                                <div class="w-25">
                                    <h5 class="mb-2">Billing Address</h5>
                                    <p class="mb-0 text-wrap">{{ $order->billing_address ?? 'Unknown' }}</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>

                <!--order details-->
                <table class="table table-bordered border-top" data-use-parent-width="true">
                    <thead>
                        <tr>
                            <th class="text-center" width="7%">S/L</th>
                            <th>Products</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">QTY</th>
                            <th class="text-end">Total Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach ($order->orderItems as $key => $item)
                            @php $itemTotal = $item->quantity * $item->price; @endphp
                            <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div> <img
                                                src="{{ $item->product->getImage()}}"
                                                alt="{{ $item->product->name}}"
                                                class="avatar avatar-50 rounded-pill">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="fs-lg mb-0" style="max-width: 280px; white-space: normal;">{{ $item->product->name}}</h6>
                                            <div class="text-muted">
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-end">
                                    <span class="fw-bold">$ {{ $item->product->price}}</span>
                                </td>
                                <td class="fw-bold text-end">{{ $item->quantity }}</td>

                                <td class=" text-end">
                                    <span class="text-accent fw-bold">$ {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                </td>

                            </tr>
                            @php $subtotal += $itemTotal; @endphp
                        @endforeach
                        
                    </tbody>
                    <tfoot class="text-end">
                        <tr>
                            <td colspan="4">
                                <h6 class="d-inline-block me-3">Sub Total: </h6>
                            </td>
                            <td width="10%">
                                <strong>${{ number_format($subtotal, 2) }}</strong></td>
                        </tr>
                    
                        <tr>
                            <td colspan="4">
                                <h6 class="d-inline-block me-3">Delivery Charge: </h6>
                            </td>
                            <td width="10%" class="text-end">
                                <strong>$0.00</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <h6 class="d-inline-block me-3">Grand Total: </h6>
                            </td>
                            <td width="10%" class="text-end"><strong class="text-accent">$ {{ $order->total_price }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!--Note-->
                <div class="card-body">
                    <div class="card-footer border-top-0 px-4 py-4 rounded bg-soft-gray border border-2">
                        <p class="mb-0">Thank you for visiting our store and choosing to make a purchase with us.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



@push('scripts')

@endpush
