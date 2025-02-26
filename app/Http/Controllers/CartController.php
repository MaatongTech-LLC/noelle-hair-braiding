<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cart()
    {
        if (Auth::check()) {
            $items = Auth::user()->cart()->with('product')->get();
        } else {
            $items = collect(Session::get('cart', []));
        }
        
        return view('cart', ['items' => $items]);
    }

    public function cartPost(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);


        $productId = $request->product_id;
        $quantity = $request->quantity;

        if(Product::find($productId)->stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock for this product');
        }

        if (Auth::check()) {
            // ✅ Logged-in users: Store in DB
            $cartItem = Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $productId],
                ['quantity' =>  $quantity]
            );
        } else {
            // ✅ Guests: Store in session
            $cart = Session::get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'product' => Product::find($productId),
                ];
            }
            $cart = collect($cart);
            Session::put('cart', $cart->toArray());
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cartDelete($id) {
        if (Auth::check()) {
            // ✅ Remove from DB
            Cart::where('user_id', Auth::id())->where('product_id', $id)->delete();
        } else {
            // ✅ Remove from session (as a collection)
            $cart = collect(Session::get('cart', []));
            $cart->forget($id);

            Session::put('cart', $cart->toArray());
        }
        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    public function cartClear() {
        if (Auth::check()) {
            $items = Auth::user()->cart()->with('product')->get();

            foreach ($items as $item) {
                $item->delete();
            }
        } else {
            Session::forget('cart');
        }

        
        return redirect()->back()->with('success', 'Cart cleared successfully');
    }

    public function mergeCart()
    {
        if (!Auth::check()) {
            return;
        }

        $guestCart = Session::get('cart', []);
        foreach ($guestCart as $item) {
            Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $item['product_id']],
                ['quantity' => $item['quantity']]
            );
        }
        Session::forget('cart');

        return redirect()->back();
    }
}
