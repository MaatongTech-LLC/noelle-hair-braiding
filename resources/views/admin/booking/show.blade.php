@extends('admin.layouts.main')

@section('title')
    Service Booked: {{ $appointment->service->name }}
@endsection
@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Service Booked: {{ $appointment->service->name }}</h4>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gx-2">
                            @if ($appointment->status === 'completed')
                                <p class="h4">Status:  <span class="badge bg-success p-2">Completed</span></p>
                            @elseif ($appointment->status === 'cancelled')
                                <p class="h4">Status:  <span class="badge bg-danger p-2">Cancelled</span></p>
                            @else
                                <a class="btn btn-secondary mx-2" data-bs-toggle="modal" data-bs-target="#changeStatusModal">Change Status</a>
                            @endif
                            <a class="btn btn-primary mx-2" href="{{ route('admin.booking.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile">
                                <img src="{{ $appointment->service->getImage() }}" alt="profile-img" class="rounded-pill avatar-130 img-fluid">
                            </div>
                            <div class="mt-3">
                                <h3 class="d-inline-block"><a href="{{ route('service.show', $appointment->service->id) }}" target="_blank">{{ $appointment->service->name }}</a></h3>
                                <p>{{ ucwords($appointment->service->type) }}</p>
                                <p class="mb-0"></p>
                            </div>
                        </div>
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
                                    <span class="text-accent"># - Booking{{ $appointment->id }}
                                    </span>
                                </h5>
                                <span class="text-muted">Booked On:
                                    {{ $appointment->created_at->format('d M, Y') }}
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
                                    <p class="mb-0">Name: <strong>{{ $appointment->user->name }}</strong></p>
                                    <p class="mb-0">Email: <strong>{{ $appointment->user->email }}</strong></p>
                                    <p class="mb-0">Phone: <strong>{{ $appointment->user->getPhone() }}</strong></p>
                                </div>
                                <div class="col-auto mt-3">
                                    <h6 class="d-inline-block">Payment Method: </h6>
                                    <span class="badge bg-primary text-capitalize">{{ $appointment->payment->payment_method }}</span>
                                    <br>
                                    <br>
                                    @if ($appointment->payment !== null)
                                    <h6 class="d-inline-block">Payment Type: </h6>
                                    <p>${{ $appointment->payment->amount   }}
                                        {{ $appointment->payment->amount === $appointment->service->price ? '(Full Price)' : '(Deposit Price)' }}
                                    </p>
                                @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="shipping-address d-flex justify-content-md-end mb-3">
                                    <div class="w-25 ml-4">
                                        <h5 class="mb-2 ml-4"></h5>
                                        <p class="mb-0 text-wrap"></p>
                                    </div>
                                </div>    
                                <div class="shipping-address d-flex justify-content-md-end mb-3">
                                    <div class="w-25">
                                        <h5 class="mb-2">Billing Address</h5>
                                        <p class="mb-0 text-wrap">{{ $appointment->billing_address ?? 'Unknown' }}</p>
                                    </div>
                                    </div>    
                                </div>
                               
                            </div>
                        </div>
                    </div>
    
                    <!--order details-->
                    <table class="table table-bordered border-top" data-use-parent-width="true">
                        <thead>
                            <tr>
                                <th class="text-center" width="7%">#</th>
                                <th>Service</th>
                                <th class="text-end">Date</th>
                                <th class="text-end">Time</th>
                                <th class="text-end">Amount Paid</th>

                            </tr>
                        </thead>
    
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div> <img
                                                src="{{ $appointment->service->getImage()}}"
                                                alt="{{ $appointment->service->name }}"
                                                class="avatar avatar-50 rounded-pill">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="fs-lg mb-0" style="max-width: 280px; white-space: normal;">{{ $appointment->service->name }}</h6>
                                            <div class="text-muted">
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-end">
                                    <span class="fw-bold">{{ $appointment->date }}</span>
                                </td>
                                <td class="fw-bold text-end">{{ $appointment->time }}</td>

                                <td class=" text-end">
                                    <span class="text-accent fw-bold">$ {{ number_format($appointment->payment->amount, 2) }}</span>
                                </td>

                            </tr>
                            
                        </tbody>
                        <tfoot class="text-end">
                            <tr>
                                <td colspan="4">
                                    <h6 class="d-inline-block me-3">Grand Total: </h6>
                                </td>
                                <td width="10%" class="text-end"><strong class="text-accent">$ {{  number_format($appointment->payment->amount, 2) }}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
    
                    <!--Note-->
                    <div class="card-body">
                        <div class="card-footer border-top-0 px-4 py-4 rounded bg-soft-gray border border-2">
                            <p class="mb-0">Thank you for your appointment. Visit <a target="_blank" href="{{ route('terms-and-conditions')}}">Terms and conditions</a> page for our appointment policy</p>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
@endsection

  
  <!-- Modal -->
  <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="changeStatusModalLabel">Change Booking Status</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
            <form class="" action="{{ route('admin.booking.changeStatus', $appointment->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <input type="hidden" name="booking_id" value="{{ $appointment->id }}">
                    <select name="status" class="form-control">
                        @if(!in_array($appointment->status,['confirmed']))  <option value="confirmed" >Confirm</option> @endif
                        @if(!in_array($appointment->status,['completed', 'pending']))  <option value="completed" >Complete</option> @endif
                        @if(!in_array($appointment->status,['completed', 'cancelled', 'confirmed']))  <option value="cancelled" >Cancel</option> @endif
                    </select>
                </div>
               
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change Status</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        
        
      </div>
    </div>
  </div>

@push('scripts')

@endpush
