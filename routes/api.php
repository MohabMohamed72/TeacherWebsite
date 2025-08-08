<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;



Route::post('/login', LoginController::class . '@Login');

Route::post('/register', LoginController::class . '@Register');