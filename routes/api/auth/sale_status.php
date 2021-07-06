<?php

use App\Http\Controllers\Api\v1\SaleStatusController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'sale-statuses'], function () {
  Route::get('/', [SaleStatusController::class, 'index']);
  Route::post('/', [SaleStatusController::class, 'store']);
  Route::put('{id}', [SaleStatusController::class, 'update']);
  Route::delete('{id}', [SaleStatusController::class, 'destroy']);
});
