<?php

use App\Http\Controllers\Api\v1\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tasks'], function () {
  Route::get('', [TaskController::class, 'index'])->middleware('permission:tasks.view');
  Route::get('/{id}', [TaskController::class, 'show'])->middleware('permission:tasks.view');
  Route::post('/', [TaskController::class, 'store'])->middleware('permission:tasks.create');
  Route::put('{id}', [TaskController::class, 'update'])->middleware('permission:tasks.update');
  Route::delete('soft-delete', [TaskController::class, 'softDelete'])->middleware('permission:tasks.delete');
});

Route::get('users/{user}/tasks', [TaskController::class, 'getTasksByUserId']);
Route::get('customers/{customer}/tasks', [TaskController::class, 'getTasksByCustomerId']);

