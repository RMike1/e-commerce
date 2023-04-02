<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Product_Items extends Model
{
    use HasFactory;
    protected $table='order__product__items';

    protected $fillable=[
        'product_name',
        'product_price',
        'product_quantity',
        'product_total',
        'purchase_orders_id'
    ];
}
