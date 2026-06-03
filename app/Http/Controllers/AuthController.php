<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            if (!$request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ])) {
                return response()->json(['error' => 'Validation failed'], 422);
            }
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            $token = Auth::login(user: $user);

            return response()->json(['msg' => 'Login successful', 'access_token' => $token, 'token_type' => 'bearer'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Login failed', 'message' => $e->getMessage()], 500);
        }
    }
}
