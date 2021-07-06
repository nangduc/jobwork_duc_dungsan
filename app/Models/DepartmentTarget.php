<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentTarget extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'department_targets';
    protected $fillable = [
      'department_id',
      'targets',
      'achievement',
      'from',
      'to'
    ];


    
}
