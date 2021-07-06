<?php

use App\Http\Controllers\Api\v1\NegotiationStatusController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'negotiation-statuses'], function () {
  Route::get('/', [NegotiationStatusController::class, 'index']);
  Route::post('/', [NegotiationStatusController::class, 'store']);
  Route::put('{id}', [NegotiationStatusController::class, 'update']);
  Route::delete('{id}', [NegotiationStatusController::class, 'destroy']);
});
