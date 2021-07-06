<?php

namespace App\Models;

use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
  use HasFactory, SoftDeletes;

  protected $table = 'tasks';

  protected $fillable = [
    'user_id',
    'customer_id',
    'task_type_id',
    'name',
    'description',
    'survey_price',
    'insurance_price',
    'expected_order_at',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function taskProgresses()
  {
    return $this->hasMany(TaskProgress::class);
  }

  public function taskType() {
    return $this->belongsTo(TaskType::class);
  }

  /**
   * Scope a query to paginate tasks.
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
   * Scope a query to order tasks.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  /**
   * Scope a query to search tasks.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param string $keyword
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeSearch($query, $keyword)
  {
    if ($keyword !== null) {
      return $query->where(function ($query) use ($keyword) {
        $query->where('name', 'LIKE', "%{$keyword}%")
          ->orWhere('description', 'LIKE', "%{$keyword}%");
      });
    }
  }

  /**
   * Scope a query to get tasks
   * @param \Illuminate\Database\Eloquent\Builder  $query
   * @param array $params
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeGetTasks($query, $params)
  {
    return $query->select('id', 'user_id', 'customer_id', 'task_type_id', 'name', 'description', 'expected_order_at', 'created_at')
      ->with('user:id,name', 'customer:id,name', 'taskType:id,name', 'taskProgresses')
      ->search($params['search'])
      ->ordered()
      ->paginated($params['length']);
  }

  public static function boot()
  {
    parent::boot();
    self::observe(TaskObserver::class);
  }
}
