<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVariant extends Model
{
    use HasFactory;
    protected $table = 'item_variants';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }
    public function discountitemvarian()
    {
        return $this->belongsTo(DiscountItemVarian::class, 'id', 'item_varian_id');
    }

    function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }

    function stock()
    {
        return $this->hasOne(Stock::class, 'item_varian_id', 'id');
    }
    // function itemPhoto()
    // {
    //     return $this->belongsTo(ItemPhoto::class, 'item_varian_id', 'id');
    // }

    public function itemPhoto()
    {
        return $this->hasOne(ItemPhoto::class, 'item_variant_id', 'id');
    }

    function cart()
    {
        return $this->hasOne(Cart::class, 'variant_id', 'id');
    }
}
