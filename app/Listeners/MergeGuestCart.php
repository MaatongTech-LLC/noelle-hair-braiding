<?php

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class MergeGuestCart
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login  $event): void
    {
        $user = $event->user;
        $guestCart = collect(Session::get('cart', []));

        if ($guestCart->isNotEmpty()) {
            foreach ($guestCart as $item) {
                Cart::updateOrCreate(
                    ['user_id' => $user->id, 'product_id' => $item['product_id']],
                    ['quantity' => $item['quantity']]
                );
            }

            // ✅ Clear guest cart from session after merging
            Session::forget('cart');
        }
    }
}
