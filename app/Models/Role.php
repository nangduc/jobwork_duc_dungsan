<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Observers\RoleObserver;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
  public function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public static function boot()
  {
    parent::boot();
    self::observe(RoleObserver::class);
  }
}
