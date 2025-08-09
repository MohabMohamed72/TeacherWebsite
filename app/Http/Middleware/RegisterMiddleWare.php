<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('phone_number', $request->input('phone_number'))->first();
        $name = $request->input('name');
        $phoneNumber = $request->input('phone_number');
        $password = $request->input('password');
        $passwordConfirm = $request->input('password_confirmation');
        $age = $request->input('age');
        $level = $request->input('level');

        if ($user && $phoneNumber == $user->phone_number) {
            return response()->json([
                'message' => 'هذا المستخدم مسجل بالفعل',
                'status' => 'error'
            ], 409);
        }

        if (strlen($phoneNumber) != 11) {
            return response()->json([
                'message' => 'يجب ان يكون رقم الهاتف مكون من 11 رقم',
                'status' => 'error'
            ], 404);
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{9,}$/', $password)) {
            return response()->json([
                'message' => 'كلمة المرور يجب أن تكون أكثر من 8 أحرف وتشمل حرف صغير، حرف كبير، وعلامة مثل @ أو #',
                'status' => 'error'
            ], 400);
        }

        if (empty($password) || empty($passwordConfirm)) {
            return response()->json([
                'message' => 'كلمة المرور مطلوبة',
                'status' => 'error'
            ], 400);
        }
        if ($password !== $passwordConfirm) {
            return response()->json([
                'message' => 'كلمة المرور وتأكيد كلمة المرور غير متطابقين',
                'status' => 'error'
            ], 400);
        }

        if (empty($age) || !is_numeric($age) || $age < 0) {
            return response()->json([
                'message' => 'السن يجب أن يكون اكبر من 15 سنة',
                'status' => 'error'
            ], 400);
        }

        if ($age < 15 || $age > 20) {
            return response()->json([
                'message' => 'السن يجب أن يكون بين 15 و 20 سنة',
                'status' => 'error'
            ], 400);
        }

        if (empty($level) || !in_array($level, [1, 2, 3])) {
            return response()->json([
                'message' => 'المرحلة غير صالحة',
                'status' => 'error'
            ], 400);
        }


        return $next($request);
    }
}
