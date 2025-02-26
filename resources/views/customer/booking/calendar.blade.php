@extends('admin.layouts.main')

@section('title')
    Booking Calendar
@endsection
@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h4 class="mb-0">Booking Calendar</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        button {
            text-transform: capitalize;
        }

        .fc-event {
            cursor: pointer;
        }
    </style>
@endpush

@push('scripts')
    <!-- Fullcalendar Javascript -->
    <script src="{{ asset('admin/assets/vendor/moment.min.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var events = @php echo $bookings; @endphp;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: { center: 'timeGridDay,timeGridWeek,dayGridMonth,listWeek' },
                initialView: 'dayGridMonth',
                selectable: true,
                selectHelper: true,
                displayEventTime: true,
                displayEventEnd: true,
                slotMinTime: '8:00:00',
                slotMaxTime: '24:00:00',
                eventColor: '#ed80c8',
                events: events,

            });
            calendar.render();
        });

    </script>
@endpush
