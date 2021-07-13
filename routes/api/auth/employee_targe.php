<?php

use App\Http\Controllers\Api\v1\EmployeeTargetController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employee-targets'], function () {
  Route::get('', [EmployeeTargetController::class, 'index']);
  Route::get('/{department_id}', [EmployeeTargetController::class, 'getAllEmployeeTargetByDepartmentId']);
  Route::put('/{id}', [EmployeeTargetController::class, 'update']);
  Route::delete('/soft-delete/{id}', [EmployeeTargetController::class, 'softDelete']);
});
