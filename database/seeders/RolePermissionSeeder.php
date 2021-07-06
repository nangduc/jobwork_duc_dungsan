<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // create permissions
    Permission::create(['name' => 'companions.view']);
    Permission::create(['name' => 'companions.create']);
    Permission::create(['name' => 'companions.update']);
    Permission::create(['name' => 'companions.delete']);
    Permission::create(['name' => 'customers.view']);
    Permission::create(['name' => 'customers.create']);
    Permission::create(['name' => 'customers.update']);
    Permission::create(['name' => 'customers.delete']);
    Permission::create(['name' => 'departments.view']);
    Permission::create(['name' => 'departments.create']);
    Permission::create(['name' => 'departments.update']);
    Permission::create(['name' => 'departments.delete']);
    Permission::create(['name' => 'tasks.view']);
    Permission::create(['name' => 'tasks.create']);
    Permission::create(['name' => 'tasks.update']);
    Permission::create(['name' => 'tasks.delete']);
    Permission::create(['name' => 'reports.view']);
    Permission::create(['name' => 'reports.create']);
    Permission::create(['name' => 'reports.update']);
    Permission::create(['name' => 'reports.delete']);
    Permission::create(['name' => 'users.view']);
    Permission::create(['name' => 'users.create']);
    Permission::create(['name' => 'users.update']);
    Permission::create(['name' => 'users.delete']);


    $role = Role::create(['name' => 'Admin','description' => 'システム管理者', 'created_by' => 1]);
    $role->givePermissionTo(Permission::all());

    $role = Role::create(['name' => 'Manager','description' => '全ての部署の内容を確認でき、コメントもできます', 'created_by' => 1]);
    $role->givePermissionTo(Permission::all());

    $role = Role::create(['name' => 'Sub-manager','description' => '所属のメンバーを管理、目標値設定', 'created_by' => 1]);
    $role->givePermissionTo(['tasks.create', 'tasks.update', 'tasks.delete', 'departments.create', 'departments.update', 'departments.delete']);

    $role = Role::create(['name' => 'Member','description' => '地盤ネットの社員。部署の内容を確認でき、コメントもできます。', 'created_by' => 1]);
    $role->givePermissionTo(['tasks.create', 'tasks.update', 'tasks.delete', 'reports.create', 'reports.update', 'reports.delete']);

    $user = User::find(1);
    $user->assignRole('Admin');

    $users = User::whereIn('id', [2, 3, 4, 5, 6, 7])->get();
    foreach ($users as $user) {
      $user->assignRole('Manager');
    }

    $users = User::whereIn('id', [8])->get();
    foreach ($users as $user) {
      $user->assignRole('Sub-manager');
    }

    $users = User::whereIn('id', [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19])->get();
    foreach ($users as $user) {
      $user->assignRole('Member');
    }
  }
}
