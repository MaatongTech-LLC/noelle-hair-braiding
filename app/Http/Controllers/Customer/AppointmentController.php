<?php

namespace App\Http\Controllers\Customer;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\AppointmentsDataTable;

class AppointmentController extends Controller
{
    public AppointmentsDataTable $dataTable;

    public function __construct()
    {
        $this->dataTable = new AppointmentsDataTable(Auth::id());
    }
    public function index()
    {
       return $this->dataTable->render('customer.booking.index');
    }

    public function calendar()
    {
        $bookings = Appointment::with(['service', 'user'])->where('user_id', Auth::id())->get();

        $bookings = $bookings->map(function ($booking) {
            $start = Carbon::parse($booking->date . ' ' . $booking->time);

            $duration = Carbon::parse($booking->service->duration); // "HH:MM:SS"
            $end = $start->copy()->addHours($duration->hour)->addMinutes($duration->minute)->addSeconds($duration->second);

            $booking->start = $start->format('Y-m-d\TH:i:s'); // Format ISO8601
            $booking->end = $end->format('Y-m-d\TH:i:s'); // Format ISO8601

            $booking->title = $booking->service->name . ' (' . $booking->user->name . ')';
            $booking->url = route('customer.booking.show', $booking->id);

            return $booking;
        });

        return view('customer.booking.calendar', ['bookings' => json_encode($bookings)]);
    }



    public function show(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('customer.booking.show', ['appointment' => $appointment]);
    }
}
