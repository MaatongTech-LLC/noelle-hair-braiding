<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Service;
use App\Mail\ContactMail;
use App\Models\OrderItem;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Services\PaymentService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class HomeController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index()
    {
        $services = Service::orderBy('price', 'asc')
                                ->take(12)
                                ->get();
        return view('home', ['services' => $services]);
    }

    public function about()
    {
        return view('about');
    }

    public function booking(Request $request)
    {
        $services = Service::all();

        return view('booking', ['services' => $services]);
    }


    public function bookingPost(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'payment_type' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        $appointment = Appointment::create($validated);

        return redirect()->route('checkout', [
            'checkout_type' => 'appointment',
            'appointment_id' => $appointment->id
        ]);
    }

    public function shop(Request $request)
    {

        if ($request->category_id) {
            $products = Product::where('product_category_id', $request->category_id)->latest();
        } else {
            $products = Product::with('category')->latest();

        }
        $categories = ProductCategory::all();

        $products = $products->paginate(12);


        return view('shop', [
            'categories' => $categories,
            'products' => $products,

        ]);
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);

        return view('product', ['product' => $product]);
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function checkoutAppointmentPost(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required',
            'email' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'gateway' => 'required',
            'payment_type' => 'required|string',
        ]);

        $appointment = Appointment::create([
            'service_id' => $request->service_id,
            'user_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
            'payment_type' => $request->payment_type,
        ]);

        if ($validated['gateway'] === 'paypal') {
            $paymentUrl = $this->paymentService->processPayPal($appointment);

            if ($paymentUrl !== null) {
                return redirect()->away($paymentUrl);
            } else {

                return redirect()->back()->with('error', 'Something went wrong while processing PayPal payment');
            }

        } elseif ($validated['gateway'] === 'stripe') {
            $paymentStatusStripe = $this->paymentService->processStripe($appointment, $request->stripeToken);

            if ($paymentStatusStripe === 'succeeded') {
                return redirect()->route('customer.booking.show', $appointment->id)->with('success', 'Credit/Debit card payment successful');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while processing card payment');
            }
        }
    }

    public function checkoutOrderPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'gateway' => 'required',
            'user_id' => 'required',
            'total_price' => 'required',
        ]);

        $user = Auth::user();

        if (!$user) {

            return redirect()->route('login')->with('error', 'Login first to checkout');
        }

        $cartItems = $user->cart()->with('product')->get();

        if ($cartItems->isEmpty()) {

            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        DB::beginTransaction();
        try {
            // 1. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'Pending', // Will change after successful payment
            ]);

            // 2. Insert Order Items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // 3. Clear Cart
            $user->cart()->delete();

            DB::commit();

            if ($request->gateway === 'paypal') {
                $paymentUrl = $this->paymentService->processPayPal($order);

                if ($paymentUrl !== null) {
                    return redirect()->away($paymentUrl);
                } else {
                    return redirect()->back()->with('error', 'Something went wrong while processing PayPal payment');
                }
            } else {
                $paymentStatusStripe = $this->paymentService->processStripe($order, $request->stripeToken);

                if ($paymentStatusStripe === 'succeeded') {
                    return redirect()->route('customer.orders.show', $order->id)->with('success', 'Credit/Debit card payment successful');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong while processing card payment');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('cart')->with('error', 'Checkout failed: ' . $e->getMessage());
        }

    }

    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);


        if (isset($response['status']) & $response['status'] == 'COMPLETED') {

            if ($request->transaction_id) {
                $payment = Payment::where('transaction_id', $request->transaction_id)->first();
                if ($request->transaction_type === 'products_order') {
                    $payment->update(['status' => 'successful']);
                    $order = $payment->payable;
                    $order->update(['payment_status' => 'paid']);

                    return redirect()->route('customer.orders.show', $order->id)->with('success', 'Payment completed!');

                } else {
                    $payment->update(['status' => 'successful']);
                    $appointment = $payment->payable;
                    $appointment->update(['status' => 'completed']);

                    return redirect()->route('customer.booking.show', $appointment->id)->with('success', 'Payment completed!');
                }
            }


        } else {
            return redirect()->route('home')->with('error', 'Something went wrong!');
        }
    }

    public function paypalCancel(Request $request)
    {
        return redirect()->back()->with('error', 'Payment cancelled!');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($validated));

        return redirect()->back()->with('success', 'We received your message');

    }

    public function services(Request $request)
    {
        if ($request->has('category_id')) {
            $services = Service::where('service_category_id', $request->category_id)->with('category')->latest()->paginate(9);
        } else {
            $services = Service::with('category')->latest()->paginate(9);
        }
        $categories = ServiceCategory::all();

        return view('services', ['services' => $services, 'categories' => $categories]);
    }

    public function serviceShow($id)
    {
        $service = Service::with('category')->where('id', $id)->first();

        if ($service) {
            $previousItems = Service::where('id', '<', $service->id)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();

            $nextItems = Service::where('id', '>', $service->id)
                ->orderBy('id', 'asc')
                ->take(5)
                ->get();

            $items = $previousItems->reverse()->merge([$service])->merge($nextItems);

            if ($items->count() < 6) {
                if ($previousItems->isEmpty()) {
                    $additionalItems = Service::where('id', '>', $service->id)
                        ->orderBy('id', 'asc')
                        ->take(6 - $items->count())
                        ->get();
                    $items = $items->merge($additionalItems);
                } else {
                    $additionalItems = Service::where('id', '<', $service->id)
                        ->orderBy('id', 'desc')
                        ->take(6 - $items->count())
                        ->get();
                    $items = $additionalItems->reverse()->merge($items);
                }
            }

            $items = $items->take(6);
        }

        return view('service-show', ['service' => $service, 'services' => $items]);
    }

    public function reviewPost(Request $request) {
        $validated = $request->validate([
            'service_id' => 'required',
            'content' => 'required',
        ]);

        $validated['user_id'] = Auth::id();

        Review::create($validated);


        return redirect()->back()->with('success', 'Review posted');

    }

    public function gallery()
    {
        $directory = public_path('assets/gallery-images');

        $files = glob($directory . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        $images = array_map('basename', $files);
        return view('gallery', ['images' => $images]);
    }

    public function faq()
    {
        return view('faq');
    }

    public function termsAndConditions()
    {
        return view('terms-and-conditions');
    }
}
