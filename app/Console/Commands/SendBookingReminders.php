<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\BookingReminder;

class SendBookingReminders extends Command
{
    protected $signature = 'bookings:send-reminders';
    protected $description = 'Send booking reminders 24 hours before the booking date.';

    public function handle()
    {
        // Get bookings that are 24 hours from now
        $appointments = \App\Models\Appointment::where('status', 'confirmed')
            ->with('user')
            ->whereDate('date', now()->addDay()->toDateString())
            ->get();


        foreach ($appointments as $appointment) {
            // Send reminder notification
            $appointment->user->notify(new BookingReminder($appointment));
            $this->info('Reminder sent for booking ID: ' . $appointment->id);
        }

        $this->info('Reminders sent successfully.');
    }
}
