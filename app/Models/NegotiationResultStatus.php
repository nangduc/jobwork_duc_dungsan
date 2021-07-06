<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegotiationResultStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name','color'];

    protected $table = 'negotiation_result_statuses';
    public $timestamps = false;
}
