<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function itemvariant()
    {
        return $this->belongsTo(ItemVariant::class, 'item_variant', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    function itemVarian()
    {
        return $this->hasOne(ItemVariant::class, 'item_variant_id', 'id');
    }
}
