<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Payment, Order, Appointment, User};

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        $order = Order::first();
        $appointment = Appointment::first();

        if ($order) {
            Payment::create([
                'user_id' => $user->id,
                'payment_method' => 'stripe',
                'amount' => $order->total_price,
                'status' => 'successful',
                'transaction_id' => 'TEST_STRIPE_123456',
                'payable_id' => $order->id,
                'payable_type' => Order::class,
            ]);
        }

        if ($appointment) {
            Payment::create([
                'user_id' => $user->id,
                'payment_method' => 'paypal',
                'amount' => $appointment->service->price,
                'status' => 'successful',
                'transaction_id' => 'TEST_PAYPAL_654321',
                'payable_id' => $appointment->id,
                'payable_type' => Appointment::class,
            ]);
        }
    }
}

