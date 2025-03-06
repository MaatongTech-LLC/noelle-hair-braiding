<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable',
            'profile_img' => 'nullable'
        ]);

        $user = User::find($id);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if ($request->hasFile('profile_img')) {
            $user->profile_img = $request->file('profile_img')->store('profile-images', 'public');
        }

        $user->save();

        toast('Profile updated successfully', 'success');

        return redirect()->route('admin.dashboard');
    }
}
