<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookingCompleted extends Notification
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
            ->subject('Booking Completed')
            ->line('Your booking has been marked as completed.')
            ->line('Booking Details:')
            ->line('Service: ' . $this->appointment->service->name)
            ->line('Date: ' . Carbon::parse($this->appointment->date)->format('M j, Y'))
            ->line('Time: ' . Carbon::parse($this->appointment->time)->format('h:i'))
            ->line('We hope to see you again!');
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
