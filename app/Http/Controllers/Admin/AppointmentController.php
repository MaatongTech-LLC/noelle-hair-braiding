<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\DataTables\AppointmentsDataTable;

class AppointmentController extends Controller
{
    public function index(AppointmentsDataTable $dataTable)
    {
       return $dataTable->render('admin.booking.index');
    }

    public function calendar()
    {
        $bookings = Appointment::with(['service', 'user'])->get();

        $bookings = $bookings->map(function ($booking) {
            $start = Carbon::parse($booking->date . ' ' . $booking->time);

            $duration = Carbon::parse($booking->service->duration); // "HH:MM:SS"
            $end = $start->copy()->addHours($duration->hour)->addMinutes($duration->minute)->addSeconds($duration->second);

            $booking->start = $start->format('Y-m-d\TH:i:s'); // Format ISO8601
            $booking->end = $end->format('Y-m-d\TH:i:s'); // Format ISO8601

            $booking->title = $booking->service->name . ' (' . $booking->user->name . ')';
            $booking->url = route('admin.booking.show', $booking->id);

            return $booking;
        });

        return view('admin.booking.calendar', ['bookings' => json_encode($bookings)]);
    }



    public function show(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('admin.booking.show', ['appointment' => $appointment]);
    }

    public function changeStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        
        return redirect()->back()->with('success', 'Appointment status changed');
    }
}
