<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        
        return view ('customer.profile.show', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable',
            'profile_img' => 'nullable'
        ]);

        $user = Auth::user();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if ($request->hasFile('profile_img')) {
            $user->profile_img = $request->file('profile_img')->store('profile-images', 'public');
        }

        $user->save();

        toast('Profile updated successfully', 'success');

        return redirect()->route('customer.dashboard');
    }
}
