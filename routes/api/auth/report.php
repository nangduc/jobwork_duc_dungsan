<?php

use App\Http\Controllers\Api\v1\ReportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'reports'], function () {
  Route::get('', [ReportController::class, 'index'])->middleware('permission:reports.view');
  Route::get('last', [ReportController::class, 'getLastReport'])->middleware('permission:reports.view');
  Route::get('{id}', [ReportController::class, 'show'])->middleware('permission:reports.view');
  Route::post('', [ReportController::class, 'store'])->middleware('permission:reports.create');
});


