<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'driver_license_number' => 'required|string|unique:users',
        ]);

        // Simpan data pengguna
        $user = new User();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->driver_license_number = $request->driver_license_number;
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }
}
