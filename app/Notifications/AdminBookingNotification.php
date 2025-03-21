<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminBookingNotification extends Notification
{
    use Queueable;

    public $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Booking Received')
            ->line('A new booking has been made by ' . $this->appointment->user->name . '.')
            ->line('Service: ' . $this->appointment->service->name)
            ->line('Date: ' . Carbon::parse($this->appointment->date)->format('Y-m-d'))
            ->line('Time: ' . Carbon::parse($this->appointment->time)->format('h:i'))
            ->action('View Booking', route('admin.booking.show', $this->appointment->id))
            ->line('Thank you for using our booking system!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
