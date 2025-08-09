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
                    'message' => 'لايوجد مستخدم بهذا الرقم',
                    'status' => 'error'
                ], 404);
            }

            
            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'message' => 'كلمة المرور غير صحيحة',
                    'status' => 'error'
                ], 401);
            }

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'تم تسجيل الدخول بنجاح',
                'status' => 'success',
                'data' => [
                    'user' => $user->only(['id', 'name', 'phone_number', 'email']),
                    'token' => $token, 
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
            'message' => 'تم إضافة المستخدم بنجاح',
            'status' => 'success',
            'data' => [
                'user' => $user->only(['id', 'name', 'phone_number', 'email']),
            ]
        ], 201);
    }
}
