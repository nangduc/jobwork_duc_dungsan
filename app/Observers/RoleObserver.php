<?php

namespace App\Observers;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class RoleObserver
{
  protected $userId;

  public function __construct()
  {
    $this->userId = Auth::user()->id;
  }

  /**
   * Handle the Role "created" event.
   *
   * @param  \App\Models\Role  $role
   * @return void
   */
  public function creating(Role $role)
  {
    $role->created_by = $this->userId;
  }

  /**
   * Handle the Role "updated" event.
   *
   * @param  \App\Models\Role  $role
   * @return void
   */
  public function updated(Role $role)
  {
    //
  }

  /**
   * Handle the Role "deleted" event.
   *
   * @param  \App\Models\Role  $role
   * @return void
   */
  public function deleting(Role $role)
  {
    $role->syncPermissions();
  }

}
