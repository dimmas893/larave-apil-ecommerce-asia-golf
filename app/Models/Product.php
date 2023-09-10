<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];

    function productable()
    {
        return $this->morphTo();
    }

    function wishlist()
    {
        return $this->hasOne(Wishlist::class, 'product_id', 'id');
    }

    function cart()
    {
        return $this->hasOne(Cart::class, 'product_id', 'id');
    }

    function item()
    {
        return $this->hasOne(Item::class, 'id', 'productable_id');
    }
}
