<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "User registered successfully",
            "data" => [
                "user" => $user,
                "token" => $token
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "success" => false,
                "message" => "Email atau password salah."
            ], 401);
        }

        /* hilangkan comment kalau mau satu akun hanya bisa digunakan disatu perangkat */
        // $user->tokens()->delete();

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "Login successful",
            "data" => [
                "user" => $user,
                "token" => $token
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $token =  $request->user()->currentAccessToken();

        if ($token) {
            $token->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
