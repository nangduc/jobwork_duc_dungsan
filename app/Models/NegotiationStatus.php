<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegotiationStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name','color','sale_status_id'];

    protected $table = 'negotiation_statuses';
    public $timestamps = false;
}
