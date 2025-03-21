<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientOrderConfirmation extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Order Confirmation')
            ->line('Thank you for your order!')
            ->line('Here are your order details:')
            ->line('Order ID: ' . $this->order->id)
            ->line('Total Amount: $' . number_format($this->order->total_price, 2))
            ->line('Items:')
            ->line($this->formatOrderItems($this->order->orderItems))
            ->line('Shipping Address: ' . $this->order->shipping_address)
            ->line('If you have any questions, please contact us.')
            ->line('Thank you for choosing us!');
    }

    protected function formatOrderItems($items)
    {
        return collect($items)->map(function ($item) {
            return "{$item->name} - {$item->quantity} x $" . number_format($item->price, 2);
        })->implode("\n");
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
