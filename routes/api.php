<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\LoginMiddleWare;
use App\Http\Middleware\RegisterMiddleWare;
use Illuminate\Support\Facades\Route;



Route::post('/login', LoginController::class . '@Login')->middleware(LoginMiddleWare::class);

Route::post('/register', LoginController::class . '@Register')->middleware(RegisterMiddleWare::class);