<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Department extends Model
{
  use HasFactory, NodeTrait, SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    '_lft',
    '_rgt',
    'parent_id',
    'manager_id'
  ];


  public function employee()
  {
    return $this->hasMany(User::class);
  }

  public function user()
  {
    return $this->hasMany(User::class);
  }


  public function children()
  {
    return $this->hasMany(self::class, 'parent_id', 'id');
  }


  public function departmenttargets()
  {
    return $this->hasMany(DepartmentTarget::class);
  }
  /**
   * Get department creator
   */
  public function creator()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  /**
   * Get department manager
   */
  public function manager()
  {
    return $this->belongsTo(User::class, 'manager_id');
  }

  /**
   * Scope a query to paginate departments.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePaginated($query, $length)
  {
    $length = !$length ? 10 : $length;
    return $query->paginate($length);
  }

  /**
   * Scope a query to order departments.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  /**
   * Scope a query to search users.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param string $keyword
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeSearch($query, $keyword)
  {
    if ($keyword !== null) {
      return $query->where('name', 'LIKE', "%{$keyword}%");
    }
  }
}
