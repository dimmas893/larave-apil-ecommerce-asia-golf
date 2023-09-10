<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id';
    protected $guarded = [];

    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    function itemVariant()
    {
        return $this->belongsTo(ItemVariant::class, 'variant_id', 'id');
    }
}