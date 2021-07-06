<?php

use App\Http\Controllers\Api\v1\EmployeeTargetController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employee-targets'], function () {
  Route::get('', [EmployeeTargetController::class, 'index']);
});
