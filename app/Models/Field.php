<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $table = 'fields';

  /**
   * The customers that belong to the field.
   */
  public function customers()
  {
    return $this->belongsToMany(Customer::class);
  }
}
