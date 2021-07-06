<?php

use App\Http\Controllers\Api\v1\TaskTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'task-types'], function () {
  Route::get('/', [TaskTypeController::class, 'index']);
  Route::get('select-box', [TaskTypeController::class, 'getTaskTypesForSelectBox']);
  Route::post('/', [TaskTypeController::class, 'store']);
  Route::put('{id}', [TaskTypeController::class, 'update']);
  Route::delete('{id}', [TaskTypeController::class, 'destroy']);
});
