<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Acl\PermissionResource;
use App\Http\Resources\Acl\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AclController extends Controller
{
  protected $role;
  protected $permission;
  public function __construct(Role $role, Permission $permission)
  {
    $this->role = $role;
    $this->permission = $permission;
  }

  /**
   * Get all roles
   * @return json
   */
  public function getRoles()
  {
    return $this->role->select('id', 'name', 'description', 'created_at', 'created_by')
      ->with('createdBy:id,name')
      ->get();
  }

  /**
   * Get role (name and id) for select box
   */
  public function getRolesForSelectBox()
  {
    return $this->role->select('id', 'name')->get();
  }

  /**
   * Get role by id and permissions via role
   * @param int $id
   * @return json
   */
  public function getRoleById($id)
  {
    $role = $this->role->find($id);
    return new RoleResource($role);
  }

  public function storeRole(RoleRequest $request)
  {
    DB::beginTransaction();
    try {
      $newRole = Role::create($request->only(['name', 'description']));
      $newRole->givePermissionTo($request->permissions);

      DB::commit();
      return response()->json([
        'message' => 'Created successfully!',
        'data' => [
          'id'    => $newRole->id,
          'name'  => $newRole->name,
          'description' => $newRole->description,
          'created_at'  => $newRole->created_at,
          'created_by'  => [
            'id'    => $newRole->createdBy->id,
            'name'  => $newRole->createdBy->name
          ]
        ],
      ], 201);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['message' => $th->getMessage()], 400);
    }
  }

  public function updateRole(Request $request, $id)
  {
    try {
      $validator   = Validator::make($request->all(), (new RoleRequest)->rules($id));
      if ($validator->fails()) return response()->json([
        'message' => 'The given data was invalid.',
        'errors' => $validator->errors()
      ], 422);

      $role = Role::findOrFail($id);
      $role->update($request->only(['name', 'description']));
      $role->syncPermissions($request->permissions);

      return response()->json([
        'message' => 'Updated successfully!',
        'data' => [
          'id'    => $role->id,
          'name'  => $role->name,
          'description' => $role->description,
          'created_at'  => $role->created_at,
          'created_by'  => [
            'id'    => $role->createdBy->id,
            'name'  => $role->createdBy->name
          ]
        ],
      ],);
    } catch (\Throwable $th) {
      DB::rollBack();
      return response()->json(['message' => $th->getMessage()], 400);
    }
  }

  /**
   * Delete multiple or single roles
   * @param array $ids
   * @return json
   */
  public function destroyRole(Request $request)
  {
    $this->role->destroy($request->ids);
    return response()->json([
      'message' => 'Deleted successfully!',
    ]);
  }

  public function getPermissions()
  {
    $permissions = $this->permission->select('id', 'name')->get();
    return PermissionResource::collection($permissions);
  }

  public function giveOrRevokePermission(Request $request)
  {
    $role = $this->role->findByName($request->role);

    if ($request->checked) {
      $role->givePermissionTo($request->permission);
      $message = 'Given ' . $request->permission . ' permission to ' . $request->role;
    } else {
      $role->revokePermissionTo($request->permission);
      $message = 'Revoked ' . $request->permission . ' permission to ' . $request->role;
    }
    return  response()->json([
      'message' => $message,
      'data' => new RoleResource($role)
    ]);
  }
}
