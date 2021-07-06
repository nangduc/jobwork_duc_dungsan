<?php

use App\Http\Controllers\Api\v1\FieldController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'fields'], function () {
  Route::get('/', [FieldController::class, 'index']);
  Route::post('/', [FieldController::class, 'store']);
  Route::put('{id}', [FieldController::class, 'update']);
  Route::delete('{id}', [FieldController::class, 'destroy']);
});
