<?php
namespace App\Services;
use App\Models\Appointment;
use App\Models\Order;
use App\Models\Payment;
use Exception;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Stripe;
class PaymentService {
    public function processPayPal($entity)
    {
        $amount = 0;

        if(get_class($entity) == Appointment::class) {
            $amount = $entity->payment_type == 'deposit' ? $entity->service->deposit_price : $entity->service->price;
        } else {
            $amount = $entity->total_price;
        }

        $transaction_id = 'PAYPAL_' . uniqid();
        $transaction_type = get_class($entity) == Appointment::class ? 'appointment' : 'products_order';

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success', ['transaction_id' => $transaction_id, 'transaction_type' => $transaction_type]),
                "cancel_url" => route('paypal.cancel', ['transaction_id' => $transaction_id, 'transaction_type' => $transaction_type]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) & $response['id'] != null) {

            // Store payment record
            Payment::create([
                'user_id' => $entity->user_id,
                'payment_method' => 'paypal',
                'amount' => $amount,
                'status' => 'pending',
                'transaction_id' => $transaction_id,
                'payable_id' => $entity->id,
                'payable_type' => get_class($entity),
            ]);

            if (get_class($entity) == Order::class) $entity->update(['status' => 'Paid']);

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }


        }

        return null;

    }

    public function processStripe($entity, $paymentMethodId)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            if(get_class($entity) == Appointment::class) {
                $amount = $entity->payment_type == 'deposit' ? $entity->service->deposit_price : $entity->service->price;
            } else {
                $amount = $entity->total_price;
            }

            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'payment_method' => $paymentMethodId,
                'confirm' => true,
            ]);

            //$entity->update(['status' => 'Paid']);

            // Store payment record
            Payment::create([
                'user_id' => $entity->user_id,
                'payment_method' => 'stripe',
                'amount' => $amount,
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'payable_id' => $entity->id,
                'payable_type' => get_class($entity),
            ]);

            return $paymentIntent;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}

