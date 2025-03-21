<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderNotification extends Notification
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
            ->subject('New Order Received')
            ->line('A new order has been placed by ' . $this->order->user->name . '.')
            ->line('Order ID: ' . $this->order->id)
            ->line('Payment Method: ' . ucwords($this->order->payment->payment_method))
            ->line('Total Amount: $' . number_format($this->order->total_price, 2))
            ->line('Items:')
            ->line($this->formatOrderItems($this->order->items))
            ->line('Shipping Address: ' . $this->order->shipping_address)
            ->action('View Order', route('admin.orders.show', $this->order->id))
            ->line('Thank you for using our system!');
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
