<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
  use HasFactory;

  protected $table = 'task_types';
  protected $fillable = ['name', 'task_group_id'];

  public function taskGroup()
  {
    return $this->belongsTo(TaskGroup::class);
  }
}
