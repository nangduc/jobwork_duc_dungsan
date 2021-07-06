<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
  /**
   * Handle the Role "deleted" event.
   *
   * @param  \App\Models\Role  $role
   * @return void
   */
  public function deleting(Task $task)
  {
    $task->taskProgresses()->delete();
  }
}
