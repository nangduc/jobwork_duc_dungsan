<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeTarget extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_targets';
    protected $fillable = [
      'user_id',
      'targets',
      'achievement',
      'from',
      'to'
    ];


    public function User(){
      return $this->belongsTo(User::class);
    }
}
