<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskProgress extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'task_progresses';
  protected $fillable = [
    'id',
    'date',
    'task_id',
    'sale_status_id',
    'negotiation_status_id',
    'negotiation_result_status_id',
    'accuracy_id',
    'companion_id',
    'description',
    'next_negotiation_date',
    'plan_next_time'
  ];

  public function saleStatus()
  {
    return $this->belongsTo(SaleStatus::class);
  }

  public function negotiationStatus()
  {
    return $this->belongsTo(NegotiationStatus::class);
  }

  public function negotiationResultStatus()
  {
    return $this->belongsTo(NegotiationResultStatus::class);
  }

  public function accuracy() {
    return $this->belongsTo(Accuracy::class);
  }

  public function companion() {
    return $this->belongsTo(Companion::class);
  }

  public function task() {
    return $this->belongsTo(Task::class);
  }

  /**
   * Scope a query to paginate task progresses.
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
   * Scope a query to order task progresses.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'desc');
  }
}
