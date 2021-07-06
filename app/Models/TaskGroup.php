<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
  use HasFactory;

  protected $fillable = ['id', 'name'];

  protected $table = 'task_groups';
  public $timestamps = false;

  public function taskTypes()
  {
    return $this->hasMany(TaskType::class);
  }
}
