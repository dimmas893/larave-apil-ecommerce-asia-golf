<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBundling extends Model
{
    use HasFactory;

    protected $table = 'item_bundlings';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function itemBundlingDetails()
    {
        return $this->hasMany(ItemBundlingDetails::class, 'item_bundling_id', 'id');
    }

    function product()
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
