<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\ClientsDataTable;

class UserController extends Controller
{
    public function index(ClientsDataTable $dataTable)
    {
        return $dataTable->render('admin.clients.index');
    }
    public function show($id)
    {
        $client = User::findOrFail($id);

        return view('admin.clients.show', ['client' => $client]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        return User::create($validated);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
