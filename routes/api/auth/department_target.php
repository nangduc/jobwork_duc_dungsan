<?php

use App\Http\Controllers\Api\v1\DepartmentTargetController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'department-targets'], function () {
  Route::get('', [DepartmentTargetController::class, 'index']);
  Route::get('/{id}', [DepartmentTargetController::class, 'getDepartmentTargetByDepartmentId']);
  Route::post('/', [DepartmentTargetController::class, 'store']);
  Route::put('/{id}', [DepartmentTargetController::class, 'update']);
  Route::delete('/{id}', [DepartmentTargetController::class, 'softDelete']);
});
