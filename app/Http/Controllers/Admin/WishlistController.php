<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        return Wishlist::with(['user', 'product'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);
        return Wishlist::create($validated);
    }

    public function destroy($id)
    {
        Wishlist::destroy($id);
        return response()->json(['message' => 'Wishlist item removed.']);
    }
}
