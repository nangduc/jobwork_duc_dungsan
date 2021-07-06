<?php

use App\Http\Controllers\Api\v1\CustomerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'customers'], function () {
  Route::get('', [CustomerController::class, 'index'])->middleware('permission:customers.view');
  Route::get('select-box', [CustomerController::class, 'getCustomersForSelectBox']);
  Route::get('/{id}', [CustomerController::class, 'show'])->middleware('permission:customers.view');
  Route::post('', [CustomerController::class, 'store'])->middleware('permission:customers.create');
  Route::patch('{id}', [CustomerController::class, 'update'])->middleware('permission:customers.update');
  Route::delete('soft-delete', [CustomerController::class, 'softDelete'])->middleware('permission:customers.delete');
});

