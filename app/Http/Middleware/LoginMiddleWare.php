<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('phone_number', $request->input('phone_number'))->first();
        if (strlen($request->input('phone_number'))!= 11 ) {
            return response()->json([
                'message' => 'يجب ان يكون رقم الهاتف مكون من 11 رقم ',
                'status' => 'error'
            ], 404);
        }
        else{

            return $next($request);
        }
    }
}
