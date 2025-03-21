<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClientBookingReceipt extends Notification
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
            ->subject('Booking Confirmation')
            ->line('Thank you for booking with us!')
            ->line('Here are your booking details:')
            ->line('Service: ' . $this->appointment->service->name)
            ->line('Date: ' . Carbon::parse($this->appointment->date)->format('Y-m-d'))
            ->line('Time: ' . Carbon::parse($this->appointment->time)->format('h:i'))
            ->line('Price: $' . $this->appointment->payment_type == 'full_price' ? number_format($this->appointment->service->price, 2) : number_format($this->appointment->service->deposit_price, 2))
            ->line('If you have any questions, please contact us.')
            ->line('Thank you for choosing us!');
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
