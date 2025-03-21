<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookingCancelled extends Notification
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
            ->subject('Booking Cancelled')
            ->line('Your booking has been cancelled 😞.')
            ->line('If you paid for the service full price you fill be refunded.')
            ->line('appointment Details:')
            ->line('Service: ' . $this->appointment->service->name)
            ->line('Date: ' . Carbon::parse($this->appointment->date)->format('M j, Y'))
            ->line('Time: ' . Carbon::parse($this->appointment->time)->format('h:i'))
            ->line('If you have any questions, please contact us.')
            ->line('We hope to serve you again in the future!');
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
