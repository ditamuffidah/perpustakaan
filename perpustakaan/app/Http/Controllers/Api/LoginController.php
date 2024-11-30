<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan passwordnya sesuai
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        // Membuat token untuk user
        $token = $user->createToken('ApiToken')->plainTextToken;

        // Response dengan user data dan token
        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Handle logout request.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        // Logout user (hanya bisa logout jika sudah login dengan token)
        auth()->logout();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ], 200);
    }
}
