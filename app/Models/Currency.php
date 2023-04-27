<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable=[
        'code',
        'name',
        'symbol',
        'normal_val',
        'us_value',
        'status',
        'fr_use_status',
        'user_id'
    ];

    protected $table='currencies';
}
