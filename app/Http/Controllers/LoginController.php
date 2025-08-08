<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function Login(Request $request)
    {
       
        $user = User::where('phone_number', $request->input('phone_number'))->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found',
                    'status' => 'error'
                ], 404);
            }

            
            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials',
                    'status' => 'error'
                ], 401);
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'status' => 'success',
                'data' => [
                    'user' => $user->only(['id', 'name', 'phone_number', 'email']),
                    'token' => $token, // if using Sanctum
                ]
            ], 200);

        
    }
    function Register(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
            'age' => $request->input('age'),
            'level' => $request->input('level'),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'status' => 'success',
            'data' => [
                'user' => $user->only(['id', 'name', 'phone_number', 'email']),
            ]
        ], 201);
    }
}
