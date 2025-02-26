<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    // PayPal Payment for Ecommerce
    public function processEcommercePayPal(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::with('user')->findOrFail($validated['order_id']);
        $this->paymentService->processPayPal($order);

        return response()->json(['message' => 'Payment successful via PayPal', 'order' => $order]);
    }

    // PayPal Payment for Booking
    public function processBookingPayPal(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_id' => 'required|exists:appointments,id',
        ]);

        $appointment = Appointment::with('user', 'service')->findOrFail($validated['appointment_id']);
        $this->paymentService->processPayPal($appointment);

        return response()->json(['message' => 'Payment successful via PayPal', 'appointment' => $appointment]);
    }

    // Stripe Payment for Ecommerce
    public function processEcommerceStripe(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'payment_method_id' => 'required|string',
        ]);

        $order = Order::with('user')->findOrFail($validated['order_id']);
        $paymentIntent = $this->paymentService->processStripe($order, $validated['payment_method_id']);

        return response()->json(['message' => 'Payment successful via Stripe', 'paymentIntent' => $paymentIntent]);
    }

    // Stripe Payment for Booking
    public function processBookingStripe(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'appointment_id' => 'required|exists:appointments,id',
            'payment_method_id' => 'required|string',
        ]);

        $appointment = Appointment::with('user', 'service')->findOrFail($validated['appointment_id']);
        $paymentIntent = $this->paymentService->processStripe($appointment, $validated['payment_method_id']);

        return response()->json(['message' => 'Payment successful via Stripe', 'paymentIntent' => $paymentIntent]);
    }
}
