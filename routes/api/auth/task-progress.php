<?php
use App\Http\Controllers\Api\v1\TaskProgressController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'task-progresses'], function () {
  Route::post('', [TaskProgressController::class, 'store']);
  Route::put('{id}', [TaskProgressController::class, 'update']);
  Route::delete('soft-delete', [TaskProgressController::class, 'softDelete']);
});

Route::get('tasks/{id}/task-progresses', [TaskProgressController::class, 'getTaskProgressByTaskId']);
