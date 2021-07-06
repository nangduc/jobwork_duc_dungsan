<?php

use App\Http\Controllers\Api\v1\CompanionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'companions'], function () {
  Route::get('select-box', [CompanionController::class, 'getCompanionsForSelectBox']);
  Route::get('/', [CompanionController::class, 'index'])->middleware('permission:companions.view');
  Route::post('/', [CompanionController::class, 'store'])->middleware('permission:companions.create');
  Route::patch('{id}', [CompanionController::class, 'update'])->middleware('permission:companions.update');
  Route::delete('/soft-delete', [CompanionController::class, 'softDelete'])->middleware('permission:companions.delete');
});
