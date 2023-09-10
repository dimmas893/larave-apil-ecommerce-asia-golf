<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReview extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    function itemReview()
    {
        return $this->belongsTo(ItemReview::class, 'item_id', 'id');
    }

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
