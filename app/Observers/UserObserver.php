<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserObserver
{

  protected $userId;

  public function __construct()
  {
    $this->userId = Auth::user()->id;
  }
  /**
   * Handle the User "creating" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function creating(User $user)
  {
    $user->created_by = $this->userId;
  }

  /**
   * Handle the User "updating" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function updating(User $user)
  {
    $user->updated_by = $this->userId;
  }

  /**
   * Handle the User "deleting" event.
   *
   * @param  \App\Models\User  $user
   * @return void
   */
  public function deleting(User $user)
  {
    if ($user->isForceDeleting()) {
      $user->roles()->detach();
    }
  }
}
