<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBundlingDetails extends Model
{
    use HasFactory;
    protected $table = 'item_bundling_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function itemBundling()
    {
        return $this->hasMany(ItemBundling::class, 'item_bundling_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
