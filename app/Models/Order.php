<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
