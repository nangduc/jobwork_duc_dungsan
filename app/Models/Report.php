<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  use HasFactory;

  protected $table = 'reports';
  protected $fillable = ['user_id', 'date_created', 'content', 'properties'];

  public function user() {
    return $this->belongsTo(User::class);
  }

   /**
   * Scope a query to paginate reports.
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
   * Scope a query to order reports.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'desc');
  }
}
