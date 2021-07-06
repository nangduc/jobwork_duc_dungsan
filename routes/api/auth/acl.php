<?php

use App\Http\Controllers\Api\v1\AclController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'acl'], function () {
  Route::get('roles', [AclController::class, 'getRoles']);
  Route::get('roles/select-box', [AclController::class, 'getRolesForSelectBox']);
  Route::get('roles/{id}', [AclController::class, 'getRoleById']);
  Route::post('roles', [AclController::class, 'storeRole']);
  Route::put('roles/{id}', [AclController::class, 'updateRole']);
  Route::delete('roles', [AclController::class, 'destroyRole']);
  Route::get('/permissions', [AclController::class, 'getPermissions']);
  Route::put('/give-or-revoke', [AclController::class, 'giveOrRevokePermission']);
});
