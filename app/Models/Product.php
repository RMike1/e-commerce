<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function Shipping()
    {
        return $this->hasOne(Shipping::class);
    }

}
