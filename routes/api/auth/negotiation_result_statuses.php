<?php

use App\Http\Controllers\Api\v1\NegotiationResultStatusController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'negotiation-result-statuses'], function () {
  Route::get('/', [NegotiationResultStatusController::class, 'index']);
  Route::post('/', [NegotiationResultStatusController::class, 'store']);
  Route::put('{id}', [NegotiationResultStatusController::class, 'update']);
  Route::delete('{id}', [NegotiationResultStatusController::class, 'destroy']);
});
