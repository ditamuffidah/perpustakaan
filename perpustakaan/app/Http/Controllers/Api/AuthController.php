<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    // Method untuk login dan mengeluarkan token
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari pengguna dan memverifikasi password
        $user = User::where('email', $request->email)->first();

        if ($user && password_verify($request->password, $user->password)) {
            // Membuat token untuk pengguna
            $token = $user->createToken('YourAppName')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user // Menyertakan informasi pengguna
            ], 201); // Mengembalikan token dan informasi pengguna
        }

        return response()->json(['message' => 'Unauthorized'], 401); // Jika gagal login
    }

    // Method untuk registrasi pengguna baru
    public function signup(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Membuat token untuk pengguna
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user // Menyertakan informasi pengguna
        ], 201); // Mengembalikan token dan informasi pengguna
    }
}