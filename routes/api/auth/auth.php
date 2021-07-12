<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('logout', [AuthController::class, 'logout']);
Route::get('me', [AuthController::class, 'me']);
Route::get('roles', [AuthController::class, 'rolesViaUser']);
Route::get('permissions', [AuthController::class, 'permissionsViaRoles']);
