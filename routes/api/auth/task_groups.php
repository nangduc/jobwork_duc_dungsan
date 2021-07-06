<?php

use App\Http\Controllers\Api\v1\TaskGroupController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'task-groups'], function () {
  Route::get('/', [TaskGroupController::class, 'index']);
  Route::get('select-box', [TaskGroupController::class, 'getTaskGroupForSelectBox']);
  Route::post('/', [TaskGroupController::class, 'store']);
  Route::put('{id}', [TaskGroupController::class, 'update']);
  Route::delete('{id}', [TaskGroupController::class, 'destroy']);
});
