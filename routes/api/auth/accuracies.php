<?php

use App\Http\Controllers\Api\v1\AccuraciesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'accuracies'], function () {
  Route::get('/', [AccuraciesController::class, 'index']);
  Route::post('/', [AccuraciesController::class, 'store']);
  Route::put('{id}', [AccuraciesController::class, 'update']);
  Route::delete('{id}', [AccuraciesController::class, 'destroy']);
});
