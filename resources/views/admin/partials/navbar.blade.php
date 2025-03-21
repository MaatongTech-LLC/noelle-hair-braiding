<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="#" class="navbar-brand">
            <!--Logo start-->
            <img src="{{ asset('/assets/uploads/logo/logo.png') }}" style="object-fit:contain;" height="125" width="125" alt="">
            <!--logo End-->
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
                  <span class="mt-2 navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
        </button>
        
        <a href="{{ route('home') }}" target="_">Visit website <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12ZM17.7366 6.04606C19.4439 7.36485 20.8976 9.29455 21.9415 11.7091C22.0195 11.8933 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8933 2.05854 11.7091C4.14634 6.88 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM12.0012 14.4124C13.3378 14.4124 14.4304 13.3264 14.4304 11.9979C14.4304 10.6597 13.3378 9.57362 12.0012 9.57362C11.8841 9.57362 11.767 9.58332 11.6597 9.60272C11.6207 10.6694 10.7426 11.5227 9.65971 11.5227H9.61093C9.58166 11.6779 9.56215 11.833 9.56215 11.9979C9.56215 13.3264 10.6548 14.4124 12.0012 14.4124Z" fill="currentColor"></path>                            </svg></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                <li class="nav-item dropdown">
                    @php
                        $notifications = \App\Models\Appointment::with('service')->where('status', 'unread')->get();
                    @endphp
                    <a href="#" class="nav-link" id="notification-drop" style="position:relative;" data-bs-toggle="dropdown">
                        <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.7695 11.6453C19.039 10.7923 18.7071 10.0531 18.7071 8.79716V8.37013C18.7071 6.73354 18.3304 5.67907 17.5115 4.62459C16.2493 2.98699 14.1244 2 12.0442 2H11.9558C9.91935 2 7.86106 2.94167 6.577 4.5128C5.71333 5.58842 5.29293 6.68822 5.29293 8.37013V8.79716C5.29293 10.0531 4.98284 10.7923 4.23049 11.6453C3.67691 12.2738 3.5 13.0815 3.5 13.9557C3.5 14.8309 3.78723 15.6598 4.36367 16.3336C5.11602 17.1413 6.17846 17.6569 7.26375 17.7466C8.83505 17.9258 10.4063 17.9933 12.0005 17.9933C13.5937 17.9933 15.165 17.8805 16.7372 17.7466C17.8215 17.6569 18.884 17.1413 19.6363 16.3336C20.2118 15.6598 20.5 14.8309 20.5 13.9557C20.5 13.0815 20.3231 12.2738 19.7695 11.6453Z"
                                fill="currentColor"></path>
                            <path opacity="0.4"
                                  d="M14.0088 19.2283C13.5088 19.1215 10.4627 19.1215 9.96275 19.2283C9.53539 19.327 9.07324 19.5566 9.07324 20.0602C9.09809 20.5406 9.37935 20.9646 9.76895 21.2335L9.76795 21.2345C10.2718 21.6273 10.8632 21.877 11.4824 21.9667C11.8123 22.012 12.1482 22.01 12.4901 21.9667C13.1083 21.877 13.6997 21.6273 14.2036 21.2345L14.2026 21.2335C14.5922 20.9646 14.8734 20.5406 14.8983 20.0602C14.8983 19.5566 14.4361 19.327 14.0088 19.2283Z"
                                  fill="currentColor"></path>
                        </svg>

                        @if(count($notifications) > 0)
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" style="position:absolute; top: -25%; left: -120%; z-index: 9999;">
                                <circle id="notification-dot" cx="80" cy="25" r="8" fill="red">
                                    <animate
                                        attributeName="opacity"
                                        values="0;1;0"
                                        dur="1s"
                                        repeatCount="indefinite" />
                                </circle>
                                <text id="notification-count" x="80" y="25" font-size="11" fill="white" text-anchor="middle" dy=".3em">{{ count($notifications) }}</text>
                            </svg>
                        @endif

                    </a>
                    <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="notification-drop">
                        <div class="m-0 shadow-none card">
                            <div class="py-3 card-header d-flex justify-content-between" style="background: #fc6098;">
                                <div class="header-title">
                                    <h5 class="mb-0 text-white">All Notifications</h5>
                                </div>
                            </div>
                            <div class="p-0 card-body">
                                @forelse($notifications as $booking)
                                    <a href="{{ route('admin.booking.show', $booking->id) }}" class="iq-sub-card">
                                        <div class="d-flex align-items-center">
                                            <img class="p-1 avatar-40 rounded-pill bg-soft-primary" src="{{ \Illuminate\Support\Facades\Storage::url($booking->service->image) }}" alt="">
                                            <div class="ms-3 w-100">
                                                <h6 class="mb-0 ">Booking {{ "" }}</h6>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-0">The service: <strong>{{ $booking->service->name }}</strong> has been booked</p>
                                                </div>
                                                <small class="float-end font-size-12">{{ $booking->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <h6 class="text-center my-2">No notification found</h6>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                       <img src="{{ auth()->user()->profile_img !== null ?  \Illuminate\Support\Facades\Storage::url( auth()->user()->profile_img) : asset('admin/assets/images/avatars/01.png') }}" alt="User-Profile"
                       class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                        <div class="caption ms-3 d-none d-md-block ">
                            <h6 class="mb-0 caption-title">{{ auth()->user()->name }}</h6>
                            <p class="mb-0 caption-sub-title">{{ auth()->user()->role === 'admin' ? 'Manager' : 'Customer' }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        @if (auth()->user()->role == 'admin')
                        <li><a class="dropdown-item" href="{{ route('admin.profile.show') }}">Profile</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{ route('customer.profile.show') }}">Profile</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">@csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
