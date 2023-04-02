<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Order extends Model
{
    use HasFactory;

    protected $table='purchase__orders';

    protected $fillable=[
        'date',
        'invoice_no',
        'information',
        'supplier_name',
    ];
}
