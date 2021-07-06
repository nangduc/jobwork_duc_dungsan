<?php

use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
  Route::get('', [UserController::class, 'index'])->middleware('permission:users.view');
  Route::get('select-box', [UserController::class, 'getUsersForSelectBox']);
  Route::get('/trashed', [UserController::class, 'trashed'])->middleware('permission:users.view');
  Route::get('/template', [UserController::class, 'downloadExcelTemplate'])->middleware('permission:users.create');
  Route::get('/{id}', [UserController::class, 'show'])->middleware('permission:users.view');
  Route::post('', [UserController::class, 'store'])->middleware('permission:users.create');
  Route::post('/import', [UserController::class, 'import'])->middleware('permission:users.create');
  Route::patch('{id}', [UserController::class, 'update'])->middleware('permission:users.update');
  Route::delete('/soft-delete', [UserController::class, 'softDelete'])->middleware('permission:users.delete');
  Route::delete('/force-delete', [UserController::class, 'forceDelete'])->middleware('permission:users.delete');
  Route::put('/restore', [UserController::class, 'restore'])->middleware('permission:users.create');
});

Route::get('departments/{id}/users', [UserController::class, 'getUsersByDepartmentId']);
