<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name','color'];

    protected $table = 'sale_statuses';
    public $timestamps = false;
}
