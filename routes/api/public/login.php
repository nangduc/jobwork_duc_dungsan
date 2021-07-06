<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('auth/{provider}', [AuthController::class, 'loginWithSocialAuth']);
