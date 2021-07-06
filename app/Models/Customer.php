<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'customers';
  protected $fillable = [
    'parent_id',
    'name',
    'kana_name',
    'business_name',
    'short_name',
    'building_name',
    'street',
    'district',
    'province',
    'address',
    'post_code',
    'phone',
    'fax',
    'email',
    'website',
    'charter_capital',
    'founding',
    'number_of_employees',
    'revenue',
    'remark',
    'image',
    'representative'
  ];

  public function parent()
  {
    return $this->belongsTo(self::class, 'parent_id');
  }

  public function children()
  {
    return $this->hasMany(self::class, 'parent_id', 'id');
  }

  /**
   * Scope a query to paginate customers.
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
   * Scope a query to order customers.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'desc');
  }

  /**
   * Scope a query to search customers.
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
          ->orWhere('kana_name', 'LIKE', "%{$keyword}%")
          ->orWhere('business_name', 'LIKE', "%{$keyword}%")
          ->orWhere('short_name', 'LIKE', "%{$keyword}%");
      });
    }
  }

  /**
   * The fields that belong to the customer.
   */
  public function fields()
  {
    return $this->belongsToMany(Field::class);
  }
}
