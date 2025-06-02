<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

class UserAuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        return response()->json([
            'access_token' => $user->createToken($user->email . '-AuthToken')->plainTextToken,
        ]);
    }



    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            "message" => "logged out"
        ]);
    }
}
