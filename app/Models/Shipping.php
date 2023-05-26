<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table='shippings';

    protected $fillable=[
        'shipping_method',
        'value',
        'status',
        'address',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function user()
        {
        return $this->hasMany(User::class);
    }

}
