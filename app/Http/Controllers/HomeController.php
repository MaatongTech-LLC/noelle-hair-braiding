<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
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
use App\Notifications\ClientBookingReceipt;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminOrderNotification;
use App\Notifications\ClientOrderConfirmation;
use App\Notifications\AdminBookingNotification;
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

    private function formatShippingAddress($street, $city, $state, $zipcode, $country)
    {
        return implode(', ', array_filter([$street, $city, $state, $zipcode, $country]));
    }

    public function checkoutAppointmentPost(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'gateway' => 'required',
            'payment_type' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();


        if (!$user) {
            $user = User::factory()->create([
                'email' => $validated['email'],
                'name' => $validated['name'],
            ]);
        }

        $appointment = Appointment::create([
            'service_id' => $request->service_id,
            'user_id' => $user->id,
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
                 // Notify the admin
                 Notification::route('mail', env('ADMIN_EMAIL'))->notify(new AdminBookingNotification($appointment));

                 // Notify the client
                 Notification::route('mail', $appointment->user->email)->notify(new ClientBookingReceipt($appointment));
                 
                return redirect()->route('success')->with('success', 'Credit/Debit card payment successful');
            } else {
                return redirect()->back()->with('error', 'Something went wrong while processing card payment');
            }
        }
    }

    public function checkoutOrderPost(Request $request)
    {        

        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'gateway' => 'required',
            'total_price' => 'required',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'street_address' => 'required|string',
        ]);

        $validated['country'] = 'USA';

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            $user = User::factory()->create([
                'email' => $request->email,
                'name' => $request->name,
            ]);

        }

        if(Auth::check()) {
            $cartItems = auth()->user()->cart()->with('product')->get();
        } else {
            $cartItems = collect(Session::get('cart', []));
        }

        if ($cartItems->isEmpty()) {

            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            if(is_array($cartItem)) {
                $cartItem = (object) $cartItem;
           }
            return $cartItem->quantity * $cartItem->product->price;
        });

        DB::beginTransaction();
        try {
            // 1. Create Order
            $shippingAddress = $this->formatShippingAddress(
                $request->input('street_address'),
                $request->input('city'),
                $request->input('state'),
                $request->input('zipcode'),
                $request->input('country')
            );

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'Pending',
                'shipping_address' => $shippingAddress,
            ]);

            // 2. Insert Order Items
            foreach ($cartItems as $cartItem) {
                if(is_array($cartItem)) {
                    $cartItem = (object) $cartItem;
               }
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);
            }

            // 3. Clear Cart
            if (Auth::check()) {
                $user->cart()->delete();

            } else {
                Session::forget('cart');
            }

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
                     // Notify the admin
                     Notification::route('mail', env('ADMIN_EMAIL'))->notify(new AdminOrderNotification($order));

                     // Notify the client
                     Notification::route('mail', $order->user->email)->notify(new ClientOrderConfirmation($order));

                    return redirect()->route('success')->with('success', 'Credit/Debit card payment successful');
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

                     // Notify the admin
                     Notification::route('mail', env('ADMIN_EMAIL'))->notify(new AdminOrderNotification($order));

                     // Notify the client
                     Notification::route('mail', $order->user->email)->notify(new ClientOrderConfirmation($order));


                } else {
                    $payment->update(['status' => 'successful']);
                    $appointment = $payment->payable;
                     // Notify the admin
                     Notification::route('mail', env('ADMIN_EMAIL'))->notify(new AdminBookingNotification($appointment));

                     // Notify the client
                     Notification::route('mail', $appointment->user->email)->notify(new ClientBookingReceipt($appointment));

                }
            }

            return redirect()->route('success')->with('success', 'Payment successful');



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

    public function success() {
        return view('payment-success');
    }
}
