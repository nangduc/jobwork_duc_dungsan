<?php

namespace App\Models;

use App\Observers\UserObserver;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

  protected $guard_name = 'api';
  protected $attributes = ['active' => true];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'department_id',
    'name',
    'kana_name',
    'username',
    'email',
    'password',
    'phone',
    'address',
    'birthday',
    'job_title',
    'avatar',
    'active',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'active' => 'boolean',
  ];

  public function creator()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function updater()
  {
    return $this->belongsTo(User::class, 'updated_by');
  }

  public function department() {
    return $this->belongsTo(Department::class);
  }

  /**
   * Scope a query to paginate users.
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
   * Scope a query to order users.
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
      return $query->where(function ($query) use ($keyword) {
        $query->where('name', 'LIKE', "%{$keyword}%")
          ->orWhere('username', 'LIKE', "%{$keyword}%")
          ->orWhere('phone', 'LIKE', "%{$keyword}%");
      });
    }
  }

  public static function boot()
  {
    parent::boot();
    self::observe(UserObserver::class);
  }
}
