<?php

use App\Http\Controllers\Api\v1\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'departments'], function () {
  Route::get('', [DepartmentController::class, 'index'])->middleware('permission:departments.view');
  Route::get('select-box', [DepartmentController::class, 'getDepartmentsForSelectBox']);
  Route::post('', [DepartmentController::class, 'store'])->middleware('permission:departments.create');
  Route::put('{id}', [DepartmentController::class, 'update'])->middleware('permission:departments.update');
  Route::delete('soft-delete/{id}', [DepartmentController::class, 'softDelete'])->middleware('permission:departments.delete');
});

