<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companion extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = ['name', 'avatar'];

  protected $table = 'companions';

  /**
   * Scope a query to paginate companions.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param int $length
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePaginated($query, $length)
  {
    return $query->paginate($length);
  }

  /**
   * Scope a query to order companions.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  /**
   * Scope a query to search companions.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param string $keyword
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeSearch($query, $keyword)
  {
    if ($keyword !== null) {
      return $query->where(function ($query) use ($keyword) {
        $query->where('name', 'LIKE', "%{$keyword}%");
      });
    }
  }
}
